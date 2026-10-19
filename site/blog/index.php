<?php 
   $page  = 'blog';
   $title = 'Artykuły';
   ?>
<!-- PAGE HEADER -->
<?php require_once( '../include/header.php' ); ?>
<?php include( '../part/hero-page.php' ); ?>
<!-- section BLOG -->
<section class="section section-blog section-grid pb-large">

   <div class="container pb-medium">
      <div class="filter js-filter text-center" data-arts-os-animation="true" data-arts-os-animation-name="animateText">
         <div class="filter__wrapper-dropdown d-lg-none" data-arts-os-animation="true" data-arts-os-animation-name="animateJump">
            <select class="js-filter__select d-block w-100">
               <option value="*">Wszystkie [*]</option>
               <option value=".category-security">Zabezpieczenia</option>
               <option value=".category-new-it">Nowości w IT</option>
               <option value=".category-www">Strony www</option>
               <option value=".category-law">Prawo w IT</option>
            </select>
         </div>
         <div class="filter__inner d-lg-block d-none">
            <div class="container-fluid no-gutters">
               <div class="row">
                  <div class="col-lg-auto col-12 filter__item filter__item_active js-filter__item js-arts-cursor-highlight" data-filter="*">
                     <div class="filter__item-inner h6 block-counter arts-split-text js-arts-split-text" data-arts-split-text="lines, words" data-arts-split-text-set="words" data-arts-split-text-overflow-wrap="lines"><span class="filter__item-label">Wszystkie</span><span class="block-counter__counter">*</span></div>
                  </div>
                  <div class="col-lg-auto col-12 filter__item js-filter__item js-arts-cursor-highlight" data-filter=".category-security">
                     <div class="filter__item-inner h6 block-counter arts-split-text js-arts-split-text" data-arts-split-text="lines, words" data-arts-split-text-set="words" data-arts-split-text-overflow-wrap="lines"><span class="filter__item-label">Zabezpieczenia</span></div>
                  </div>
                  <div class="col-lg-auto col-12 filter__item js-filter__item js-arts-cursor-highlight" data-filter=".category-new-it">
                     <div class="filter__item-inner h6 block-counter arts-split-text js-arts-split-text" data-arts-split-text="lines, words" data-arts-split-text-set="words" data-arts-split-text-overflow-wrap="lines"><span class="filter__item-label">Nowości w IT</span></div>
                  </div>
                  <div class="col-lg-auto col-12 filter__item js-filter__item js-arts-cursor-highlight" data-filter=".category-www">
                     <div class="filter__item-inner h6 block-counter arts-split-text js-arts-split-text" data-arts-split-text="lines, words" data-arts-split-text-set="words" data-arts-split-text-overflow-wrap="lines"><span class="filter__item-label">Strony www</span></div>
                  </div>
                  <div class="col-lg-auto col-12 filter__item js-filter__item js-arts-cursor-highlight" data-filter=".category-law">
                     <div class="filter__item-inner h6 block-counter arts-split-text js-arts-split-text" data-arts-split-text="lines, words" data-arts-split-text-set="words" data-arts-split-text-overflow-wrap="lines"><span class="filter__item-label">Prawo w IT</span></div>
                  </div>
               </div>
               <div class="filter__underline js-filter__underline" data-arts-os-animation="true" data-arts-os-animation-name="animateHeadline" data-arts-os-animation-params="{transformOrigin: 'left center'}"></div>
            </div>
         </div>
      </div>
   </div>

   <!-- posts -->
   <div class="container">
      <div class="grid js-grid grid_fluid-2">
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-new-it">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
                <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php echo ABS_URL; ?>blog/pozycjonowanie-seo-aeo-geo-2026.php"
                    data-arts-hover="trigger" data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/thumbs/blog-pozycjonowanie.jpg" width="430"
                                                height="300" alt="Pozycjonowanie SEO AEO GEO 2026" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true" data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text" data-arts-split-text="lines, words" data-arts-split-text-set="words" data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">Nowości w IT</a><div class="post-meta__divider"></div></li>
                            <li><a href="#">28 czerwiec 2026</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight" href="<?php echo ABS_URL; ?>blog/pozycjonowanie-seo-aeo-geo-2026.php">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target" data-arts-split-text="lines" data-arts-split-text-set="lines" data-arts-split-text-overflow-wrap="lines">Pozycjonowanie SEO, AEO i GEO w 2026 roku</h3>
                    </a>
                </div>
            </div>
         </div>

         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-www">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
                <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php echo ABS_URL; ?>blog/tworzenie-stron-internetowych-2026.php"
                    data-arts-hover="trigger" data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/thumbs/blog-tworzenie-stron.jpg" width="430"
                                                height="300" alt="Tworzenie stron internetowych 2026" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true" data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text" data-arts-split-text="lines, words" data-arts-split-text-set="words" data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">Strony www</a><div class="post-meta__divider"></div></li>
                            <li><a href="#">28 czerwiec 2026</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight" href="<?php echo ABS_URL; ?>blog/tworzenie-stron-internetowych-2026.php">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target" data-arts-split-text="lines" data-arts-split-text-set="lines" data-arts-split-text-overflow-wrap="lines">Tworzenie stron internetowych 2026 – trendy i koszty</h3>
                    </a>
                </div>
            </div>
         </div>

         <!-- item -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-www">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
                <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/tworzenie-stopki.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/thumbs/tworzenie-stopki.jpg" width="430"
                                                height="300" alt="Tworzenie stopki" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">23 czerwca 2022</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#">Top Strony</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight"
                        href="<?php home_url(); ?>blog/tworzenie-stopki.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines">Tworzenie stopki <br /><br /></h3>
                    </a>
                </div>
            </div>
         </div>
         <!-- item -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-design">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline"><a
                    class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/instalacja-pakietu-sun-java.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/thumbs/instalacja-sun-java6.jpg" width="430"
                                                height="300" alt="Instalacja pakietu sun-java6 jak na Ubuntu lucid" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">12 luty 2022</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#"><?php the_autor(); ?></a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight"
                        href="<?php home_url(); ?>blog/instalacja-pakietu-sun-java.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines">Instalacja pakietu sun-java6 jak na Ubuntu lucid</h3>
                    </a>
                </div>
            </div>
         </div>
         <!-- item -->
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-www">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline"><a
                    class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/dlugie-zamykanie-restart-windows.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/thumbs/restart-windows.jpg" width="430"
                                                height="300" alt="Długie zamykanie/ restart/ wylogowanie w Windows 7" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">15 lipiec 2022</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#">Admin</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight"
                        href="<?php home_url(); ?>blog/dlugie-zamykanie-restart-windows.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines">Długie zamykanie/ restart/ wylogowanie w Windows 7</h3>
                    </a>
                </div>
            </div>
         </div>

        <!-- item -->
        <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-new-it">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline"><a
                    class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/jak-usprawnic-codzienne-obowiazki.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/automatyzacja.jpg" width="430"
                                                height="300" alt="Jak usprawnić codzienne obowiązki z pomocą automatyzacji procesów?" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">15 luty 2023</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#">Top Strony</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight"
                        href="<?php home_url(); ?>blog/jak-usprawnic-codzienne-obowiazki.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines"> Jak usprawnić codzienne obowiązki z pomocą automatyzacji procesów? </h3>
                    </a>
                </div>
            </div>
         </div>

        <!-- item -->
        <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-security">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline"><a
                    class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/zaawansowane-metody-ochrony-sieci-firmowej.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/zabezpieczenia.jpg" width="430"
                                                height="300" alt="Zaawansowane metody ochrony sieci firmowej przed nieautoryzowanym dostępem " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">15 luty 2023</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#">Top Strony</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight line-clamp-2"
                        href="<?php home_url(); ?>blog/zaawansowane-metody-ochrony-sieci-firmowej.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target line-clamp-2"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines"> Zaawansowane metody ochrony sieci firmowej przed nieautoryzowanym dostępem 
                        </h3>
                    </a>
                </div>
            </div>
         </div>

        <!-- item -->
        <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-security">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline"><a
                    class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/zabezpieczenie-urzadzen-przed-wirusami.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/wirus.jpg" width="430"
                                                height="300" alt="Jak zabezpieczyć swoje urządzenia przed wirusami i malware?" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">15 marzec 2023</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#">Top Strony</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight"
                        href="<?php home_url(); ?>blog/zabezpieczenie-urzadzen-przed-wirusami.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines"> Jak zabezpieczyć swoje urządzenia przed wirusami i malware?
                        </h3>
                    </a>
                </div>
            </div>
         </div>

        <!-- item -->
        <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-law">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline"><a
                    class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/wydajne-zarzadzanie-danymi-klientow.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/security.jpg" width="430"
                                                height="300" alt="W jaki sposób wydajnie zarządzać danymi klientów w ramach RODO?" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">15 marzec, 2023</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#">Top Strony</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight"
                        href="<?php home_url(); ?>blog/wydajne-zarzadzanie-danymi-klientow.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines">W jaki sposób wydajnie zarządzać danymi klientów w ramach RODO?
                        </h3>
                    </a>
                </div>
            </div>
         </div>

        <!-- item -->
        <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-law">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline"><a
                    class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/sztuczna-inteligencja-w-informatyce.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/ai.jpg" width="430"
                                                height="300" alt="Jak działa sztuczna inteligencja w informatyce?" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">21 marzec, 2023</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#">Top Strony</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight"
                        href="<?php home_url(); ?>blog/sztuczna-inteligencja-w-informatyce.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines">Jak działa sztuczna inteligencja w informatyce?
                        </h3>
                    </a>
                </div>
            </div>
         </div>

        <!-- item -->
        <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-www">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline"><a
                    class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/najnowsze-trendy-w-projektowaniu-stron.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/webdesign.jpg" width="430"
                                                height="300" alt="Najnowsze trendy w projektowaniu i tworzeniu stron internetowych" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">25 marzec, 2023</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#">Top Strony</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight"
                        href="<?php home_url(); ?>blog/najnowsze-trendy-w-projektowaniu-stron.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines">Najnowsze trendy w projektowaniu i tworzeniu stron internetowych
                        </h3>
                    </a>
                </div>
            </div>
         </div>

        <!-- item -->
        <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-new-it">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline"><a
                    class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/zalety-i-wady-chmury-obliczeniowej.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/chmura.jpg" width="430"
                                                height="300" alt="Zalety i wady chmury obliczeniowej w zamian za tradycyjne serwery" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">25 marzec, 2023</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#">Top Strony</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight"
                        href="<?php home_url(); ?>blog/zalety-i-wady-chmury-obliczeniowej.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines">Zalety i wady chmury obliczeniowej w zamian za tradycyjne serwery
                        </h3>
                    </a>
                </div>
            </div>
         </div>

        <!-- item -->
        <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-new-it">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline"><a
                    class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/narzedzia-do-zarzadzania-projektami.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/projects.jpg" width="430"
                                                height="300" alt="Narzędzia do zarządzania projektami" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">27 marzec, 2023</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#">Top Strony</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight"
                        href="<?php home_url(); ?>blog/narzedzia-do-zarzadzania-projektami.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines">Narzędzia do zarządzania projektami
                        </h3>
                    </a>
                </div>
            </div>
         </div>

        <!-- item -->
        <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-new-it">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline"><a
                    class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/blockchain-zastosowanie.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/blockchain.jpg" width="430"
                                                height="300" alt="Blockchain i jego zastosowanie w dzisiejszej erze cyfrowej" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">27 marzec, 2023</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#">Top Strony</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight"
                        href="<?php home_url(); ?>blog/blockchain-zastosowanie.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines">Blockchain i jego zastosowanie w dzisiejszej erze cyfrowej
                        </h3>
                    </a>
                </div>
            </div>
        </div>
        <!-- item -->
        <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-security">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline"><a
                    class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/cyberbezpieczenstwo-niewidzialna-tarcza-swiata.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/laptop-z-ukladem-zamka.jpg" width="430"
                                                height="300" alt="Cyberbezpieczeństwo: Niewidzialna tarcza świata cyfrowego." />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">5 styczeń, 2024</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#">Top Strony</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight"
                        href="<?php home_url(); ?>blog/cyberbezpieczenstwo-niewidzialna-tarcza-swiata.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines">Cyberbezpieczeństwo: Niewidzialna tarcza świata cyfrowego
                        </h3>
                    </a>
                </div>
            </div>
        </div>
        <!-- item -->
        <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-security">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline"><a
                    class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/sieci-komputerowe-jako-klucz-do-sukcesu.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/sieci-komputerowe.jpeg" width="430"
                                                height="300" alt="Budowanie Solidnych Fundamentów Biznesu: Sieci Komputerowe jako Klucz do Sukcesu" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">5 styczeń, 2024</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#">Top Strony</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight"
                        href="<?php home_url(); ?>blog/sieci-komputerowe-jako-klucz-do-sukcesu.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines">Budowanie solidnych fundamentów biznesu: Sieci komputerowe jako klucz do sukcesu
                        </h3>
                    </a>
                </div>
            </div>
        </div>
        <!-- item -->
        <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-security">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline"><a
                    class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/obsluga-informatyczna-firm-wsparcie-techniczne.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/obsluga-informatyczna.jpg" width="430"
                                                height="300" alt="Budowanie Solidnych Fundamentów Biznesu: Sieci Komputerowe jako Klucz do Sukcesu" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">14 styczeń, 2024</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#">Top Strony</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight"
                        href="<?php home_url(); ?>blog/obsluga-informatyczna-firm-wsparcie-techniczne.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines">Obsługa informatyczna firm: Wsparcie techniczne i optymalizacja procesów biznesowych
                        </h3>
                    </a>
                </div>
            </div>
        </div>
        <!-- item -->
        <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 category-security">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline"><a
                    class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                    href="<?php home_url(); ?>blog/outsourcing-it-korzysci-wyzwania.php" data-arts-hover="trigger"
                    data-arts-os-animation="true" data-arts-os-animation-name="animateMask"
                    data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                    data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                    data-arts-cursor-background-color="var(--color-accent-1)">
                    <div class="hover-zoom__inner">
                        <div class="mask-reveal__layer mask-reveal__layer-1">
                            <div class="mask-reveal__layer mask-reveal__layer-2">
                                <div class="js-arts-parallax__scrub w-100 h-100">
                                    <div class="lazy-wrapper">
                                        <div class="lazy"><img class="hover-zoom__zoom" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                data-src="../assets/img/blog/outsorcing-it.jpg" width="430"
                                                height="300" alt="Outsourcing IT — Korzyści, Wyzwania, Rodzaje i Najlepsze Praktyki" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="figure-project__content pt-4" data-arts-os-animation="true"
                    data-arts-os-animation-name="animateText">
                    <div class="figure-project__wrapper-meta arts-split-text js-arts-split-text"
                        data-arts-split-text="lines, words" data-arts-split-text-set="words"
                        data-arts-split-text-overflow-wrap="lines">
                        <ul class="post-meta post-meta_mini post-meta_mini-small">
                            <li><a href="#">14 styczeń, 2024</a>
                                <div class="post-meta__divider"></div>
                            </li>
                            <li><a href="#">Top Strony</a></li>
                        </ul>
                    </div>
                    <a class="d-inline-block js-arts-cursor-no-highlight"
                        href="<?php home_url(); ?>blog/outsourcing-it-korzysci-wyzwania.php" data-arts-hover="trigger"
                        data-arts-cursor="true" data-arts-cursor-hide-native="true"
                        data-arts-cursor-label="Czytaj" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                        data-arts-cursor-background-color="var(--color-accent-1)">
                        <h3 class="h4 js-arts-split-text arts-split-text underline-hover__target"
                            data-arts-split-text="lines" data-arts-split-text-set="lines"
                            data-arts-split-text-overflow-wrap="lines">Outsourcing IT — Korzyści, Wyzwania, Rodzaje i Najlepsze Praktyki
                        </h3>
                    </a>
                </div>
            </div>
        </div>

   </div>
   <!-- - posts -->
</section>
<!-- - section BLOG -->
</main>
<!-- PAGE FOOTER -->
<?php require_once( '../include/footer.php' ); ?>

