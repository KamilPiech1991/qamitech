<?php 
   $page='home'; 
   $title = 'Obsługa IT i tworzenie stron Piaseczno, Warszawa | Qamitech';
   $description = 'Obsługa informatyczna firm, tworzenie stron internetowych, kampanie Google Ads i pozycjonowanie SEO w Piasecznie, Warszawie i okolicach. Sprawdź naszą ofertę!';?>
   <?php require_once( 'include/header.php' ); ?>
   <?php 
      include( 'module/hero.php' ); 
      include( 'module/your-contact.php' ); 
      include( 'module/services.php' ); 
      include( 'module/how-we-work.php' ); 
      include( 'module/qamitech-number.php' ); 
      include( 'module/high-level.php' ); 
      include( 'module/outsourcing.php' ); 
      include( 'module/latest-posts.php' ); 
      include( 'module/contact-with-us.php' ); 
   ?>
   <!-- Sekcja lokalna - obsługiwane miasta -->
   <section class="section section-content py-large bg-dark-2" data-arts-theme-text="light">
      <div class="container">
         <div class="section-content__content content arts-split-text pb-medium">
            <h2>Działamy lokalnie — IT i strony www w Twoim mieście</h2>
            <p>Obsługujemy firmy z Piaseczna, Warszawy i okolic Mazowsza. Wybierz swoje miasto:</p>
         </div>
         <div class="row g-3">
            <div class="col-6 col-md-4 col-lg-2"><a href="uslugi/uslugi-it-piaseczno.php" class="d-block text-center p-3 border border-secondary rounded" style="color:#fff;text-decoration:none;background:rgba(255,255,255,.05);transition:.2s;" onmouseover="this.style.background='rgba(163,217,0,.15)'" onmouseout="this.style.background='rgba(255,255,255,.05)'"><i class="material-icons d-block mb-2" style="color:var(--color-accent-1);font-size:28px;">location_on</i><strong>Piaseczno</strong></a></div>
            <div class="col-6 col-md-4 col-lg-2"><a href="uslugi/uslugi-it-warszawa.php" class="d-block text-center p-3 border border-secondary rounded" style="color:#fff;text-decoration:none;background:rgba(255,255,255,.05);transition:.2s;" onmouseover="this.style.background='rgba(163,217,0,.15)'" onmouseout="this.style.background='rgba(255,255,255,.05)'"><i class="material-icons d-block mb-2" style="color:var(--color-accent-1);font-size:28px;">location_city</i><strong>Warszawa</strong></a></div>
            <div class="col-6 col-md-4 col-lg-2"><a href="uslugi/uslugi-it-pruszkow.php" class="d-block text-center p-3 border border-secondary rounded" style="color:#fff;text-decoration:none;background:rgba(255,255,255,.05);transition:.2s;" onmouseover="this.style.background='rgba(163,217,0,.15)'" onmouseout="this.style.background='rgba(255,255,255,.05)'"><i class="material-icons d-block mb-2" style="color:var(--color-accent-1);font-size:28px;">location_on</i><strong>Pruszków</strong></a></div>
            <div class="col-6 col-md-4 col-lg-2"><a href="uslugi/uslugi-it-konstancin.php" class="d-block text-center p-3 border border-secondary rounded" style="color:#fff;text-decoration:none;background:rgba(255,255,255,.05);transition:.2s;" onmouseover="this.style.background='rgba(163,217,0,.15)'" onmouseout="this.style.background='rgba(255,255,255,.05)'"><i class="material-icons d-block mb-2" style="color:var(--color-accent-1);font-size:28px;">location_on</i><strong>Konstancin</strong></a></div>
            <div class="col-6 col-md-4 col-lg-2"><a href="uslugi/uslugi-it-grodzisk-mazowiecki.php" class="d-block text-center p-3 border border-secondary rounded" style="color:#fff;text-decoration:none;background:rgba(255,255,255,.05);transition:.2s;" onmouseover="this.style.background='rgba(163,217,0,.15)'" onmouseout="this.style.background='rgba(255,255,255,.05)'"><i class="material-icons d-block mb-2" style="color:var(--color-accent-1);font-size:28px;">location_on</i><strong>Grodzisk Maz.</strong></a></div>
            <div class="col-6 col-md-4 col-lg-2"><a href="kontakt.php" class="d-block text-center p-3 border border-secondary rounded" style="color:#fff;text-decoration:none;background:rgba(255,255,255,.05);transition:.2s;" onmouseover="this.style.background='rgba(163,217,0,.15)'" onmouseout="this.style.background='rgba(255,255,255,.05)'"><i class="material-icons d-block mb-2" style="color:var(--color-accent-1);font-size:28px;">add_location</i><strong>Inne miasto?</strong></a></div>
         </div>
      </div>
   </section>
   </main>
   <?php require_once( 'include/footer.php' ); ?>

