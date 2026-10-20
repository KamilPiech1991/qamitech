<?php 
   $page  = 'realizacje';
   $title = 'Realizacje';
   ?>
<!-- PAGE HEADER -->
<?php require_once( '../include/header.php' ); ?>
<?php include( '../part/hero-page.php' ); ?>

<!-- section REALIZACJE -->
<section class="section section-blog section-grid pb-large">

   <div class="container pb-medium">
      <div class="filter js-filter text-center">
         <div class="filter__wrapper-dropdown d-lg-none">
            <select class="js-filter__select d-block w-100">
               <option value="*">Wszystkie [*]</option>
               <option value=".cat-site">Strona www</option>
               <option value=".cat-shop">E-commerce</option>
               <option value=".cat-other">Inne</option>
            </select>
         </div>
         <div class="filter__inner d-lg-block d-none">
            <div class="container-fluid no-gutters">
               <div class="row">
                  <div class="col-lg-auto col-12 filter__item filter__item_active js-filter__item js-arts-cursor-highlight" data-filter="*">
                     <div class="filter__item-inner h6 block-counter arts-split-text"><span class="filter__item-label">Wszystkie</span><span class="block-counter__counter">*</span></div>
                  </div>
                  <div class="col-lg-auto col-12 filter__item js-filter__item js-arts-cursor-highlight" data-filter=".cat-site">
                     <div class="filter__item-inner h6 block-counter arts-split-text"><span class="filter__item-label">Strona www</span></div>
                  </div>
                  <div class="col-lg-auto col-12 filter__item js-filter__item js-arts-cursor-highlight" data-filter=".cat-shop">
                     <div class="filter__item-inner h6 block-counter arts-split-text"><span class="filter__item-label">E-commerce</span></div>
                  </div>
                  <div class="col-lg-auto col-12 filter__item js-filter__item js-arts-cursor-highlight" data-filter=".cat-other">
                     <div class="filter__item-inner h6 block-counter arts-split-text"><span class="filter__item-label">Inne</span></div>
                  </div>
               </div>
               <div class="filter__underline js-filter__underline"></div>
            </div>
         </div>
      </div>
   </div>

   <!-- karty realizacji -->
   <div class="container">
      <div class="grid js-grid grid_fluid-2">



         <!-- Eurodomy -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://www.eurodomy.pl" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/eurodomy.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Eurodomy – strona internetowa" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Qamitech</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://www.eurodomy.pl" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Eurodomy</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- E-Tabak -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-shop">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://e-tabak.pl" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/e-tabak.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="e-tabak.pl – sklep internetowy" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">E-commerce</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Qamitech</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://e-tabak.pl" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">e-tabak.pl</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Obok Lasu -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://obok-lasu.pl" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/obok-lasu.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Obok Lasu – strona internetowa" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Qamitech</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://obok-lasu.pl" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Obok Lasu</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Marmostyl -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://www.marmostyl.pl" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/marmostyl.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Marmostyl – strona internetowa" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Qamitech</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://www.marmostyl.pl" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Marmostyl</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Pure Rehab -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://www.purerehab.pl" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/purerehab.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Pure Rehab fizjoterapia" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://www.purerehab.pl" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Pure Rehab</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Sahra Art -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-shop">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://www.sahraart.pl" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/sahraart.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Sahra Art - sklep z dywanami" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">E-commerce</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://www.sahraart.pl" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Sahra Art</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Rancilio Ekspresy -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-shop">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://www.rancilioekspresy.pl" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/rancilio.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Rancilio Ekspresy do kawy" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">E-commerce</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://www.rancilioekspresy.pl" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Rancilio Ekspresy</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- SMKA Portal -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-shop">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://www.smka.pl" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/smka.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="SMKA Portal Producenta" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">E-commerce</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://www.smka.pl" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">SMKA Portal</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Region Zdrowia -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://www.regionzdrowia.pl" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/regionzdrowia.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Region Zdrowia - parki prozdrowotne" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://www.regionzdrowia.pl" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Region Zdrowia</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- PSO Tel Gracja -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://www.psotelgracja.pl" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/psotelgracja.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="PSO Tel Gracja" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://www.psotelgracja.pl" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">PSO Tel Gracja</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Bogdan Grzeszczyk -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://www.bogdangrzeszczyk.pl" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/bogdangrzeszczyk.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Bogdan Grzeszczyk" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://www.bogdangrzeszczyk.pl" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Bogdan Grzeszczyk</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Ventoni -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-shop">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://ventoni.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/ventoni.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Ventoni sklep" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">E-commerce</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://ventoni.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Ventoni</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Fastclean -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://www.fastclean.pl" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/fastclean.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Fastclean czyszczenie wentylacji" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://www.fastclean.pl" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Fastclean</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Cloud Insight -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://www.cloudinsight.pl/pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/cloudinsight.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Cloud Insight" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://www.cloudinsight.pl/pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Cloud Insight</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Face2Face -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://face2face.com.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/face2face.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Face2Face" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://face2face.com.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Face2Face</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Veles Lighting -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-shop">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://veles-lighting.com/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/veles.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Veles Lighting oswietlenie" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">E-commerce</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://veles-lighting.com/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Veles Lighting</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Esivo -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://esivo.dfirma.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/esivo.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Esivo" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://esivo.dfirma.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Esivo</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Oligradskyi -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://oligradskyi.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="../assets/img/realizacje/oligradskyi.jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Oligradskyi" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://oligradskyi.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Oligradskyi</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Car detailing -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://elite-detailing.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/mockuper(11).jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Car detailing" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://elite-detailing.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Car detailing</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Rushing Rivers -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="http://www.rushingrivers.org/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/mockuper(13).jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Rushing Rivers" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="http://www.rushingrivers.org/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Rushing Rivers</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Instalacje grzewcze mcgoodwork -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://mcgoodwork.pl" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/4-good-work.png"
                                    loading="lazy"
                                    width="430" height="300" alt="Instalacje grzewcze mcgoodwork" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://mcgoodwork.pl" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Instalacje grzewcze mcgoodwork</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Reventon design -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://reventontest.teststrona.com.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/mockuper(15).jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Reventon design" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://reventontest.teststrona.com.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Reventon design</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- 3P Energia -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://3penergia.com/pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/3penergia.png"
                                    loading="lazy"
                                    width="430" height="300" alt="3P Energia" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://3penergia.com/pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">3P Energia</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Little Frank -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-shop">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://e-littlefrank.com/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/littlefrank.png"
                                    loading="lazy"
                                    width="430" height="300" alt="Little Frank" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">E-commerce</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://e-littlefrank.com/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Little Frank</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- KR Projekt -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="http://krprojekt.com.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/krprojekt.png"
                                    loading="lazy"
                                    width="430" height="300" alt="KR Projekt" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="http://krprojekt.com.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">KR Projekt</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Opieka Plus -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="http://opieka.plus/pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/opiekaplus.png"
                                    loading="lazy"
                                    width="430" height="300" alt="Opieka Plus" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="http://opieka.plus/pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Opieka Plus</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Obok Lasu -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://zoloboklasu.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/oboklasu.png"
                                    loading="lazy"
                                    width="430" height="300" alt="Obok Lasu" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://zoloboklasu.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Obok Lasu</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Emix -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://emix.waw.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/emix.png"
                                    loading="lazy"
                                    width="430" height="300" alt="Emix" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://emix.waw.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Emix</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Vision And Sound -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://www.visionandsound.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/visionandsound.png"
                                    loading="lazy"
                                    width="430" height="300" alt="Vision And Sound" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://www.visionandsound.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Vision And Sound</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Agtes Serwis -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://agtesserwis.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/agtes.png"
                                    loading="lazy"
                                    width="430" height="300" alt="Agtes Serwis" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://agtesserwis.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Agtes Serwis</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Dynamic marketing -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-other">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://dynamic-marketing.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/dynamic-marketing.png"
                                    loading="lazy"
                                    width="430" height="300" alt="Dynamic marketing" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Inne</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://dynamic-marketing.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Dynamic marketing</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Tse Remonty -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://www.tseremonty.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/tseremonty.png"
                                    loading="lazy"
                                    width="430" height="300" alt="Tse Remonty" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://www.tseremonty.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Tse Remonty</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Graschem -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://graschem.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/graschem.png"
                                    loading="lazy"
                                    width="430" height="300" alt="Graschem" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://graschem.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Graschem</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Convey Cargo -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-other">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://conveycargo.com.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/mockuper(8).jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Convey Cargo" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Transport</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://conveycargo.com.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Convey Cargo</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Kancelaria prawna -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-other">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="http://wilczekkancelaria.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/mockuper(9).jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Kancelaria prawna" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="http://wilczekkancelaria.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Kancelaria prawna</h3>
                  </a>
               </div>
            </div>
         </div>

         <!-- Studio Gracja -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-site">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="https://www.studio-gracja.pl/" target="_blank" rel="noopener nofollow"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Podgl&#261;d" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="https://www.topstrony.pl/assets/img/mockup/mockuper(4).jpg"
                                    loading="lazy"
                                    width="430" height="300" alt="Studio Gracja" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Top Strony</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://www.studio-gracja.pl/" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Studio Gracja</h3>
                  </a>
               </div>
            </div>
         </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><a href="#">Strona www</a><div class="post-meta__divider"></div></li>
                        <li><a href="#">Qamitech</a></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="https://www.eurodomy.pl" target="_blank" rel="noopener nofollow">
                     <h3 class="h4 arts-split-text underline-hover__target">Eurodomy</h3>
                  </a>
               </div>
            </div>
         </div>

      </div>
   </div>

</section>

<?php require_once( '../include/footer.php' ); ?>
