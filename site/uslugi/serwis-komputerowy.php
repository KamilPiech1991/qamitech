         
<?php 
   $title = 'Serwis komputerowy Piaseczno – naprawa laptopów i komputerów | Qamitech';
   $description = 'Profesjonalny serwis komputerowy w Piasecznie i Warszawie. Naprawa laptopów, komputerów, odzyskiwanie danych. Szybka realizacja. Zadzwoń: 501 784 882';
   $faq = [
      ['q' => 'Jakie usterki naprawiacie?', 'a' => 'Naprawiamy laptopy, komputery stacjonarne i tablety: awarie dysków, płyt głównych i kart graficznych, problemy z systemem i oprogramowaniem, przegrzewanie (czyszczenie i konserwacja), a także konfigurujemy routery i sieci.'],
      ['q' => 'Czy odzyskujecie dane z uszkodzonego dysku?', 'a' => 'Tak, pomagamy odzyskać dane i zabezpieczyć je na przyszłość — konfigurujemy kopie zapasowe, które chronią przed utratą plików przy kolejnej awarii.'],
      ['q' => 'Czy przyjeżdżacie do klienta?', 'a' => 'Tak. Firmy obsługujemy na miejscu w Piasecznie, Warszawie i okolicach, a klientów prywatnych w ramach usługi <a href="pomoc-domowa.php">pomoc informatyczna w domu</a>.'],
      ['q' => 'Jak zgłosić sprzęt do naprawy?', 'a' => 'Zadzwoń pod numer <a href="tel:+48501784882">501 784 882</a> lub napisz na <a href="mailto:kontakt@qamitech.pl">kontakt@qamitech.pl</a> i opisz problem. Pracujemy od poniedziałku do piątku w godzinach 9:00–17:00.'],
   ];
?>
         <!-- PAGE HEADER -->

         <?php require_once( '../include/header.php' ); ?>

            <!-- PAGE CONTENT -->
            <main class="page-wrapper__content">

            <?php include( '../part/hero-page.php' ); ?>
               
            <section class="section section-content pb-large">
               <div class="container">
                  <div class="row">
                     <div class="col-md-8">
                     <div class="section-content__content content arts-split-text">
                     <p>
                     Nasz serwis komputerowy oferuje szeroki zakres usług związanych z naprawą i konserwacją sprzętu komputerowego. Nasz zespół składa się z doświadczonych specjalistów, którzy szybko i skutecznie rozwiązują problemy związane z laptopami, komputerami stacjonarnymi, tabletami oraz innymi urządzeniami elektronicznymi.
                  </p>
                  <h3>
                  Nasze usługi obejmują
                  </h3>
                  <ul>
                     <li>
                     Naprawę sprzętu: diagnozujemy i naprawiamy usterki sprzętu komputerowego, takie jak awarie dysku twardego, problemy z płytą główną, kartami graficznymi, itp.
                     </li>
                     <li>
                     Konserwację sprzętu: dbamy o stan techniczny sprzętu, wykonując czyszczenie, aktualizacje systemowe, instalacje oprogramowania, itp.
                     </li>
                     <li>
                     Usługi związane z oprogramowaniem: pomagamy w instalacji i konfiguracji systemów operacyjnych, oprogramowania antywirusowego, oprogramowania biurowego, itp.
                     </li>
                     <li>
                     Usługi związane z sieciami: projektujemy i instalujemy sieci komputerowe, dostarczamy rozwiązania zabezpieczające sieci, konfigurujemy routery, modemy, itp.
                     </li>
                     <li>
                     Usługi związane z bezpieczeństwem: oferujemy szeroki zakres usług związanych z bezpieczeństwem, w tym tworzenie kopii zapasowych, ochrona danych, ochrona przed atakami hakerskimi, itp.
                     </li>
                  </ul>
                  <h4>
                  Wszystkie nasze usługi są świadczone na najwyższym poziomie, a nasz zespół jest do dyspozycji klientów od poniedziałku do piątku w godzinach 9:00–17:00. Zapraszamy do skorzystania z naszych usług!
                  </h4>
                  </div>
                     </div>
                  </div>
               </div>
            </section>

<?php include( __DIR__ . '/../part/faq.php' ); ?>
            </main>

            <!-- PAGE FOOTER -->
            <?php require_once( '../include/footer.php' ); ?>