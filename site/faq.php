<?php
   $page  = 'faq';
   $title = 'FAQ – pytania o obsługę IT, strony www i SEO | Qamitech Piaseczno';
   $description = 'Najczęstsze pytania: ile kosztuje outsourcing IT i strona www, czas reakcji na awarie, obszar działania, SEO, AEO i GEO, szkolenia z AI. Qamitech, Piaseczno.';
   $breadcrumb = 'FAQ';
   $faqTitle = 'Obsługa IT, strony www i marketing — najczęstsze pytania';
   $faq = [
      ['q' => 'Czym zajmuje się Qamitech?', 'a' => 'Qamitech to lokalna firma IT ze Starej Iwicznej koło Piaseczna. Zajmujemy się obsługą informatyczną firm (outsourcing IT, serwis komputerowy, sieci LAN i Wi-Fi, bezpieczeństwo danych) oraz marketingiem internetowym: tworzymy strony i sklepy, prowadzimy kampanie Google Ads, pozycjonujemy strony w Google i w wynikach AI oraz prowadzimy szkolenia z AI.'],
      ['q' => 'Na jakim obszarze działacie?', 'a' => 'Obsługujemy firmy i klientów z Piaseczna, Warszawy, Konstancina-Jeziorny, Pruszkowa, Grodziska Mazowieckiego, Lesznowoli, Mysiadła i okolic Mazowsza. Nasze biuro mieści się przy ul. Cichej 3 w Starej Iwicznej. Jeśli Twojej miejscowości nie ma na liście — <a href="kontakt.php">napisz do nas</a>.'],
      ['q' => 'Ile kosztuje stała obsługa informatyczna firmy?', 'a' => 'Cena outsourcingu IT zależy od liczby stanowisk, oddziałów i serwerów, wieku sprzętu oraz wymaganego czasu reakcji. Konkretną ofertę przygotujemy po wypełnieniu <a href="outsourcing.php#calc">kalkulatora outsourcingu IT</a>. Wycena jest bezpłatna.'],
      ['q' => 'Jak szybko reagujecie na awarie?', 'a' => 'Czas reakcji na zgłoszenia krytyczne ustalamy w umowie — do wyboru są 2, 12 lub 24 godziny. Pomagamy zdalnie, telefonicznie i na miejscu, w dni robocze od 9:00 do 17:00.'],
      ['q' => 'Ile kosztuje strona internetowa dla firmy?', 'a' => 'Orientacyjnie: strona wizytówkowa (1–5 podstron) od 800 do 2500 zł, strona firmowa z blogiem (5–15 podstron) od 2500 do 8000 zł, sklep internetowy WooCommerce od 4000 do ponad 20 000 zł. Szczegóły na stronie <a href="uslugi/tworzenie-stron-www.php">tworzenie stron internetowych</a>.'],
      ['q' => 'Kiedy widać efekty pozycjonowania strony?', 'a' => 'Pierwsze efekty SEO widać zwykle po 2–3 miesiącach, a w przypadku fraz lokalnych (np. „serwis komputerowy Piaseczno”) często szybciej. Kampanie Google Ads dają ruch od pierwszego dnia.'],
      ['q' => 'Czym są AEO i GEO?', 'a' => 'AEO (Answer Engine Optimization) to przygotowanie treści tak, by Google cytował je w odpowiedziach AI Overview. GEO (Generative Engine Optimization) zwiększa szansę, że firmę polecą ChatGPT, Gemini czy Perplexity. Więcej na stronie <a href="uslugi/pozycjonowanie-stron.php">pozycjonowanie SEO, AEO i GEO</a>.'],
      ['q' => 'Czy pierwsza konsultacja jest płatna?', 'a' => 'Nie. Pierwsza konsultacja i wycena są bezpłatne — dotyczy to obsługi IT, stron internetowych, Google Ads i pozycjonowania.'],
      ['q' => 'Czy pomagacie klientom prywatnym?', 'a' => 'Tak, w ramach usługi <a href="uslugi/pomoc-domowa.php">pomoc informatyczna w domu</a> dojeżdżamy do klienta: naprawiamy komputery, instalujemy system, konfigurujemy Wi-Fi i kopie zapasowe.'],
      ['q' => 'Czy prowadzicie szkolenia z AI dla firm?', 'a' => 'Tak — praktyczne, stacjonarne szkolenia z AI w marketingu, budowania agentów AI, automatyzacji procesów (n8n, Make, Zapier), Google Ads, WordPress i cyberbezpieczeństwa, dla grup 5–30 osób i indywidualnie. Zobacz <a href="uslugi/szkolenia-it.php">program szkoleń</a>.'],
      ['q' => 'Jak wygląda rozpoczęcie współpracy?', 'a' => 'Poznajemy potrzeby firmy, sprawdzamy obecną infrastrukturę IT, proponujemy jasny zakres współpracy (usługi, zasady kontaktu, czas reakcji), a potem przejmujemy bieżącą opiekę. Zaczynamy od rozmowy — zadzwoń: <a href="tel:+48501784882">501 784 882</a>.'],
      ['q' => 'Jak się z wami skontaktować?', 'a' => 'Telefonicznie pod numerem <a href="tel:+48501784882">501 784 882</a>, mailowo: <a href="mailto:kontakt@qamitech.pl">kontakt@qamitech.pl</a> lub przez <a href="kontakt.php">formularz kontaktowy</a>. Pracujemy od poniedziałku do piątku, 9:00–17:00.'],
   ];

   require_once( 'include/header.php' ); ?>
<?php include( 'part/hero-page.php' ); ?>
<?php include( 'part/faq.php' ); ?>
</main>
<?php require_once( 'include/footer.php' ); ?>
