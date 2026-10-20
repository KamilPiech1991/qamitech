<?php
/*
 * Podstrona pojedynczej realizacji (case study).
 * Plik realizacje/<slug>.php ustawia $slug i dołącza ten szablon; treści są w realizacje/data.php.
 */
require_once __DIR__ . '/../include/functions.php';
$projects = require __DIR__ . '/../realizacje/data.php';
if (! isset($projects[$slug]) || ! $projects[$slug]['page']) {
    http_response_code(404);
    exit;
}
$p = $projects[$slug];

$page        = 'realizacje';
$title       = $p['name'] . ' — realizacja ' . ($p['cat'] === 'shop' ? 'sklepu internetowego' : 'strony internetowej');
$description = $p['seo'] ?: $p['business'];

$e   = function ($text) { return htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); };
$img = function ($file) use ($slug) { return ABS_URL . 'assets/img/realizacje/' . $slug . '/' . $file; };

$ogImage = isset($p['images']['hero']) ? $img($p['images']['hero']) : null;

// Inne realizacje: trzy kolejne z listy (z zawinięciem na początek).
$slugs   = array_keys(array_filter($projects, function ($item) { return $item['page']; }));
$index   = array_search($slug, $slugs, true);
$related = [];
for ($i = 1; count($related) < 3 && $i < count($slugs); $i++) {
    $related[] = $slugs[($index + $i) % count($slugs)];
}

require __DIR__ . '/../include/header.php';
?>

<!-- CASE STUDY: HERO -->
<section class="section section-content case-hero pt-xlarge pt-md-large pb-small">
  <div class="pt-medium desk-none"></div>
  <div class="container">
    <div class="breadcrumbs-wrap">
      <a href="<?php home_url(); ?>index.php"><i class="material-icons">home</i><span>Główna</span></a>
      <i class="material-icons">navigate_next</i><a href="<?php home_url(); ?>realizacje/index.php"><span>Realizacje</span></a>
      <i class="material-icons">navigate_next</i><span><?php echo $e($p['name']); ?></span>
    </div>
    <div class="row align-items-end mt-4">
      <div class="col-lg-8">
        <p class="case-hero__label"><?php echo $e($p['label']); ?> · <?php echo $e($p['industry']); ?></p>
        <h1 class="case-hero__title"><?php echo $e($p['name']); ?></h1>
        <p class="case-hero__lead"><?php echo $e($p['business']); ?></p>
      </div>
      <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
        <?php if ($p['live']) : ?>
        <a class="button btn-dark" href="<?php echo $e($p['url']); ?>" target="_blank" rel="noopener nofollow">
          <span class="button__label button__label-normal">
            <span class="button__title">Zobacz stronę na żywo</span>
          </span>
          <span class="button__label button__label-hover">
            <span class="button__title">Zobacz stronę na żywo</span>
          </span>
        </a>
        <?php endif; ?>
      </div>
    </div>

    <dl class="case-facts">
      <div class="case-facts__item">
        <dt>Klient</dt>
        <dd><?php echo $e($p['name']); ?></dd>
      </div>
      <div class="case-facts__item">
        <dt>Branża</dt>
        <dd><?php echo $e($p['industry']); ?></dd>
      </div>
      <?php if ($p['location']) : ?>
      <div class="case-facts__item">
        <dt>Lokalizacja</dt>
        <dd><?php echo $e($p['location']); ?></dd>
      </div>
      <?php endif; ?>
      <div class="case-facts__item">
        <dt>Zakres</dt>
        <dd><?php echo $e($p['scope']); ?></dd>
      </div>
      <div class="case-facts__item">
        <dt>Technologia</dt>
        <dd><?php echo $e(implode(', ', array_slice($p['tech'], 0, 3))); ?></dd>
      </div>
    </dl>
  </div>
</section>

<?php if (isset($p['images']['hero'])) : ?>
<!-- CASE STUDY: GŁÓWNY ZRZUT -->
<section class="section case-cover pb-medium">
  <div class="container">
    <figure class="case-frame case-frame_browser">
      <div class="case-frame__bar" aria-hidden="true"><span></span><span></span><span></span><em><?php echo $e(preg_replace('#^https?://(www\.)?#', '', rtrim($p['url'], '/'))); ?></em></div>
      <img src="<?php echo $img($p['images']['hero']); ?>" width="1200" height="750" fetchpriority="high"
        alt="Strona główna — <?php echo $e($p['name']); ?>" />
    </figure>
  </div>
</section>
<?php endif; ?>

<!-- CASE STUDY: O KLIENCIE / WYZWANIE / ROZWIĄZANIE -->
<section class="section section-content case-story py-medium">
  <div class="container">
    <div class="row case-story__row">
      <div class="col-lg-4">
        <span class="case-story__num">01</span>
        <h2 class="h3">O kliencie</h2>
      </div>
      <div class="col-lg-8 content">
        <p><?php echo $e($p['about']); ?></p>
      </div>
    </div>
    <div class="row case-story__row">
      <div class="col-lg-4">
        <span class="case-story__num">02</span>
        <h2 class="h3">Wyzwanie</h2>
      </div>
      <div class="col-lg-8 content">
        <p><?php echo $e($p['challenge']); ?></p>
      </div>
    </div>
    <div class="row case-story__row">
      <div class="col-lg-4">
        <span class="case-story__num">03</span>
        <h2 class="h3">Rozwiązanie</h2>
      </div>
      <div class="col-lg-8 content">
        <p><?php echo $e($p['solution']); ?></p>
        <ul class="case-points">
          <?php foreach ($p['points'] as $point) : ?>
          <li><?php echo $e($point); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php if (! empty($p['images']['shots']) || isset($p['images']['mobile'])) : ?>
<!-- CASE STUDY: GALERIA -->
<section class="section section-content case-gallery py-large bg-dark-2" data-arts-theme-text="light">
  <div class="container">
    <div class="content pb-small">
      <h2 class="h3">Jak wygląda strona</h2>
    </div>
    <div class="row g-4 align-items-start">
      <div class="<?php echo isset($p['images']['mobile']) ? 'col-lg-8' : 'col-12'; ?>">
        <?php foreach ($p['images']['shots'] as $i => $shot) : ?>
        <figure class="case-frame case-frame_browser<?php echo $i ? ' mt-4' : ''; ?>">
          <div class="case-frame__bar" aria-hidden="true"><span></span><span></span><span></span></div>
          <img src="<?php echo $img($shot); ?>" width="1200" height="750" loading="lazy"
            alt="<?php echo $e($p['name']); ?> — widok strony na komputerze (<?php echo $i + 1; ?>)" />
        </figure>
        <?php endforeach; ?>
      </div>
      <?php if (isset($p['images']['mobile'])) : ?>
      <div class="col-lg-4">
        <figure class="case-frame case-frame_phone">
          <img src="<?php echo $img($p['images']['mobile']); ?>" width="390" height="844" loading="lazy"
            alt="<?php echo $e($p['name']); ?> — widok strony na telefonie" />
        </figure>
        <p class="case-gallery__caption">Wersja mobilna — układ zaprojektowany z myślą o telefonach.</p>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- CASE STUDY: TECHNOLOGIE I FUNKCJE -->
<section class="section section-content case-stack py-medium">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h2 class="h3">Z czego zbudowaliśmy stronę</h2>
        <ul class="case-chips case-chips_accent">
          <?php foreach ($p['tech'] as $tech) : ?>
          <li><?php echo $e($tech); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="col-lg-6 mt-5 mt-lg-0">
        <h2 class="h3">Co znajdziesz na stronie</h2>
        <ul class="case-chips">
          <?php foreach ($p['features'] as $feature) : ?>
          <li><?php echo $e($feature); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- CASE STUDY: CTA -->
<section class="section section-content case-cta pb-medium">
  <div class="container">
    <div class="case-cta__box bg-dark-1" data-arts-theme-text="light">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <h2 class="h3">Chcesz podobną stronę dla swojej firmy?</h2>
          <p>Opowiedz nam o swoim biznesie — przygotujemy propozycję strony dopasowaną do Twoich klientów i celów.</p>
        </div>
        <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
          <a class="button btn-light" href="<?php home_url(); ?>kontakt.php">
            <span class="button__label button__label-normal">
              <span class="button__title">Porozmawiajmy</span>
            </span>
            <span class="button__label button__label-hover">
              <span class="button__title">Porozmawiajmy</span>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CASE STUDY: INNE REALIZACJE -->
<section class="section section-content case-related pb-large">
  <div class="container">
    <div class="d-flex justify-content-between align-items-end flex-wrap pb-small">
      <h2 class="h3 mb-0">Inne realizacje</h2>
      <a class="case-related__all" href="<?php home_url(); ?>realizacje/index.php">Wszystkie realizacje →</a>
    </div>
    <div class="row g-4">
      <?php foreach ($related as $r) : $rp = $projects[$r]; ?>
      <div class="col-md-4">
        <a class="case-card" href="<?php home_url(); ?>realizacje/<?php echo $r; ?>.php">
          <span class="case-card__img"><img src="<?php echo ABS_URL . 'assets/img/realizacje/' . $r . '/' . $rp['images']['thumb']; ?>"
            width="430" height="300" loading="lazy" alt="<?php echo $e($rp['name']); ?>" /></span>
          <span class="case-card__label"><?php echo $e($rp['label']); ?></span>
          <span class="case-card__title"><?php echo $e($rp['name']); ?></span>
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</main>
<?php require __DIR__ . '/../include/footer.php'; ?>
