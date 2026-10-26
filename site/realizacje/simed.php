<?php
   $page  = 'realizacje';
   $title = 'Simed – strona producenta sprzętu medycznego | Realizacja Qamitech';
   $description = 'Realizacja Qamitech: strona internetowa SIMED Sp. z o.o. z Łomianek – producenta łóżek rehabilitacyjnych, szpitalnych i sprzętu medycznego. Katalog produktów, 3 wersje językowe, WordPress.';
   $breadcrumb = 'Simed';
   $h1 = 'Simed — strona producenta sprzętu medycznego';
   $hero_lead = 'Strona firmowa z katalogiem produktów dla polskiego producenta łóżek rehabilitacyjnych, szpitalnych i wyposażenia sal zabiegowych, działającego w Europie i Azji.';
   $hero_badge = 'WordPress · 3 języki';
   $hero_chip = 'simed.net.pl';
   $hero_image = ['../assets/img/realizacje/case/simed-desktop.jpg', 'Strona główna simed.net.pl – producent łóżek rehabilitacyjnych i sprzętu medycznego'];
   $hero_cta = ['Chcę podobną stronę', '../kontakt.php'];
   $case = [
      'client'       => 'Simed',
      'client_legal' => 'SIMED Sp. z o.o.',
      'url'          => 'https://simed.net.pl/',
      'domain'       => 'simed.net.pl',
      'type'         => 'Strona firmowa z katalogiem produktów',
      'industry'     => 'Producent sprzętu medycznego i rehabilitacyjnego',
      'location'     => 'Łomianki',
      'languages'    => 'polski, angielski, arabski',
      'tech'         => ['WordPress', 'WooCommerce'],
      'image'        => 'assets/img/realizacje/case/simed-desktop.jpg',
      'intro'        => [
         'SIMED to rodzinna firma z Łomianek ze 100% polskim kapitałem, działająca na rynku od 1998 roku. Projektuje i produkuje łóżka rehabilitacyjne i szpitalne oraz wyposaża w sprzęt medyczny szpitale, kliniki rehabilitacyjne, domy pomocy społecznej i gabinety — w Polsce i za granicą. Obsługuje rynki w Europie i Azji i ma przedstawicielstwo w Chinach.',
         'Strona prezentuje szeroką ofertę producenta w czytelnym katalogu: od łóżek pielęgnacyjnych, szpitalnych i rehabilitacyjnych, przez wyposażenie sal zabiegowych i bloków operacyjnych, po drony gaśnicze i logistyczne. Odbiorcami są profesjonaliści z branży medycznej, dlatego przed wejściem na stronę użytkownik potwierdza, że wykonuje zawód medyczny lub prowadzi obrót wyrobami medycznymi.',
      ],
      'features'     => [
         ['view_quilt', 'Katalog produktów', 'Produkty w kategoriach: łóżka pielęgnacyjne, szpitalne i rehabilitacyjne, wyposażenie sal zabiegowych i bloków operacyjnych, drony gaśnicze i logistyczne.'],
         ['translate', 'Trzy wersje językowe', 'Przełącznik języka polskiego, angielskiego i arabskiego w nagłówku — dla klientów z Europy i Azji.'],
         ['lock', 'Strefa dla profesjonalistów', 'Komunikat przy wejściu na stronę: treści są przeznaczone dla osób wykonujących zawód medyczny lub prowadzących obrót wyrobami medycznymi.'],
         ['picture_as_pdf', 'Katalogi i certyfikaty', 'Osobna sekcja z katalogami produktów i certyfikatami, a w nagłówku stały przycisk „Pobierz ofertę”.'],
         ['description', 'Nowości, aktualności i realizacje', 'Sekcje z nowymi produktami, wiadomościami firmy i zrealizowanymi projektami, m.in. modernizacją Górnośląskiego Centrum Rehabilitacji „Repty”.'],
         ['devices', 'Wersja mobilna', 'Responsywny układ z rozwijanym menu produktów, czytelny na telefonach i tabletach.'],
      ],
      'shots'        => [
         ['../assets/img/realizacje/case/simed-desktop.jpg', 'Strona główna Simed w wersji na komputer', 'desktop'],
         ['../assets/img/realizacje/case/simed-mobile.jpg', 'Strona główna Simed na telefonie', 'mobile'],
      ],
      'next'         => ['Bogdan Grzeszczyk', 'bogdan-grzeszczyk.php'],
   ];
?>
<!-- PAGE HEADER -->
<?php require_once( '../include/header.php' ); ?>

<?php include( '../part/hero-page.php' ); ?>
<?php include( '../part/case-study.php' ); ?>

<!-- PAGE FOOTER -->
<?php require_once( '../include/footer.php' ); ?>
