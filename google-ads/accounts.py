"""Lista kont Google Ads dostępnych z Twojego logowania (i kont pod MCC).

Przykłady:
    .venv/bin/python accounts.py               # konta pod MCC z google-ads.yaml
    .venv/bin/python accounts.py -c 1234567890 # konta pod wskazanym MCC
"""

from gads_common import base_parser, load_client, print_table, run, search


def main():
    args = base_parser(__doc__).parse_args()
    client = load_client(args.config)

    accessible = client.get_service("CustomerService").list_accessible_customers()
    ids = [name.split("/")[1] for name in accessible.resource_names]
    print(f"Konta, do których Twoje logowanie ma bezpośredni dostęp: {', '.join(ids) or 'brak'}\n")

    manager = args.customer or client.login_customer_id
    if not manager:
        print("Ustaw login_customer_id w google-ads.yaml albo podaj -c ID_MCC, aby zobaczyć konta pod MCC.")
        return

    query = """
        SELECT customer_client.id, customer_client.descriptive_name, customer_client.manager,
               customer_client.level, customer_client.status, customer_client.currency_code,
               customer_client.time_zone
        FROM customer_client
        WHERE customer_client.level <= 1
        ORDER BY customer_client.level, customer_client.descriptive_name
    """
    rows = []
    for row in search(client, str(manager), query):
        cc = row.customer_client
        cid = str(cc.id)
        rows.append([
            f"{cid[:3]}-{cid[3:6]}-{cid[6:]}",
            cc.descriptive_name or "(bez nazwy)",
            "MCC" if cc.manager else "konto",
            cc.status.name,
            cc.currency_code,
            cc.time_zone,
        ])
    print(f"Konta pod {manager}:")
    print_table(["ID", "Nazwa", "Typ", "Status", "Waluta", "Strefa"], rows)


if __name__ == "__main__":
    run(main)
