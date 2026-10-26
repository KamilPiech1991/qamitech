         
<?php 
   $title = 'Sieci LAN WLAN Piaseczno, Warszawa - instalacja i serwis | Qamitech';
   $description = 'Projektowanie i instalacja sieci LAN, WLAN, Wi-Fi dla firm w Piasecznie, Warszawie i okolicach. Bezprzewodowe sieci biurowe, konfiguracja routerów i switchy.';
   $faq = [
      ['q' => 'Co obejmuje instalacja sieci w biurze?', 'a' => 'Projekt sieci, okablowanie strukturalne, montaż i konfigurację routerów, przełączników i punktów dostępowych Wi-Fi oraz zabezpieczenie sieci przed nieautoryzowanym dostępem.'],
      ['q' => 'Czy serwisujecie istniejące sieci?', 'a' => 'Tak — diagnozujemy i usuwamy awarie, aktualizujemy oprogramowanie urządzeń sieciowych i dbamy o ich konserwację.'],
      ['q' => 'Gdzie instalujecie sieci?', 'a' => 'W firmach z Piaseczna, Warszawy i okolic Mazowsza. Zadzwoń: <a href="tel:+48501784882">501 784 882</a>.'],
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
                        Nasza firma specjalizuje się w projektowaniu, instalacji oraz serwisowaniu sieci LAN i WLAN. Jesteśmy zespołem doświadczonych specjalistów posiadających wiedzę i umiejętności niezbędne do dostarczenia rozwiązań sieciowych na najwyższym poziomie.
                        </p>
                        <h3>
                        Nasze usługi obejmują:
                        </h3>
                        <ul>
                           <li>
                           Projektowanie i instalację sieci LAN: oferujemy kompleksowe usługi projektowania i instalacji sieci LAN, w tym wykonanie okablowania strukturalnego, instalację urządzeń sieciowych, konfigurację routerów i przełączników oraz dostarczenie rozwiązań zabezpieczających sieć.
                           </li>
                           <li>
                           Projektowanie i instalację sieci WLAN: oferujemy usługi projektowania i instalacji sieci WLAN, w tym dostarczenie rozwiązań bezprzewodowych, konfigurację punktów dostępowych oraz dostarczenie rozwiązań zabezpieczających sieć.
                           </li>
                           <li>
                           Serwisowanie sieci: oferujemy usługi serwisowania sieci LAN i WLAN, w tym diagnozowanie i naprawianie awarii, aktualizacje oprogramowania i konserwację urządzeń sieciowych.
                           </li>
                           <li>
                           Usługi związane z bezpieczeństwem: oferujemy usługi związane z bezpieczeństwem sieci, w tym tworzenie kopii zapasowych, ochrona danych, ochrona przed atakami hakerskimi i dostarczanie rozwiązań zabezpieczających sieć.
                           </li>
                        </ul>
                        <h4>
                        Nasze usługi są świadczone na najwyższym poziomie i dostosowane do indywidualnych potrzeb klienta. Zapraszamy do skorzystania z naszych usług.
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