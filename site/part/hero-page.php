<?php
/*
 * Hero podstron: okruszki, H1, krótki opis, przyciski i grafika (SVG w kolorach marki).
 *
 * Strona może nadpisać (przed dołączeniem tego pliku):
 *   $h1          – nagłówek (domyślnie tytuł bez dopisku marki)
 *   $hero_lead   – zdanie pod nagłówkiem
 *   $hero_icon   – ikona Material Icons w grafice
 *   $hero_badge  – etykieta na grafice
 *   $hero_cta    – [tekst, adres] głównego przycisku; false = bez przycisków
 *   $hero_visual – false = bez grafiki (np. regulamin)
 *   $hero_image  – [adres, alt] zrzutu ekranu zamiast grafiki SVG (np. podstrony realizacji)
 *   $hero_chip   – etykieta w górnym rogu grafiki (domyślnie lokalizacja)
 */
$heroDefaults = [
    'uslugi/tworzenie-stron-www.php'  => ['laptop_mac', 'Projektujemy szybkie, responsywne strony firmowe i sklepy internetowe zoptymalizowane pod Google i AI — dla firm z Piaseczna, Warszawy i okolic.', 'Strony od 800 zł'],
    'uslugi/kampanie-google-ads.php'  => ['search', 'Reklamy w wyszukiwarce, sieci reklamowej i Google Shopping, które docierają do klientów dokładnie wtedy, gdy szukają Twoich usług.', 'Bezpłatny audyt'],
    'uslugi/serwis-komputerowy.php'   => ['build', 'Naprawa i konserwacja laptopów, komputerów i tabletów, instalacja systemów i odzyskiwanie danych — w Piasecznie, Warszawie i okolicach.', 'Diagnoza i naprawa'],
    'uslugi/sieci-lan-wlan.php'       => ['wifi', 'Projektujemy, instalujemy i serwisujemy sieci przewodowe i Wi-Fi w biurach — szybkie, stabilne i bezpieczne.', 'LAN · Wi-Fi'],
    'uslugi/pomoc-domowa.php'         => ['computer', 'Informatyk z dojazdem do domu: naprawa komputera, instalacja systemu, Wi-Fi, drukarka i kopie zapasowe.', 'Dojazd do klienta'],
    'uslugi/branding-dla-firm.php'    => ['brush', 'Logo, identyfikacja wizualna i spójny wizerunek marki — od strategii po materiały firmowe i stronę internetową.', 'Logo · identyfikacja'],
    'uslugi/pozycjonowanie-stron.php' => ['trending_up', 'Pozycjonowanie lokalne w Google oraz widoczność w AI Overview i ChatGPT — SEO, AEO i GEO dla firm z Mazowsza.', 'Bezpłatny audyt SEO'],
    'uslugi/szkolenia-it.php'         => ['school', 'Naucz się digital marketingu napędzanego AI. Praktyczne, stacjonarne szkolenia dla firm i osób indywidualnych.', 'Grupy 5–30 osób'],
    'faq.php'                         => ['help_outline', 'Odpowiedzi na najczęstsze pytania o obsługę IT, strony internetowe, Google Ads, pozycjonowanie i szkolenia z AI.', 'Pn–pt 9:00–17:00'],
    'oferta.php'                      => ['apps', 'Obsługa informatyczna i marketing internetowy w jednym miejscu — dla firm z Piaseczna, Warszawy i okolic.', 'IT + marketing'],
    'realizacje/index.php'            => ['web', 'Wybrane strony firmowe i sklepy internetowe, które zaprojektowaliśmy i wdrożyliśmy dla naszych klientów.', 'Strony i sklepy'],
    'blog/index.php'                  => ['edit', 'Praktyczne porady o obsłudze IT, cyberbezpieczeństwie, stronach www oraz pozycjonowaniu SEO, AEO i GEO.', 'Porady i poradniki'],
    'kontakt.php'                     => ['mail_outline', 'Zadzwoń, napisz lub wypełnij formularz — odpowiadamy w dni robocze. Pierwsza konsultacja i wycena są bezpłatne.', 'Stara Iwiczna'],
];
$heroDefault = $heroDefaults[seo_path()] ?? ['devices', '', 'Bezpłatna wycena'];

$heroTitle  = $h1 ?? seo_short_title((string)$title);
$heroIcon   = $hero_icon ?? $heroDefault[0];
$heroLead   = $hero_lead ?? $heroDefault[1];
$heroBadge  = $hero_badge ?? $heroDefault[2];
$heroCta    = $hero_cta ?? ['Bezpłatna wycena', ABS_URL . 'kontakt.php'];
$heroVisual = $hero_visual ?? true;
$heroImage  = $hero_image ?? null;
$heroChip   = $hero_chip ?? 'Piaseczno · Warszawa';
$heroCrumbs = seo_breadcrumbs($metaShortTitle ?? $heroTitle);
$e = function ($text) {
    return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
};
?>
<section class="section section-content page-hero<?php echo $heroVisual ? '' : ' page-hero_simple'; ?>">
   <div class="container">
      <div class="row align-items-center page-hero__row">
         <div class="<?php echo $heroVisual ? 'col-lg-7' : 'col-lg-10'; ?> page-hero__text">
            <nav class="page-hero__crumbs" aria-label="Jesteś tutaj">
<?php foreach ($heroCrumbs as $i => $crumb) : ?>
<?php if ($i === count($heroCrumbs) - 1) : ?>
               <span aria-current="page"><?php echo $e($crumb[0]); ?></span>
<?php else : ?>
               <a href="<?php echo $e(str_replace(SEO_SITE_URL, ABS_URL, $crumb[1])); ?>"><?php echo $e($crumb[0]); ?></a>
               <i class="material-icons" aria-hidden="true">chevron_right</i>
<?php endif; ?>
<?php endforeach; ?>
            </nav>
            <div class="js-arts-split-text arts-split-text" data-arts-os-animation="true"
               data-arts-os-animation-name="animateText" data-arts-split-text="lines"
               data-arts-split-text-set="lines" data-arts-split-text-overflow-wrap="lines">
               <h1 class="page-hero__title"><?php echo $e($heroTitle); ?></h1>
            </div>
<?php if ($heroLead !== '') : ?>
            <p class="page-hero__lead"><?php echo $e($heroLead); ?></p>
<?php endif; ?>
<?php if ($heroCta) : ?>
            <div class="page-hero__actions">
               <a href="<?php echo $e($heroCta[1]); ?>" class="button btn-dark">
                  <span class="button__label button__label-normal"><span class="button__title"><?php echo $e($heroCta[0]); ?></span></span>
                  <span class="button__label button__label-hover"><span class="button__title"><?php echo $e($heroCta[0]); ?></span></span>
               </a>
               <a href="tel:+48501784882" class="page-hero__phone">
                  <i class="material-icons" aria-hidden="true">call</i><span>501 784 882</span>
               </a>
            </div>
<?php endif; ?>
         </div>
<?php if ($heroVisual) : ?>
         <div class="col-lg-5 page-hero__visual-col">
            <div class="page-hero__visual<?php echo $heroImage ? ' page-hero__visual_shot' : ''; ?>"<?php echo $heroImage ? '' : ' aria-hidden="true"'; ?>>
<?php if ($heroImage) : ?>
               <img class="page-hero__shot" src="<?php echo $e($heroImage[0]); ?>" alt="<?php echo $e($heroImage[1]); ?>" width="1200" height="833" fetchpriority="high" />
<?php else : ?>
               <svg class="page-hero__art" viewBox="0 0 480 400" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg" focusable="false">
                  <defs>
                     <pattern id="heroDots" width="24" height="24" patternUnits="userSpaceOnUse">
                        <circle cx="2" cy="2" r="1.6" fill="currentColor" opacity=".18" />
                     </pattern>
                     <radialGradient id="heroGlow" cx="78%" cy="18%" r="60%">
                        <stop offset="0" style="stop-color:var(--color-accent-1)" stop-opacity=".55" />
                        <stop offset="1" style="stop-color:var(--color-accent-1)" stop-opacity="0" />
                     </radialGradient>
                  </defs>
                  <rect width="480" height="400" fill="url(#heroGlow)" />
                  <rect width="480" height="400" fill="url(#heroDots)" />
                  <circle cx="240" cy="200" r="150" fill="none" stroke="currentColor" stroke-opacity=".12" />
                  <circle cx="240" cy="200" r="108" fill="none" stroke="currentColor" stroke-opacity=".18" stroke-dasharray="4 8" />
                  <path d="M40 330 C 140 270, 200 360, 300 300 S 430 250, 470 290" fill="none" style="stroke:var(--color-accent-1)" stroke-width="3" stroke-linecap="round" opacity=".9" />
                  <circle cx="300" cy="300" r="6" style="fill:var(--color-accent-1)" />
                  <rect x="372" y="60" width="44" height="44" rx="12" fill="none" stroke="currentColor" stroke-opacity=".25" />
                  <rect x="60" y="64" width="26" height="26" rx="8" style="fill:var(--color-accent-1)" opacity=".85" />
               </svg>
               <div class="page-hero__tile">
                  <i class="material-icons"><?php echo $e($heroIcon); ?></i>
               </div>
<?php endif; ?>
               <div class="page-hero__chip page-hero__chip_top" aria-hidden="true">
                  <i class="material-icons"><?php echo $heroImage ? 'language' : 'location_on'; ?></i><span><?php echo $e($heroChip); ?></span>
               </div>
<?php if ($heroBadge !== '') : ?>
               <div class="page-hero__chip page-hero__chip_bottom" aria-hidden="true">
                  <i class="material-icons">check_circle</i><span><?php echo $e($heroBadge); ?></span>
               </div>
<?php endif; ?>
            </div>
         </div>
<?php endif; ?>
      </div>
   </div>
</section>
