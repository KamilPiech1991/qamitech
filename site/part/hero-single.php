<section class="section section-content page-hero-single pb-xsmall" data-arts-theme-text="dark">
  <div 
    class="container-sm section-content__content content arts-split-text"
    >

    <div class="breadcrumbs-wrap">
    <i class="material-icons">home</i><span>Główna</span>
    <i class="material-icons">navigate_next</i><span>Blog</span>
    <i class="material-icons">navigate_next</i><span><?php echo htmlspecialchars($h1 ?? seo_short_title((string)$title), ENT_QUOTES, 'UTF-8'); ?></span>
    </div>
    
    <h1 class="col-md-10 mt-4">
    <?php echo htmlspecialchars($h1 ?? seo_short_title((string)$title), ENT_QUOTES, 'UTF-8'); ?>
    </h1>

    <div class="taxonomy-wrap">
    <i class="material-icons">event</i>
    <span><?php the_category(); ?></span>
    <i class="material-icons">subject</i>
    <span>Opublikowano <?php the_date(); ?></span>
    <i class="material-icons">supervisor_account</i>
    <span><?php the_autor(); ?></span>
    </div>

  </div>
</section>

<section class="section section-masthead pb-small">
  <div class="section__content">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="mask-reveal js-transition-img js-arts-parallax overflow" data-arts-parallax-factor-y="0.15">
            <div class="mask-reveal__layer mask-reveal__layer-1">
              <div class="mask-reveal__layer mask-reveal__layer-2">
                <div class="js-arts-parallax__scrub js-transition-img__transformed-el"><img
                    src="../assets/img/blog/<?php the_image(); ?>" width="1920" height="1280" alt="<?php echo htmlspecialchars($h1 ?? seo_short_title((string)$title), ENT_QUOTES, 'UTF-8'); ?>" /></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

