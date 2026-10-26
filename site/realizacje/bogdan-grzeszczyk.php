<?php
   $page  = 'realizacje';
   $title = 'Bogdan Grzeszczyk – strona fotografa i filmowca | Realizacja Qamitech';
   $description = 'Realizacja Qamitech: strona-portfolio Bogdana Grzeszczyka – fotografa i filmowca (fotografia i film biznesowy, eventowy, z drona). Galerie w kategoriach, WordPress.';
   $breadcrumb = 'Bogdan Grzeszczyk';
   $h1 = 'Bogdan Grzeszczyk — strona fotografa i filmowca';
   $hero_lead = 'Ciemna, minimalistyczna strona-portfolio, która od pierwszego ekranu prowadzi klienta do jednej z dwóch usług: fotografii albo filmowania.';
   $hero_badge = 'Portfolio · WordPress';
   $hero_chip = 'bogdangrzeszczyk.pl';
   $hero_image = ['../assets/img/realizacje/case/bogdangrzeszczyk-desktop.jpg', 'Strona główna bogdangrzeszczyk.pl – wybór usługi: fotografia lub filmowanie'];
   $hero_cta = ['Chcę podobną stronę', '../kontakt.php'];
   $case = [
      'client'   => 'Bogdan Grzeszczyk',
      'url'      => 'https://bogdangrzeszczyk.pl/',
      'domain'   => 'bogdangrzeszczyk.pl',
      'type'     => 'Strona-portfolio',
      'industry' => 'Fotografia i produkcja wideo',
      'tech'     => ['WordPress'],
      'image'    => 'assets/img/realizacje/case/bogdangrzeszczyk-desktop.jpg',
      'intro'    => [
         'Bogdan Grzeszczyk to fotograf i filmowiec, który od ponad 10 lat specjalizuje się w realizacjach biznesowych i eventowych oraz w zdjęciach i filmach z drona. Współpracuje z dużymi firmami krajowymi i międzynarodowymi.',
         'Strona ma pokazywać przede wszystkim prace, dlatego tekst jest krótki, a ciemne tło eksponuje zdjęcia i filmy. Na stronie głównej klient od razu wybiera, czego szuka — fotografii czy filmowania — i trafia do galerii podzielonych na rodzaje realizacji.',
      ],
      'features' => [
         ['photo_camera', 'Fotografia', 'Galerie zdjęć eventowych, biznesowych i z drona — każda kategoria na osobnej podstronie.'],
         ['videocam', 'Filmowanie', 'Realizacje w podziale na film eventowy, reklamowy, biznesowy wizerunkowy, rolki dla biznesu i ujęcia z drona.'],
         ['touch_app', 'Wybór usługi na start', 'Strona główna podzielona na dwie części — „Fotografia” i „Filmowanie” — bez zbędnego przewijania.'],
         ['phone_in_talk', 'Kontakt w jednym kliknięciu', 'Numer telefonu w nagłówku każdej podstrony i formularz kontaktowy z adresem e-mail.'],
         ['business', 'O mnie i klienci', 'Podstrona z opisem doświadczenia i logotypami firm, dla których powstały realizacje.'],
         ['gavel', 'Dokumenty prawne', 'Polityka prywatności, regulamin i informacja o RODO dostępne w stopce.'],
      ],
      'shots'    => [
         ['../assets/img/realizacje/case/bogdangrzeszczyk-desktop.jpg', 'Strona główna Bogdana Grzeszczyka – wybór: fotografia lub filmowanie', 'desktop'],
         ['../assets/img/realizacje/case/bogdangrzeszczyk-fotografia.jpg', 'Podstrona Fotografia na bogdangrzeszczyk.pl', 'desktop'],
      ],
      'next'     => ['Simed', 'simed.php'],
   ];
?>
<!-- PAGE HEADER -->
<?php require_once( '../include/header.php' ); ?>

<?php include( '../part/hero-page.php' ); ?>
<?php include( '../part/case-study.php' ); ?>

<!-- PAGE FOOTER -->
<?php require_once( '../include/footer.php' ); ?>
