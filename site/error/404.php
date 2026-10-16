<?php
   http_response_code(404);
   $title  = 'Nie znaleziono strony (błąd 404)';
   $robots = 'noindex, follow';
   require_once( __DIR__ . '/../include/header.php' ); ?>
          <!-- section 404 -->
          <section class="section section-content pt-large pb-large">
            <div class="section__content container">
              <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                  <div class="section-content__content content">
                    <h1 class="xxl mb-0">Błąd 404</h1>
                    <p class="h3">Wygląda na to, że takiej strony nie ma.</p>
                    <p>Sprawdź <a href="<?php home_url(); ?>oferta.php">ofertę</a>, <a href="<?php home_url(); ?>blog/index.php">blog</a>
                      albo <a href="<?php home_url(); ?>kontakt.php">napisz do nas</a> — tel. <a href="tel:+48501784882">501 784 882</a>.</p>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- - section 404 -->
        </main>
<?php require_once( __DIR__ . '/../include/footer.php' ); ?>
