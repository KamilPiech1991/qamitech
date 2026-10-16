        <!-- PAGE FOOTER -->
        <footer class="footer pt-large bg-dark-1" id="page-footer" data-arts-theme-text="light"
          data-arts-fixed-reveal="data-arts-fixed-reveal" data-arts-fixed-reveal-from="-20vh"
          data-arts-fixed-reveal-from-opacity="0">
          <div class="footer__inner">
            <div class="container">
              <!-- widget area #1 -->
              <div class="row pb-md-3">
                <div class="col-md-6">
                  <section class="widget widget_text">
                    <div class="textwidget widget-logo">
                      <img src="<?php home_url(); ?>assets/img/logo/logo-qamitech-white.png" alt="">
                    </div>
                  </section>
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-end mob-none">
                  <section class="widget widget_text">
                    <div class="textwidget">
                      <span>Zainteresowany?</span>
                      <a href="<?php home_url(); ?>oferta.php" class="button btn-light">
                        Zobacz naszą ofertę
                      </a>
                    </div>
                  </section>
                </div>
              </div>
              <!-- widget area #2 -->
              <div class="row justify-content-between position-relative pt-md-5 pt-4 pb-md-3">
                <div class="footer__divider"></div>
                <div class="col-lg-5 col-sm-6">
                  <section class="widget widget_nav_menu">
                    <h2 class="widgettitle h3 mt-0">Subskrybuj nasz newsletter <br class="mob-none" />i bądź na bieżąco!
                    </h2>
                    <div class="newsletter-form">
                      <form class="form form-contact js-ajax-form form-dark" action="<?php home_url(); ?>forms/newsletter.php" method="POST"
                            data-message-success="Zapisałeś się do newslettera"
                            data-message-error="Coś poszło nie tak :(">
                        <label class="input-float js-input-float d-flex">
                          <input class="input-float__input" type="email" name="visitor_mail" required="required"
                            data-msg="Wpisz adres e-mail" />
                          <span class="input-float__label">Twój e-mail</span>                        
                          <input class="button btn-light" type="submit" value="→" aria-label="Zapisz się do newslettera"><br />
                          <span class="form__error"></span>
                        </label>
                      </form>
                    </div>
                  </section>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <section class="widget widget_nav_menu">
                    <h2 class="widgettitle h4 mt-2">Usługi firmy</h2>
                    <div>
                      <ul class="menu">
                        <li class="menu-item"><a href="<?php home_url(); ?>outsourcing.php">Outsourcing IT</a></li>
                        <li class="menu-item"><a href="<?php home_url(); ?>uslugi/serwis-komputerowy.php">Serwis komputerowy</a></li>
                        <li class="menu-item"><a href="<?php home_url(); ?>uslugi/szkolenia-it.php">Szkolenia IT</a></li>
                        <li class="menu-item"><a href="<?php home_url(); ?>uslugi/sieci-lan-wlan.php">Sieci LAN/WLAN</a></li>
                        <li class="menu-item"><a href="<?php home_url(); ?>uslugi/pomoc-domowa.php">Pomoc domowa</a></li>
                        <li class="menu-item"><a href="<?php home_url(); ?>uslugi/tworzenie-stron-www.php">Tworzenie stron www</a></li>
                        <li class="menu-item"><a href="<?php home_url(); ?>uslugi/pozycjonowanie-stron.php">Pozycjonowanie stron</a></li>
                        <li class="menu-item"><a href="<?php home_url(); ?>uslugi/kampanie-google-ads.php">Kampanie Google Ads</a></li>
                        <li class="menu-item"><a href="<?php home_url(); ?>uslugi/branding-dla-firm.php">Branding dla firm</a></li>
                      </ul>
                    </div>
                  </section>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <section class="widget widget_text">
                    <h2 class="widgettitle h4 mt-2">O nas</h2>
                    <div>
                      <ul class="menu">
                        <li class="menu-item"><a href="<?php home_url(); ?>oferta.php">Oferta</a></li>
                        <li class="menu-item"><a href="<?php home_url(); ?>blog/index.php">Blog</a></li>
                        <li class="menu-item"><a href="<?php home_url(); ?>realizacje/index.php">Realizacje</a></li>
                      </ul>
                    </div>
                  </section> 
                </div>
                <div class="col-lg-2 col-sm-6">
                  <section class="widget widget_text">
                    <h2 class="widgettitle h4 mt-2">Pomoc</h2>
                    <div>
                      <ul class="menu">
                        <li class="menu-item"><a href="<?php home_url(); ?>faq.php">FAQ</a></li>
                        <li class="menu-item"><a href="<?php home_url(); ?>kontakt.php">Kontakt </a></li>
                      </ul>
                    </div>
                  </section>
                </div>
              </div>
              <!-- widget area #3 -->
              <div class="row justify-content-between align-items-center position-relative pt-4">
                <div class="col-lg-4 order-lg-2 text-lg-end text-center">
                  <section class="widget widget_kinsey_social">
                    <!--
                    <ul class="social">
                      <li class="social__item"><a class="social__icon fa-fw fab fa-facebook-f" href="#"
                          target="blank"></a></li>
                      <li class="social__item"><a class="social__icon fa-fw fab fa-twitter" href="#"
                          target="blank"></a></li>
                      <li class="social__item"><a class="social__icon fa-fw fab fa-instagram" href="#"
                          target="blank"></a></li>
                    </ul>
      -->
                  </section>
                </div>
                <div class="col-lg-8 text-lg-start text-center">
                  <section class="widget widget_text">
                    <div class="textwidget">
                      <address class="mb-2" style="font-style:normal;">
                        <strong>Qamitech</strong> · ul. Cicha 3, 05-500 Stara Iwiczna ·
                        <a href="tel:+48501784882">501 784 882</a> ·
                        <a href="mailto:kontakt@qamitech.pl">kontakt@qamitech.pl</a> · pn–pt 9:00–17:00
                      </address>
                      <a href="<?php home_url(); ?>regulamin.php">Regulamin strony</a>
                      <a href="<?php home_url(); ?>polityka-prywatnosci.php">Polityka prywatności</a>
                    </div>
                  </section>
                </div>
              </div>
            </div>
          </div>
        </footer>
        </div>
        </div>
        <canvas id="js-webgl"></canvas>
        <div class="arts-cursor" id="js-arts-cursor">
          <div class="arts-cursor__wrapper">
            <!-- circles-->
            <div class="arts-cursor__follower js-arts-cursor__follower">
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <circle class="arts-cursor__stroke-inner js-arts-cursor__stroke-inner" cx="25" cy="25" r="24"
                  style="opacity: 0.6;"></circle>
                <circle class="arts-cursor__stroke-outer js-arts-cursor__stroke-outer" cx="25" cy="25" r="24"
                  style="stroke-dashoffset: 252.327; stroke-dasharray: 0px, 999999px;"></circle>
              </svg>
            </div>
            <!-- arrows-->
            <div class="arts-cursor__arrows">
              <div
                class="arts-cursor__arrow arts-cursor__arrow_up material-icons keyboard_arrow_up js-arts-cursor__arrow-up">
              </div>
              <div
                class="arts-cursor__arrow arts-cursor__arrow_right material-icons keyboard_arrow_right js-arts-cursor__arrow-right">
              </div>
              <div
                class="arts-cursor__arrow arts-cursor__arrow_down material-icons keyboard_arrow_down js-arts-cursor__arrow-down">
              </div>
              <div
                class="arts-cursor__arrow arts-cursor__arrow_left material-icons keyboard_arrow_left js-arts-cursor__arrow-left">
              </div>
            </div>
            <!-- label holder-->
            <div class="arts-cursor__wrapper-label">
              <div class="arts-cursor__label js-arts-cursor__label"></div>
            </div>
            <!-- icon holder-->
            <div class="arts-cursor__wrapper-icon">
              <div class="arts-cursor__icon js-arts-cursor__icon"></div>
            </div>
          </div>
        </div>
        <svg class="spinner d-lg-none" id="js-spinner" width="65px" height="65px" viewBox="0 0 66 66"
          xmlns="http://www.w3.org/2000/svg">
          <circle class="spinner__path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30">
          </circle>
        </svg>
        <div class="transition-curtain" id="js-page-transition-curtain"></div>
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true" data-arts-theme-text="light">
          <div class="pswp__bg"></div>
          <div class="pswp__scroll-wrap">
            <div class="pswp__container">
              <div class="pswp__item">
                <div class="pswp__img pswp__img--placeholder"></div>
              </div>
              <div class="pswp__item"></div>
              <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
              <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)" data-arts-cursor="data-arts-cursor"
                  data-arts-cursor-scale="1.4" data-arts-cursor-magnetic="data-arts-cursor-magnetic"
                  data-arts-cursor-hide-native="true"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"
                  data-arts-cursor="data-arts-cursor" data-arts-cursor-scale="1.4"
                  data-arts-cursor-magnetic="data-arts-cursor-magnetic" data-arts-cursor-hide-native="true"></button>
                <div class="pswp__preloader">
                  <div class="pswp__preloader__icn">
                    <div class="pswp__preloader__cut">
                      <div class="pswp__preloader__donut"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="pswp__button pswp__button--arrow--left material-icons" data-arts-cursor="data-arts-cursor"
                data-arts-cursor-scale="1.7" data-arts-cursor-magnetic="data-arts-cursor-magnetic"
                data-arts-cursor-hide-native="true">keyboard_arrow_left</div>
              <div class="pswp__button pswp__button--arrow--right material-icons" data-arts-cursor="data-arts-cursor"
                data-arts-cursor-scale="1.7" data-arts-cursor-magnetic="data-arts-cursor-magnetic"
                data-arts-cursor-hide-native="true">keyboard_arrow_right</div>
              <div class="pswp__caption">
                <div class="pswp__caption__center text-center"></div>
              </div>
            </div>
          </div>
        </div>
        <script>
          document.querySelectorAll('a[href]').forEach(function (link) {
            var href = link.getAttribute('href');
            if (href && href.charAt(0) !== '#' && href.indexOf('javascript:') !== 0 && !link.target) {
              link.classList.add('no-ajax');
            }
          });
        </script>
        <script src="<?php home_url(); ?>assets/js/vendor.js"></script>
        <script src="<?php home_url(); ?>assets/js/components.js?v=20260623-ajaxfix"></script>
        <script>
          (function ($) {

            var rankMath = {
              accordion: function () {
                $('.rank-math-block').find('.rank-math-answer').hide();
                $('.rank-math-block').find('.rank-math-question').click(function () {
                  //Expand or collapse this panel
                  $(this).nextAll('.rank-math-answer').eq(0).slideToggle('fast', function () {
                    if ($(this).hasClass('collapse')) {
                      $(this).removeClass('collapse');
                    } else {
                      $(this).addClass('collapse');
                    }
                  });
                  //Hide the other panels
                  $(".rank-math-answer").not($(this).nextAll('.rank-math-answer').eq(0)).slideUp('fast');
                });

                $('.rank-math-block .rank-math-question').click(function () {
                  $('.rank-math-block .rank-math-question').not($(this)).removeClass('collapse');
                  if ($(this).hasClass('collapse')) {
                    $(this).removeClass('collapse');
                  } else {
                    $(this).addClass('collapse');
                  }
                });
              }
            };

            rankMath.accordion();

          })(jQuery);
        </script>

        </body>

        </html>
