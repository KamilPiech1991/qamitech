"""Tworzy kampanię w sieci wyszukiwania z pliku JSON: budżet, stawki, lokalizacje, języki,
grupy reklam, słowa kluczowe, wykluczenia i reklamy elastyczne (RSA).

Kampania zawsze powstaje jako WSTRZYMANA. Włączasz ją świadomie:
    .venv/bin/python campaign.py enable ID --apply

Wszystko idzie w jednym żądaniu — albo powstaje całość, albo nic.

Przykład:
    .venv/bin/python create_search_campaign.py examples/kampania-search.json -c 123-456-7890
    .venv/bin/python create_search_campaign.py examples/kampania-search.json -c 123-456-7890 --apply
"""

import argparse
import json
import sys

from gads_common import (
    add_common_args, money, load_client, mutate, new_operation, parse_keyword, require_customer, run,
    to_micros,
)

LIMITS = {"headline": 30, "description": 90, "path": 15}


def validate(spec):
    errors = []
    for key in ("name", "daily_budget", "ad_groups"):
        if key not in spec:
            errors.append(f"brak pola „{key}”")
    strategy = spec.get("bidding", {}).get("strategy", "maximize_clicks")
    if strategy not in ("maximize_clicks", "maximize_conversions", "manual_cpc"):
        errors.append(f"nieznana strategia stawek „{strategy}”")
    for g in spec.get("ad_groups", []):
        name = g.get("name", "?")
        if strategy == "manual_cpc" and "max_cpc" not in g:
            errors.append(f"grupa „{name}”: przy manual_cpc podaj max_cpc")
        if not g.get("keywords"):
            errors.append(f"grupa „{name}”: brak słów kluczowych")
        if not g.get("ads"):
            errors.append(f"grupa „{name}”: brak reklam")
        for i, ad in enumerate(g.get("ads", []), 1):
            where = f"grupa „{name}”, reklama {i}"
            heads, descs = ad.get("headlines", []), ad.get("descriptions", [])
            if not 3 <= len(heads) <= 15:
                errors.append(f"{where}: nagłówków musi być 3–15 (jest {len(heads)})")
            if not 2 <= len(descs) <= 4:
                errors.append(f"{where}: tekstów reklamy musi być 2–4 (jest {len(descs)})")
            for text in heads:
                if len(text) > LIMITS["headline"]:
                    errors.append(f"{where}: nagłówek ma {len(text)} > 30 znaków: „{text}”")
            for text in descs:
                if len(text) > LIMITS["description"]:
                    errors.append(f"{where}: tekst ma {len(text)} > 90 znaków: „{text}”")
            for key in ("path1", "path2"):
                if len(ad.get(key, "")) > LIMITS["path"]:
                    errors.append(f"{where}: {key} dłuższa niż 15 znaków")
            if not str(ad.get("final_url", "")).startswith(("http://", "https://")):
                errors.append(f"{where}: final_url musi zaczynać się od https://")
    if errors:
        sys.exit("Plik kampanii ma błędy:\n  - " + "\n  - ".join(errors))


def build(client, cid, spec):
    enums = client.enums
    temp_id = iter(range(-1, -10_000, -1))
    ops, summary = [], []

    # Budżet
    budget_rn = client.get_service("CampaignBudgetService").campaign_budget_path(cid, next(temp_id))
    op = new_operation(client)
    budget = op.campaign_budget_operation.create
    budget.resource_name = budget_rn
    budget.name = f"{spec['name']} – budżet"
    budget.amount_micros = to_micros(spec["daily_budget"])
    budget.delivery_method = enums.BudgetDeliveryMethodEnum.STANDARD
    budget.explicitly_shared = False
    ops.append(op)
    summary.append(f"Kampania: {spec['name']} (WSTRZYMANA, sieć wyszukiwania)")
    summary.append(f"Budżet dzienny: {money(budget.amount_micros)}")

    # Kampania
    campaign_rn = client.get_service("CampaignService").campaign_path(cid, next(temp_id))
    op = new_operation(client)
    campaign = op.campaign_operation.create
    campaign.resource_name = campaign_rn
    campaign.name = spec["name"]
    campaign.status = enums.CampaignStatusEnum.PAUSED
    campaign.advertising_channel_type = enums.AdvertisingChannelTypeEnum.SEARCH
    campaign.campaign_budget = budget_rn
    campaign.network_settings.target_google_search = True
    campaign.network_settings.target_search_network = bool(spec.get("search_partners", False))
    campaign.network_settings.target_content_network = False
    campaign.geo_target_type_setting.positive_geo_target_type = enums.PositiveGeoTargetTypeEnum.PRESENCE
    try:
        campaign.contains_eu_political_advertising = (
            enums.EuPoliticalAdvertisingStatusEnum.DOES_NOT_CONTAIN_EU_POLITICAL_ADVERTISING
        )
    except (AttributeError, ValueError):
        pass  # starsze wersje API nie mają tego pola

    bidding = spec.get("bidding", {})
    strategy = bidding.get("strategy", "maximize_clicks")
    if strategy == "maximize_clicks":
        target_spend = client.get_type("TargetSpend")
        if bidding.get("max_cpc"):
            target_spend.cpc_bid_ceiling_micros = to_micros(bidding["max_cpc"])
        client.copy_from(campaign.target_spend, target_spend)
        summary.append("Stawki: Maks. liczba kliknięć"
                       + (f", limit CPC {bidding['max_cpc']}" if bidding.get("max_cpc") else ""))
    elif strategy == "maximize_conversions":
        maximize = client.get_type("MaximizeConversions")
        if bidding.get("target_cpa"):
            maximize.target_cpa_micros = to_micros(bidding["target_cpa"])
        client.copy_from(campaign.maximize_conversions, maximize)
        summary.append("Stawki: Maks. liczba konwersji"
                       + (f", docelowy CPA {bidding['target_cpa']}" if bidding.get("target_cpa") else ""))
    else:
        client.copy_from(campaign.manual_cpc, client.get_type("ManualCpc"))
        summary.append("Stawki: ręczny CPC")
    ops.append(op)

    # Lokalizacje i języki
    for geo_id in spec.get("locations", [2616]):
        op = new_operation(client)
        crit = op.campaign_criterion_operation.create
        crit.campaign = campaign_rn
        crit.location.geo_target_constant = f"geoTargetConstants/{geo_id}"
        ops.append(op)
    for lang_id in spec.get("languages", [1030]):
        op = new_operation(client)
        crit = op.campaign_criterion_operation.create
        crit.campaign = campaign_rn
        crit.language.language_constant = f"languageConstants/{lang_id}"
        ops.append(op)
    summary.append(f"Lokalizacje: {spec.get('locations', [2616])} (osoby przebywające w lokalizacji), "
                   f"języki: {spec.get('languages', [1030])}, partnerzy wyszukiwania: "
                   f"{'tak' if spec.get('search_partners') else 'nie'}")

    default_match = spec.get("default_match", "PHRASE")

    # Wykluczenia na poziomie kampanii
    negatives = [parse_keyword(k, "BROAD") for k in spec.get("negative_keywords", [])]
    for text, match in negatives:
        op = new_operation(client)
        crit = op.campaign_criterion_operation.create
        crit.campaign = campaign_rn
        crit.negative = True
        crit.keyword.text = text
        crit.keyword.match_type = enums.KeywordMatchTypeEnum[match]
        ops.append(op)
    if negatives:
        summary.append(f"Wykluczenia kampanii ({len(negatives)}): " + ", ".join(t for t, _ in negatives))

    # Grupy reklam, słowa kluczowe, reklamy
    for g in spec["ad_groups"]:
        ad_group_rn = client.get_service("AdGroupService").ad_group_path(cid, next(temp_id))
        op = new_operation(client)
        ad_group = op.ad_group_operation.create
        ad_group.resource_name = ad_group_rn
        ad_group.name = g["name"]
        ad_group.campaign = campaign_rn
        ad_group.status = enums.AdGroupStatusEnum.ENABLED
        ad_group.type_ = enums.AdGroupTypeEnum.SEARCH_STANDARD
        if g.get("max_cpc"):
            ad_group.cpc_bid_micros = to_micros(g["max_cpc"])
        ops.append(op)

        keywords = [parse_keyword(k, default_match) for k in g["keywords"]]
        for text, match in keywords:
            op = new_operation(client)
            crit = op.ad_group_criterion_operation.create
            crit.ad_group = ad_group_rn
            crit.status = enums.AdGroupCriterionStatusEnum.ENABLED
            crit.keyword.text = text
            crit.keyword.match_type = enums.KeywordMatchTypeEnum[match]
            ops.append(op)
        for text, match in (parse_keyword(k, "BROAD") for k in g.get("negative_keywords", [])):
            op = new_operation(client)
            crit = op.ad_group_criterion_operation.create
            crit.ad_group = ad_group_rn
            crit.negative = True
            crit.keyword.text = text
            crit.keyword.match_type = enums.KeywordMatchTypeEnum[match]
            ops.append(op)

        for ad_spec in g["ads"]:
            op = new_operation(client)
            ad_group_ad = op.ad_group_ad_operation.create
            ad_group_ad.ad_group = ad_group_rn
            ad_group_ad.status = enums.AdGroupAdStatusEnum.ENABLED
            ad = ad_group_ad.ad
            ad.final_urls.append(ad_spec["final_url"])
            rsa = ad.responsive_search_ad
            for item in ad_spec["headlines"]:
                rsa.headlines.append(text_asset(client, item))
            for item in ad_spec["descriptions"]:
                rsa.descriptions.append(text_asset(client, item))
            if ad_spec.get("path1"):
                rsa.path1 = ad_spec["path1"]
            if ad_spec.get("path2"):
                rsa.path2 = ad_spec["path2"]
            ops.append(op)

        summary.append(
            f"Grupa „{g['name']}”: {len(keywords)} słów ("
            + ", ".join({"EXACT": f"[{t}]", "PHRASE": f'"{t}"'}.get(m, t) for t, m in keywords[:6])
            + (", …" if len(keywords) > 6 else "")
            + f"), {len(g['ads'])} reklam RSA → {g['ads'][0]['final_url']}"
        )
    return ops, summary


def text_asset(client, item):
    """Tekst nagłówka/opisu: "Tekst" albo {"text": "Tekst", "pin": "HEADLINE_1"} (przypięcie pozycji)."""
    asset = client.get_type("AdTextAsset")
    if isinstance(item, dict):
        asset.text = item["text"]
        pin = item.get("pin")
    else:
        asset.text, pin = item, None
    if pin:
        asset.pinned_field = client.enums.ServedAssetFieldTypeEnum[pin]
    return asset


def main():
    parser = argparse.ArgumentParser(description=__doc__, formatter_class=argparse.RawDescriptionHelpFormatter)
    parser.add_argument("spec", help="plik JSON z definicją kampanii (wzór: examples/kampania-search.json)")
    add_common_args(parser, mutate=True)
    args = parser.parse_args()

    with open(args.spec, encoding="utf-8") as fh:
        spec = json.load(fh)
    validate(spec)
    client = load_client(args.config)
    cid = require_customer(args)

    ops, summary = build(client, cid, spec)
    print("\n".join(summary))
    print(f"\nRazem operacji: {len(ops)}")
    mutate(client, cid, ops, args.apply)
    if args.apply:
        print("\nKampania jest WSTRZYMANA. Sprawdź ją w panelu, a potem włącz: campaign.py enable <ID> --apply")


if __name__ == "__main__":
    run(main)
