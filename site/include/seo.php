<?php
/*
 * SEO / AEO / GEO: adres kanoniczny, tytuły i dane strukturalne (JSON-LD).
 *
 * Strona może ustawić przed dołączeniem header.php (wszystkie opcjonalne):
 *   $title, $description           – tytuł i opis (jak dotychczas)
 *   $robots                        – np. 'noindex, follow'
 *   $breadcrumb                    – krótka nazwa strony w okruszkach (domyślnie $title bez dopisku marki)
 *   $faq                           – [['q' => pytanie, 'a' => odpowiedź (HTML)], …] → FAQPage + part/faq.php
 *   $date, $autor, $image          – wpis na blogu → BlogPosting
 */

const SEO_SITE_URL = 'https://www.qamitech.pl/';
const SEO_BRAND = 'Qamitech';

/** Dane firmy – jedno źródło dla schema.org i llms.txt. */
function seo_business(): array
{
    return [
        'name'      => 'Qamitech Creative Solution',
        'phone'     => '+48501784882',
        'email'     => 'kontakt@qamitech.pl',
        'street'    => 'ul. Cicha 3',
        'city'      => 'Stara Iwiczna',
        'postcode'  => '05-500',
        'region'    => 'mazowieckie',
        // współrzędne pinezki firmy z mapy Google na stronie kontaktowej
        'lat'       => 52.0859774,
        'lng'       => 21.0049848,
        'area'      => ['Piaseczno', 'Warszawa', 'Konstancin-Jeziorna', 'Mysiadło', 'Lesznowola', 'Pruszków',
                        'Grodzisk Mazowiecki', 'Tarczyn', 'Grójec', 'Góra Kalwaria', 'Otwock', 'Legionowo'],
    ];
}

/** Usługi: ścieżka strony => [nazwa, opis]. */
function seo_services(): array
{
    return [
        'outsourcing.php'                 => ['Outsourcing IT i obsługa informatyczna firm', 'Stała opieka nad komputerami, serwerami, siecią, pocztą i kopiami zapasowymi w modelu abonamentowym, zdalnie i na miejscu.'],
        'uslugi/tworzenie-stron-www.php'  => ['Tworzenie stron internetowych i sklepów', 'Projektowanie i wdrażanie responsywnych stron firmowych, sklepów WooCommerce i serwisów z CMS, zoptymalizowanych pod SEO.'],
        'uslugi/kampanie-google-ads.php'  => ['Kampanie Google Ads', 'Prowadzenie kampanii Search, Display, remarketingu, Google Shopping i kampanii lokalnych z miesięcznym raportem.'],
        'uslugi/pozycjonowanie-stron.php' => ['Pozycjonowanie SEO, AEO i GEO', 'Audyt SEO, optymalizacja on-page, treści, link building, Google Business Profile oraz widoczność w AI Overview i ChatGPT.'],
        'uslugi/serwis-komputerowy.php'   => ['Serwis komputerowy', 'Naprawa i konserwacja laptopów, komputerów i tabletów, instalacja systemów i oprogramowania, odzyskiwanie danych.'],
        'uslugi/sieci-lan-wlan.php'       => ['Sieci LAN i WLAN', 'Projektowanie, instalacja i serwis sieci przewodowych i Wi-Fi w biurach: okablowanie, routery, przełączniki, punkty dostępowe.'],
        'uslugi/szkolenia-it.php'         => ['Szkolenia z AI, marketingu i IT', 'Praktyczne szkolenia stacjonarne: AI w marketingu, agenci AI, automatyzacja (n8n, Make, Zapier), Google Ads, WordPress, cyberbezpieczeństwo.'],
        'uslugi/branding-dla-firm.php'    => ['Branding i identyfikacja wizualna', 'Strategia marki, projekt logo, identyfikacja wizualna i treści marketingowe dla firm.'],
        'uslugi/pomoc-domowa.php'         => ['Pomoc informatyczna w domu', 'Dojazd do klienta: naprawa i konfiguracja komputerów, instalacja systemu, sieć domowa i Wi-Fi, kopie zapasowe.'],
    ];
}

function seo_city($name)
{
    return ['@type' => 'City', 'name' => $name];
}

/** Ścieżka bieżącej strony względem katalogu głównego, np. 'uslugi/serwis-komputerowy.php'. */
function seo_path(): string
{
    $uri  = strtok($_SERVER['REQUEST_URI'] ?? '/', '?#') ?: '/';
    $path = ltrim(rawurldecode($uri), '/');
    $base = trim((string)parse_url(ABS_URL, PHP_URL_PATH), '/');
    if ($base !== '' && strpos($path, $base . '/') === 0) {
        $path = substr($path, strlen($base) + 1);
    }
    return $path;
}

/** Adres kanoniczny: zawsze https://www.qamitech.pl, bez index.php w katalogu głównym. */
function seo_canonical(): string
{
    $path = seo_path();
    if ($path === 'index.php') {
        $path = '';
    }
    return SEO_SITE_URL . $path;
}

/** Tytuł bez dopisku marki – do okruszków i nagłówków. */
function seo_short_title(string $title): string
{
    return trim(preg_replace('/\s*[|\-–]\s*Qamitech.*$/u', '', $title));
}

/** Pełny tytuł do <title>: marka tylko raz. */
function seo_full_title(string $title): string
{
    $title = trim($title);
    if ($title === '') {
        return SEO_BRAND . ' – obsługa IT i marketing dla firm';
    }
    return stripos($title, SEO_BRAND) === false ? $title . ' | ' . SEO_BRAND : $title;
}

/** '28 czerwiec 2026', '15 marzec, 2023', '23 czerwca 2022' → '2026-06-28'. */
function seo_parse_pl_date(string $date): ?string
{
    $months = [
        'stycz' => 1, 'lut' => 2, 'mar' => 3, 'kwie' => 4, 'maj' => 5, 'czerw' => 6,
        'lip' => 7, 'sierp' => 8, 'wrze' => 9, 'paźdz' => 10, 'pazdz' => 10, 'listop' => 11, 'grud' => 12,
    ];
    if (! preg_match('/(\d{1,2})\s+([[:alpha:]ąćęłńóśźż]+)[,\s]+(\d{4})/iu', $date, $m)) {
        return null;
    }
    $word = mb_strtolower($m[2], 'UTF-8');
    foreach ($months as $prefix => $num) {
        if (strpos($word, $prefix) === 0) {
            return sprintf('%04d-%02d-%02d', $m[3], $num, $m[1]);
        }
    }
    return null;
}

/** Okruszki: [[nazwa, url], …]. */
function seo_breadcrumbs(string $current): array
{
    $path  = seo_path();
    $items = [['Strona główna', SEO_SITE_URL]];
    if ($path === '' || $path === 'index.php') {
        return $items;
    }
    if (strpos($path, 'uslugi/') === 0 || $path === 'outsourcing.php') {
        $items[] = ['Oferta', SEO_SITE_URL . 'oferta.php'];
    } elseif (strpos($path, 'blog/') === 0 && $path !== 'blog/index.php') {
        $items[] = ['Blog', SEO_SITE_URL . 'blog/index.php'];
    }
    $items[] = [$current, seo_canonical()];
    return $items;
}

/** Graf JSON-LD dla bieżącej strony. */
function seo_graph(array $page): array
{
    $b        = seo_business();
    $orgId    = SEO_SITE_URL . '#organization';
    $url      = seo_canonical();
    $path     = seo_path();
    $services = seo_services();

    $catalog = [];
    foreach ($services as $servicePath => [$name, $desc]) {
        $catalog[] = [
            '@type'       => 'Offer',
            'itemOffered' => ['@type' => 'Service', 'name' => $name, 'url' => SEO_SITE_URL . $servicePath],
        ];
    }

    $graph = [];
    $graph[] = [
        '@type'       => ['LocalBusiness', 'ProfessionalService'],
        '@id'         => $orgId,
        'name'        => $b['name'],
        'alternateName' => SEO_BRAND,
        'url'         => SEO_SITE_URL,
        'logo'        => SEO_SITE_URL . 'assets/img/logo/logo-qamitech.png',
        'image'       => SEO_SITE_URL . 'assets/img/opengraph.png',
        'description' => 'Lokalny partner IT ze Starej Iwicznej k. Piaseczna: outsourcing IT i obsługa informatyczna firm, serwis komputerowy, sieci LAN/WLAN, tworzenie stron internetowych, Google Ads, pozycjonowanie SEO/AEO/GEO i szkolenia z AI.',
        'telephone'   => $b['phone'],
        'email'       => $b['email'],
        'address'     => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => $b['street'],
            'addressLocality' => $b['city'],
            'postalCode'      => $b['postcode'],
            'addressRegion'   => $b['region'],
            'addressCountry'  => 'PL',
        ],
        'geo'         => ['@type' => 'GeoCoordinates', 'latitude' => $b['lat'], 'longitude' => $b['lng']],
        'hasMap'      => 'https://www.google.com/maps/search/?api=1&query=' . $b['lat'] . ',' . $b['lng'],
        'areaServed'  => array_map('seo_city', $b['area']),
        'openingHoursSpecification' => [[
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            'opens'     => '09:00',
            'closes'    => '17:00',
        ]],
        'contactPoint' => [[
            '@type'             => 'ContactPoint',
            'contactType'       => 'customer service',
            'telephone'         => $b['phone'],
            'email'             => $b['email'],
            'availableLanguage' => 'pl',
            'areaServed'        => 'PL',
        ]],
        'knowsAbout'  => ['outsourcing IT', 'obsługa informatyczna firm', 'serwis komputerowy', 'sieci LAN i Wi-Fi',
                          'cyberbezpieczeństwo', 'tworzenie stron internetowych', 'WordPress', 'WooCommerce',
                          'Google Ads', 'SEO', 'AEO', 'GEO', 'sztuczna inteligencja w marketingu', 'agenci AI'],
        'hasOfferCatalog' => ['@type' => 'OfferCatalog', 'name' => 'Usługi Qamitech', 'itemListElement' => $catalog],
    ];

    $graph[] = [
        '@type'      => 'WebSite',
        '@id'        => SEO_SITE_URL . '#website',
        'url'        => SEO_SITE_URL,
        'name'       => SEO_BRAND,
        'inLanguage' => 'pl-PL',
        'publisher'  => ['@id' => $orgId],
    ];

    $crumbs = [];
    foreach (seo_breadcrumbs($page['short_title']) as $i => [$name, $itemUrl]) {
        $crumbs[] = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $name, 'item' => $itemUrl];
    }

    $webPage = [
        '@type'       => 'WebPage',
        '@id'         => $url . '#webpage',
        'url'         => $url,
        'name'        => $page['full_title'],
        'description' => $page['description'],
        'inLanguage'  => 'pl-PL',
        'isPartOf'    => ['@id' => SEO_SITE_URL . '#website'],
        'about'       => ['@id' => $orgId],
        'breadcrumb'  => ['@type' => 'BreadcrumbList', 'itemListElement' => $crumbs],
    ];
    if ($path === 'kontakt.php') {
        $webPage['@type'] = 'ContactPage';
    }
    if ($path === 'faq.php' || ! empty($page['faq'])) {
        $webPage['@type'] = ['WebPage', 'FAQPage'];
    }
    if (! empty($page['faq'])) {
        $webPage['mainEntity'] = array_map(function ($item) {
            return [
                '@type'          => 'Question',
                'name'           => $item['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => trim(strip_tags($item['a']))],
            ];
        }, $page['faq']);
    }
    $graph[] = $webPage;

    if (isset($services[$path])) {
        [$name, $desc] = $services[$path];
        $graph[] = [
            '@type'       => 'Service',
            '@id'         => $url . '#service',
            'name'        => $name,
            'serviceType' => $name,
            'description' => $desc,
            'url'         => $url,
            'provider'    => ['@id' => $orgId],
            'areaServed'  => array_map('seo_city', array_slice($b['area'], 0, 7)),
        ];
    }

    if (! empty($page['date_iso'])) {
        $graph[] = [
            '@type'            => 'BlogPosting',
            '@id'              => $url . '#article',
            'headline'         => mb_substr($page['short_title'], 0, 110),
            'description'      => $page['description'],
            'datePublished'    => $page['date_iso'],
            'dateModified'     => $page['date_modified_iso'] ?? $page['date_iso'],
            'inLanguage'       => 'pl-PL',
            'mainEntityOfPage' => ['@id' => $url . '#webpage'],
            'author'           => ['@type' => 'Organization', 'name' => SEO_BRAND, 'url' => SEO_SITE_URL],
            'publisher'        => ['@id' => $orgId],
            'image'            => $page['image'] ? SEO_SITE_URL . 'assets/img/blog/' . $page['image'] : SEO_SITE_URL . 'assets/img/opengraph.png',
        ];
    }

    return ['@context' => 'https://schema.org', '@graph' => $graph];
}

function seo_jsonld(array $page): void
{
    $json = json_encode(seo_graph($page), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_HEX_TAG);
    echo "<script type=\"application/ld+json\">\n" . $json . "\n</script>\n";
}
