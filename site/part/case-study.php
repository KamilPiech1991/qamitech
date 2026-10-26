<?php
/*
 * Treść podstrony realizacji (portfolio). Dane w tablicy $case ustawionej przez stronę:
 *   client, client_legal?, url, domain, type, industry, location?, languages?, tech[],
 *   image (zrzut do og:image i hero), intro[] (akapity), features[] ([ikona, tytuł, opis]),
 *   shots[] ([adres, alt, 'desktop'|'mobile']), next ([nazwa, plik] – kolejna realizacja)
 */
$e = function ($text) {
    return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
};
$caseFacts = array_filter([
    'Klient'      => $case['client_legal'] ?? $case['client'],
    'Branża'      => $case['industry'],
    'Lokalizacja' => $case['location'] ?? '',
    'Projekt'     => $case['type'],
    'Technologia' => implode(', ', $case['tech']),
    'Języki'      => $case['languages'] ?? '',
]);
$caseDesktop = array_values(array_filter($case['shots'], function ($s) { return $s[2] === 'desktop'; }));
$caseMobile  = array_values(array_filter($case['shots'], function ($s) { return $s[2] === 'mobile'; }));
?>
            <section class="section section-content case-study pb-medium">
               <div class="container">
                  <div class="row case-study__row">
                     <div class="col-lg-7">
                        <h2 class="case-study__heading">O projekcie</h2>
<?php foreach ($case['intro'] as $paragraph) : ?>
                        <p class="case-study__text"><?php echo $e($paragraph); ?></p>
<?php endforeach; ?>
                     </div>
                     <div class="col-lg-4 offset-lg-1">
                        <aside class="case-facts" aria-label="Najważniejsze informacje o realizacji">
                           <dl class="case-facts__list">
<?php foreach ($caseFacts as $label => $value) : ?>
                              <div class="case-facts__item">
                                 <dt><?php echo $e($label); ?></dt>
                                 <dd><?php echo $e($value); ?></dd>
                              </div>
<?php endforeach; ?>
                           </dl>
                           <a class="case-facts__link" href="<?php echo $e($case['url']); ?>" target="_blank" rel="noopener nofollow">
                              <span><?php echo $e($case['domain']); ?></span><i class="material-icons" aria-hidden="true">open_in_new</i>
                           </a>
                        </aside>
                     </div>
                  </div>
               </div>
            </section>

            <section class="section case-gallery pb-medium" aria-label="Zrzuty ekranu strony">
               <div class="container">
                  <div class="case-gallery__grid<?php echo $caseMobile ? '' : ' case-gallery__grid_desktop'; ?>">
<?php foreach ($caseDesktop as $shot) : ?>
                     <figure class="case-browser">
                        <div class="case-browser__bar" aria-hidden="true">
                           <span></span><span></span><span></span>
                           <em><?php echo $e($case['domain']); ?></em>
                        </div>
                        <img src="<?php echo $e($shot[0]); ?>" alt="<?php echo $e($shot[1]); ?>" width="1200" height="833" loading="lazy" />
                     </figure>
<?php endforeach; ?>
<?php foreach ($caseMobile as $shot) : ?>
                     <figure class="case-phone">
                        <img src="<?php echo $e($shot[0]); ?>" alt="<?php echo $e($shot[1]); ?>" width="390" height="844" loading="lazy" />
                     </figure>
<?php endforeach; ?>
                  </div>
               </div>
            </section>

            <section class="section case-features pb-medium">
               <div class="container">
                  <h2 class="case-study__heading">Co znalazło się na stronie</h2>
                  <div class="case-features__grid">
<?php foreach ($case['features'] as [$icon, $name, $text]) : ?>
                     <div class="case-feature">
                        <i class="material-icons case-feature__icon" aria-hidden="true"><?php echo $e($icon); ?></i>
                        <h3 class="case-feature__title"><?php echo $e($name); ?></h3>
                        <p class="case-feature__text"><?php echo $e($text); ?></p>
                     </div>
<?php endforeach; ?>
                  </div>
               </div>
            </section>

            <section class="section case-cta pb-large">
               <div class="container">
                  <div class="case-cta__box">
                     <div class="case-cta__text">
                        <h2 class="case-cta__title">Potrzebujesz podobnej strony?</h2>
                        <p>Zaprojektujemy i wdrożymy stronę dopasowaną do Twojej branży — szybką, responsywną i przygotowaną pod Google oraz wyszukiwarki AI. Wycena jest bezpłatna.</p>
                     </div>
                     <div class="case-cta__actions">
                        <a href="<?php echo ABS_URL; ?>kontakt.php" class="button btn-light">
                           <span class="button__label button__label-normal"><span class="button__title">Bezpłatna wycena</span></span>
                           <span class="button__label button__label-hover"><span class="button__title">Bezpłatna wycena</span></span>
                        </a>
                        <a class="case-cta__more" href="<?php echo ABS_URL; ?>uslugi/tworzenie-stron-www.php">Tworzenie stron www</a>
                     </div>
                  </div>
                  <nav class="case-nav" aria-label="Inne realizacje">
                     <a class="case-nav__back" href="<?php echo ABS_URL; ?>realizacje/index.php">
                        <i class="material-icons" aria-hidden="true">arrow_back</i><span>Wszystkie realizacje</span>
                     </a>
<?php if (! empty($case['next'])) : ?>
                     <a class="case-nav__next" href="<?php echo ABS_URL . 'realizacje/' . $e($case['next'][1]); ?>">
                        <span>Następna: <?php echo $e($case['next'][0]); ?></span><i class="material-icons" aria-hidden="true">arrow_forward</i>
                     </a>
<?php endif; ?>
                  </nav>
               </div>
            </section>
