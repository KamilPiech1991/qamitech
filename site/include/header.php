<?php
   require_once ( dirname ( __FILE__ ) . '/functions.php' );
   require_once ( dirname ( __FILE__ ) . '/seo.php' );

   $metaTitle = trim((string)($title ?? ''));
   $metaFullTitle = seo_full_title($metaTitle);
   $metaServices = seo_services();
   $metaShortTitle = trim((string)($breadcrumb ?? ''))
      ?: (isset($metaServices[seo_path()]) ? $metaServices[seo_path()][0] : '')
      ?: (seo_short_title($metaTitle) ?: SEO_BRAND);
   $metaDescription = trim((string)($description ?? 'Obsługa informatyczna firm, outsourcing IT, serwis komputerowy, strony www, Google Ads i SEO w Piasecznie, Warszawie i okolicach.'));
   $metaUrl = seo_canonical();
   $metaImage = SEO_SITE_URL . 'assets/img/opengraph.png';
   $metaRobots = trim((string)($robots ?? '')) ?: 'index, follow, max-image-preview:large, max-snippet:-1';
   $metaDateIso = isset($date) ? seo_parse_pl_date((string)$date) : null;
   $metaIsArticle = $metaDateIso !== null && strpos(seo_path(), 'blog/') === 0;
   if ($metaIsArticle && ! empty($image)) {
      $metaImage = SEO_SITE_URL . 'assets/img/blog/' . $image;
   }
   $metaCase = $case ?? null;
   if ($metaCase) {
      $metaImage = SEO_SITE_URL . $metaCase['image'];
   }
?>
<!DOCTYPE html>
<html lang="pl">

<head>
   <meta charset="utf-8" />
   <meta http-equiv="x-ua-compatible" content="ie=edge" />
   <title><?php echo htmlspecialchars($metaFullTitle, ENT_QUOTES, 'UTF-8'); ?></title>
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <meta content="telephone=no" name="format-detection" />
   <meta name="HandheldFriendly" content="true" />
   <meta name="description" content="<?php echo htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>" />
   <meta name="robots" content="<?php echo htmlspecialchars($metaRobots, ENT_QUOTES, 'UTF-8'); ?>" />
   <link rel="canonical" href="<?php echo htmlspecialchars($metaUrl, ENT_QUOTES, 'UTF-8'); ?>" />
   <meta property="og:locale" content="pl_PL" />
   <meta property="og:type" content="<?php echo $metaIsArticle ? 'article' : 'website'; ?>" />
<?php if ($metaIsArticle) : ?>
   <meta property="article:published_time" content="<?php echo $metaDateIso; ?>" />
<?php endif; ?>
   <meta property="og:site_name" content="Qamitech" />
   <meta property="og:title" content="<?php echo htmlspecialchars($metaFullTitle, ENT_QUOTES, 'UTF-8'); ?>" />
   <meta property="og:description" content="<?php echo htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>" />
   <meta property="og:url" content="<?php echo htmlspecialchars($metaUrl, ENT_QUOTES, 'UTF-8'); ?>" />
   <meta property="og:image" content="<?php echo htmlspecialchars($metaImage, ENT_QUOTES, 'UTF-8'); ?>" />
   <meta property="og:image:secure_url" content="<?php echo htmlspecialchars($metaImage, ENT_QUOTES, 'UTF-8'); ?>" />
<?php if ($metaCase) : ?>
   <meta property="og:image:type" content="image/jpeg" />
   <meta property="og:image:width" content="1200" />
   <meta property="og:image:height" content="833" />
<?php else : ?>
   <meta property="og:image:type" content="image/png" />
   <meta property="og:image:width" content="1436" />
   <meta property="og:image:height" content="823" />
<?php endif; ?>
   <meta name="twitter:card" content="summary_large_image" />
   <meta name="twitter:title" content="<?php echo htmlspecialchars($metaFullTitle, ENT_QUOTES, 'UTF-8'); ?>" />
   <meta name="twitter:description" content="<?php echo htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>" />
   <meta name="twitter:image" content="<?php echo htmlspecialchars($metaImage, ENT_QUOTES, 'UTF-8'); ?>" />
   <link rel="preload" href="<?php home_url(); ?>assets/js/vendor.js" as="script" type="application/javascript" />
   <link rel="preload" href="<?php home_url(); ?>assets/js/components.js?v=20260623-ajaxfix" as="script" type="application/javascript" />
   <link rel="preload" href="<?php home_url(); ?>assets/fonts/MaterialIcons-Regular.woff2" as="font" type="font/woff2"
      crossorigin="anonymous" />
   <!-- Stylesheet -->
   <link rel="stylesheet" type="text/css" href="<?php home_url(); ?>assets/css/vendor.css" />
   <link rel="stylesheet" type="text/css" href="<?php home_url(); ?>assets/css/main.css" />
   <link rel="stylesheet" type="text/css" href="<?php home_url(); ?>assets/css/custom.css" />
   <!-- Favicons & App Icons -->
   <link rel="apple-touch-icon" sizes="57x57" href="<?php home_url(); ?>assets/img/favicons/apple-icon-57x57.png" />
   <link rel="apple-touch-icon" sizes="60x60" href="<?php home_url(); ?>assets/img/favicons/apple-icon-60x60.png" />
   <link rel="apple-touch-icon" sizes="72x72" href="<?php home_url(); ?>assets/img/favicons/apple-icon-72x72.png" />
   <link rel="apple-touch-icon" sizes="76x76" href="<?php home_url(); ?>assets/img/favicons/apple-icon-76x76.png" />
   <link rel="apple-touch-icon" sizes="114x114" href="<?php home_url(); ?>assets/img/favicons/apple-icon-114x114.png" />
   <link rel="apple-touch-icon" sizes="120x120" href="<?php home_url(); ?>assets/img/favicons/apple-icon-120x120.png" />
   <link rel="apple-touch-icon" sizes="144x144" href="<?php home_url(); ?>assets/img/favicons/apple-icon-144x144.png" />
   <link rel="apple-touch-icon" sizes="152x152" href="<?php home_url(); ?>assets/img/favicons/apple-icon-152x152.png" />
   <link rel="apple-touch-icon" sizes="180x180" href="<?php home_url(); ?>assets/img/favicons/apple-icon-180x180.png" />
   <link rel="icon" type="image/png" sizes="192x192"
      href="<?php home_url(); ?>assets/img/favicons/android-icon-192x192.png" />
   <link rel="icon" type="image/png" sizes="32x32" href="<?php home_url(); ?>assets/img/favicons/favicon-32x32.png" />
   <link rel="icon" type="image/png" sizes="96x96" href="<?php home_url(); ?>assets/img/favicons/favicon-96x96.png" />
   <link rel="icon" type="image/png" sizes="16x16" href="<?php home_url(); ?>assets/img/favicons/favicon-16x16.png" />
   <link rel="manifest" href="<?php home_url(); ?>assets/img/favicons/manifest.json" />
   <meta name="msapplication-TileColor" content="#ffffff" />
   <meta name="msapplication-TileImage" content="<?php home_url(); ?>assets/img/favicons/ms-icon-144x144.png" />
   <meta name="theme-color" content="#ffffff" />
   <link rel="icon" type="image/x-icon" href="<?php home_url(); ?>assets/img/favicons/favicon.ico" />
   <script src="https://www.google.com/recaptcha/api.js"></script>

   <script>
   document.addEventListener('DOMContentLoaded', function() {
      // Mobile overlay submenu toggle
      document.querySelectorAll('.js-menu-overlay-submenu-toggle').forEach(function(btn) {
         btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var li = btn.closest('.menu-overlay__item-has-children');
            var sub = li.querySelector('.sub-menu');
            var isOpen = sub.classList.contains('is-open');
            // Zamknij wszystkie
            document.querySelectorAll('.menu-overlay .sub-menu.is-open').forEach(function(s) {
               s.classList.remove('is-open');
            });
            document.querySelectorAll('.menu-overlay__item-arrow.is-open').forEach(function(a) {
               a.classList.remove('is-open');
            });
            // Toggle kliknięty
            if (!isOpen) {
               sub.classList.add('is-open');
               btn.classList.add('is-open');
            }
         });
      });
   });
   </script>
<meta name="google-site-verification" content="DmcN6mcOFtzMsCwKj2yVxW5XT3DhlzSySBLXVZG7onU" />

   <!-- Dane strukturalne (schema.org): firma, strona, okruszki, usługa / wpis / FAQ -->
   <?php seo_jsonld([
      'full_title'  => $metaFullTitle,
      'short_title' => $metaShortTitle,
      'description' => $metaDescription,
      'faq'         => $faq ?? [],
      'date_iso'    => $metaIsArticle ? $metaDateIso : null,
      'image'       => $image ?? '',
      'case'        => $metaCase,
   ]); ?>
</head>

<body>
   <div class="lines">
      <div class="container">
         <div class="row">
            <div class="col-md-3 line"></div>
            <div class="col-md-3 line"></div>
            <div class="col-md-3 line"></div>
            <div class="col-md-3 line"></div>
         </div>
      </div>
   </div>
   <div data-barba="wrapper">
      <!-- PAGE HEADER -->
      <header class="header header_fixed js-header-sticky header_menu-center" id="page-header"
         data-arts-theme-text="dark" data-arts-header-sticky-theme="bg-light-1"
         data-arts-header-sticky-theme-text="dark" data-arts-header-overlay-theme-text="light">
         <div class="container header__controls">
            <div class="row align-items-center justify-content-between">
               <!-- logo -->
               <div class="col-auto col-md-2">
                  <a class="logo" href="<?php home_url(); ?>index.php">
                     <div class="logo__wrapper-img">
                        <img class="logo__img-primary" src="<?php home_url(); ?>assets/img/logo/logo-qamitech.png"
                           alt="Qamitech – obsługa IT i marketing dla firm" />
                     </div>
                  </a>
               </div>
               <!-- desktop menu-->
               <div class="col-auto header__col d-none d-xl-block col-md-10">
                  <ul class="menu js-menu text-end d-md-flex align-items-center justify-content-end">
                     <li class="nav-border menu-item-has-children"><a href="#">Oferta firmy</a>
                      <ul class="sub-menu">
                        <li><a href="<?php home_url(); ?>uslugi/tworzenie-stron-www.php">
                        <i class="material-icons" style="font-size:18px;width:20px;flex-shrink:0;">laptop_mac</i>
                        Tworzenie stron internetowych</a>
                        </li>
                        <li><a href="<?php home_url(); ?>uslugi/kampanie-google-ads.php">
                        <i class="material-icons" style="font-size:18px;width:20px;flex-shrink:0;">ads_click</i>
                        Kampanie Google Ads</a>
                        </li>
                        <li><a href="<?php home_url(); ?>uslugi/serwis-komputerowy.php">
                        <i class="material-icons" style="font-size:18px;width:20px;flex-shrink:0;">build</i>
                        Serwis komputerowy</a>
                        </li>
                        <li><a href="<?php home_url(); ?>uslugi/szkolenia-it.php">
                        <i class="material-icons" style="font-size:18px;width:20px;flex-shrink:0;">school</i>
                        Szkolenia IT</a>
                        </li>
                        <li><a href="<?php home_url(); ?>uslugi/sieci-lan-wlan.php">
                        <i class="material-icons" style="font-size:18px;width:20px;flex-shrink:0;">wifi</i>
                        Sieci Lan / Wlan</a>
                        </li>
                        <li><a href="<?php home_url(); ?>uslugi/pomoc-domowa.php">
                        <i class="material-icons" style="font-size:18px;width:20px;flex-shrink:0;">home_repair_service</i>
                        Pomoc domowa</a>
                        </li>
                        <li><a href="<?php home_url(); ?>uslugi/branding-dla-firm.php">
                        <i class="material-icons" style="font-size:18px;width:20px;flex-shrink:0;">brush</i>
                        Branding dla firm</a>
                        </li>
                        <li><a href="<?php home_url(); ?>uslugi/pozycjonowanie-stron.php">
                        <i class="material-icons" style="font-size:18px;width:20px;flex-shrink:0;">trending_up</i>
                        Pozycjonowanie stron</a>
                        </li>
                      </ul>
                    </li>
                     <li class="nav-border <?php if($page=='jak-dzialamy'){echo 'current-menu-ancestor';} ?>">
                        <a href="<?php home_url(); ?>index.php#how-we-work">Jak działamy?</a>
                     </li>
                     <li class="nav-border <?php if($page=='outsourcing'){echo 'current-menu-ancestor';} ?>">
                        <a href="<?php home_url(); ?>outsourcing.php">Outsourcing IT</a>
                     </li>
                     <li class="nav-border <?php if($page=='realizacje'){echo 'current-menu-ancestor';} ?>">
                        <a href="<?php home_url(); ?>realizacje/index.php">Realizacje</a>
                     </li>
                     <li class="nav-border <?php if($page=='blog'){echo 'current-menu-ancestor';} ?>">
                        <a href="<?php home_url(); ?>blog/index.php">Blog</a>
                     </li>
                     <li class="nav-border <?php if($page=='kontakt'){echo 'current-menu-ancestor';} ?>">
                        <a href="<?php home_url(); ?>kontakt.php">Kontakt</a>
                     </li>
                     <li class="nav-border <?php if($page=='kontakt'){echo 'current-menu-ancestor';} ?>">
                        <a href="<?php home_url(); ?>kontakt.php" class="button btn-dark">
                           <span class="button__label button__label-normal">
                              <span class="button__title">Skontaktujmy się</span>
                           </span>
                           <span class="button__label button__label-hover">
                              <span class="button__title">Skontaktujmy się</span>
                           </span>
                        </a>
                     </li>
                  </ul>
               </div>
               <!-- burger icon -->
               <div class="col-auto header__col d-flex align-items-center d-xl-none">
                  <a href="tel:+48501784882" class="header__mobile-phone d-xl-none me-3" 
                     style="display:flex!important;align-items:center;justify-content:center;width:42px;height:42px;border-radius:50%;background:var(--color-accent-1);color:#fff;text-decoration:none;">
                     <i class="material-icons" style="font-size:20px;line-height:1;">phone</i>
                  </a>
                  <div class="ms-auto header__burger" id="js-burger" data-arts-cursor="data-arts-cursor"
                     data-arts-cursor-scale="1.7" data-arts-cursor-magnetic="data-arts-cursor-magnetic"
                     data-arts-cursor-hide-native="true">
                     <div class="header__burger-line"></div>
                     <div class="header__burger-line"></div>
                     <div class="header__label header__burger-label">
                        <div class="header__label-burger header__label-burger_inner header__label-burger_closed-open">
                           Menu</div>
                        <div class="header__label-burger header__label-burger_inner header__label-burger_closed-hover">
                           Otwórz</div>
                        <div class="header__label-burger header__label-burger_inner header__label-burger_opened-open">
                           Zamknij</div>
                        <div class="header__label-burger header__label-burger_inner header__label-burger_opened-hover">
                           Zamknij</div>
                     </div>
                  </div>
               </div>
               <!--  button for submenu nav -->
               <div class="header__overlay-menu-back" id="js-submenu-back" data-arts-cursor="data-arts-cursor"
                  data-arts-cursor-scale="1.7" data-arts-cursor-magnetic="data-arts-cursor-magnetic"
                  data-arts-cursor-hide-native="true">
                  <i class="material-icons">arrow_back</i>
                  <div class="header__label header__label_status">
                     <div class="js-header-label-submenu"></div>
                  </div>
                  <div class="header__label header__label_opened-back">Wróć</div>
               </div>
            </div>
         </div>
         <!-- fullscreen overlay container -->
         <div class="header__wrapper-overlay-menu" data-arts-theme-text="light">
            <div class="mask-reveal w-100 h-100">
               <div class="mask-reveal__layer mask-reveal__layer-1 bg-accent-1">
                  <div class="mask-reveal__layer mask-reveal__layer-2">
                     <div class="row align-items-center h-100">
                        <!-- menu & bottom widgets -->
                        <div class="header__menu-column h-100 d-flex flex-column position-relative bg-dark-2">
                           <!-- virtual scrolling container -->
                           <div
                              class="header__scroll-container js-header-smooth-scroll-container overflow pointer-events-auto">
                              <div class="container">
                                 <ul class="menu-overlay js-menu-overlay">
                                    <li style="position:relative;">
                                       <a href="<?php home_url(); ?>oferta.php" data-pjax-link="overlayMenu">
                                          <div class="menu-overlay__item-wrapper arts-split-text js-arts-split-text"
                                             data-arts-split-text="lines,words" data-arts-split-text-set="lines"
                                             data-arts-split-text-overflow-wrap="lines">
                                             <span class="menu-overlay__subheading small mb-1">02</span>
                                             <div class="menu-overlay__heading h3">Oferta firmy</div>
                                          </div>
                                       </a>
                                       <span onclick="var u=document.getElementById('mob-oferta');var open=u.style.display==='block';u.style.display=open?'none':'block';this.innerHTML=open?'+':'&#8722;';" style="cursor:pointer;position:absolute;right:0;top:10px;padding:10px 20px;color:#fff;font-size:1.8rem;line-height:1;user-select:none;">+</span>
                                       <ul id="mob-oferta" style="display:none;list-style:none;padding:0 0 10px 10px;margin:0;">
                                          <li style="padding:5px 0;"><a href="<?php home_url(); ?>uslugi/tworzenie-stron-www.php" data-pjax-link="overlayMenu" style="color:rgba(255,255,255,0.7);font-size:15px;text-decoration:none;display:flex;align-items:center;gap:8px;"><i class="material-icons" style="font-size:16px;color:#A3D900;">laptop_mac</i>Tworzenie stron internetowych</a></li>
                                          <li style="padding:5px 0;"><a href="<?php home_url(); ?>uslugi/kampanie-google-ads.php" data-pjax-link="overlayMenu" style="color:rgba(255,255,255,0.7);font-size:15px;text-decoration:none;display:flex;align-items:center;gap:8px;"><i class="material-icons" style="font-size:16px;color:#A3D900;">ads_click</i>Kampanie Google Ads</a></li>
                                          <li style="padding:5px 0;"><a href="<?php home_url(); ?>uslugi/serwis-komputerowy.php" data-pjax-link="overlayMenu" style="color:rgba(255,255,255,0.7);font-size:15px;text-decoration:none;display:flex;align-items:center;gap:8px;"><i class="material-icons" style="font-size:16px;color:#A3D900;">build</i>Serwis komputerowy</a></li>
                                          <li style="padding:5px 0;"><a href="<?php home_url(); ?>uslugi/szkolenia-it.php" data-pjax-link="overlayMenu" style="color:rgba(255,255,255,0.7);font-size:15px;text-decoration:none;display:flex;align-items:center;gap:8px;"><i class="material-icons" style="font-size:16px;color:#A3D900;">school</i>Szkolenia IT</a></li>
                                          <li style="padding:5px 0;"><a href="<?php home_url(); ?>uslugi/sieci-lan-wlan.php" data-pjax-link="overlayMenu" style="color:rgba(255,255,255,0.7);font-size:15px;text-decoration:none;display:flex;align-items:center;gap:8px;"><i class="material-icons" style="font-size:16px;color:#A3D900;">wifi</i>Sieci Lan / Wlan</a></li>
                                          <li style="padding:5px 0;"><a href="<?php home_url(); ?>uslugi/pomoc-domowa.php" data-pjax-link="overlayMenu" style="color:rgba(255,255,255,0.7);font-size:15px;text-decoration:none;display:flex;align-items:center;gap:8px;"><i class="material-icons" style="font-size:16px;color:#A3D900;">home_repair_service</i>Pomoc domowa</a></li>
                                          <li style="padding:5px 0;"><a href="<?php home_url(); ?>uslugi/branding-dla-firm.php" data-pjax-link="overlayMenu" style="color:rgba(255,255,255,0.7);font-size:15px;text-decoration:none;display:flex;align-items:center;gap:8px;"><i class="material-icons" style="font-size:16px;color:#A3D900;">brush</i>Branding dla firm</a></li>
                                          <li style="padding:5px 0;"><a href="<?php home_url(); ?>uslugi/pozycjonowanie-stron.php" data-pjax-link="overlayMenu" style="color:rgba(255,255,255,0.7);font-size:15px;text-decoration:none;display:flex;align-items:center;gap:8px;"><i class="material-icons" style="font-size:16px;color:#A3D900;">trending_up</i>Pozycjonowanie stron</a></li>
                                       </ul>
                                    </li>
                                    <li>
                                       <a href="<?php home_url(); ?>index.php#how-we-work" data-pjax-link="overlayMenu">
                                          <div class="menu-overlay__item-wrapper arts-split-text js-arts-split-text"
                                             data-arts-split-text="lines,words" data-arts-split-text-set="lines"
                                             data-arts-split-text-overflow-wrap="lines">
                                             <span class="menu-overlay__subheading small mb-1">03</span>
                                             <div class="menu-overlay__heading h3">Jak dzia&#322;amy?</div>
                                          </div>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="<?php home_url(); ?>outsourcing.php" data-pjax-link="overlayMenu">
                                          <div class="menu-overlay__item-wrapper arts-split-text js-arts-split-text"
                                             data-arts-split-text="lines,words" data-arts-split-text-set="lines"
                                             data-arts-split-text-overflow-wrap="lines">
                                             <span class="menu-overlay__subheading small mb-1">04</span>
                                             <div class="menu-overlay__heading h3">Outsourcing IT</div>
                                          </div>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="<?php home_url(); ?>realizacje/index.php" data-pjax-link="overlayMenu">
                                          <div class="menu-overlay__item-wrapper arts-split-text js-arts-split-text"
                                             data-arts-split-text="lines,words" data-arts-split-text-set="lines"
                                             data-arts-split-text-overflow-wrap="lines">
                                             <span class="menu-overlay__subheading small mb-1">05</span>
                                             <div class="menu-overlay__heading h3">Realizacje</div>
                                          </div>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="<?php home_url(); ?>kontakt.php" data-pjax-link="overlayMenu">
                                          <div class="menu-overlay__item-wrapper arts-split-text js-arts-split-text"
                                             data-arts-split-text="lines,words" data-arts-split-text-set="lines"
                                             data-arts-split-text-overflow-wrap="lines">
                                             <span class="menu-overlay__subheading small mb-1">06</span>
                                             <div class="menu-overlay__heading h3">Kontakt</div>
                                          </div>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- PAGE MAIN CONTAINER -->
      <div class="js-smooth-scroll bg-dark-1" id="page-wrapper" data-barba="container">
         <!-- PAGE CONTENT -->
         <main class="page-wrapper__content">
