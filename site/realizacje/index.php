<?php 
   $page  = 'realizacje';
   $title = 'Realizacje';
   $description = 'Wybrane realizacje Qamitech: strony internetowe i sklepy dla firm. Zobacz opisy projektów, zrzuty ekranu i technologie, z których je zbudowaliśmy.';
   $projects = require __DIR__ . '/data.php';
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
         <?php foreach ($projects as $slug => $p) :
            $thumb = preg_match('#^https?://#', $p['thumb']) ? $p['thumb'] : '../' . $p['thumb']; ?>
         <div class="grid__item js-grid__item grid__item_fluid-2 grid__item_desktop-4 grid__item_tablet-6 grid__item_mobile-12 cat-<?php echo $p['cat']; ?>">
            <div class="figure-project" data-arts-hover-class="hover-zoom-underline">
               <a class="figure-project__wrapper-img js-arts-cursor-no-highlight js-arts-parallax"
                  href="<?php echo $slug; ?>.php"
                  data-arts-hover="trigger"
                  data-arts-parallax-factor-y="0.05" data-arts-cursor="true" data-arts-cursor-hide-native="true"
                  data-arts-cursor-label="Zobacz" data-arts-cursor-scale="2" data-arts-cursor-color="#fff"
                  data-arts-cursor-background-color="var(--color-accent-1)">
                  <div class="hover-zoom__inner">
                     <div class="mask-reveal__layer mask-reveal__layer-1">
                        <div class="mask-reveal__layer mask-reveal__layer-2">
                           <div class="js-arts-parallax__scrub w-100 h-100">
                              <div class="lazy-wrapper">
                                 <div class="lazy"><img class="hover-zoom__zoom" src="<?php echo htmlspecialchars($thumb, ENT_QUOTES, 'UTF-8'); ?>"
                                    loading="lazy"
                                    width="430" height="300" alt="<?php echo htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8'); ?> – realizacja" /></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="figure-project__content pt-4">
                  <div class="figure-project__wrapper-meta arts-split-text">
                     <ul class="post-meta post-meta_mini post-meta_mini-small">
                        <li><span><?php echo htmlspecialchars($p['label'], ENT_QUOTES, 'UTF-8'); ?></span><div class="post-meta__divider"></div></li>
                        <li><span><?php echo htmlspecialchars($p['industry'], ENT_QUOTES, 'UTF-8'); ?></span></li>
                     </ul>
                  </div>
                  <a class="d-inline-block js-arts-cursor-no-highlight" href="<?php echo $slug; ?>.php">
                     <h3 class="h4 arts-split-text underline-hover__target"><?php echo htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                  </a>
               </div>
            </div>
         </div>
         <?php endforeach; ?>

      </div>
   </div>

</section>

<?php require_once( '../include/footer.php' ); ?>
