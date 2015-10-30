<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <script src="<?php echo MCLINIC_THEME_URL ?>/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <?php
    wp_head();
    global $mclinic_options;
    ?>	
  </head>
  <body <?php body_class(); ?>>
    <?php get_template_part('templates/browser', 'outdated'); ?>     
    <div id="page" class="hfeed site">
      <span id="top" class="sr-only"><?php _e('Page Top');?></span> 
      <a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'mclinic'); ?></a>  
      <header id="site-header">
        <div class="top_header"><!-- Top Header -->
          <nav class="navbar navbar-default navbar-fixed-top"><!-- Menu -->
            <div class="container"> 
              <div class="navbar-header">
                <button id="mm-button-toggle" class="navbar-toggle " type="button">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
               </button>
                <h1 class="site-title"><a class="navbar-brand os" data-animate="fadeInLeft" href="<?php echo MCLINIC_HOME_URL; ?>" rel="home">
                    <?php
                    if (!empty($mclinic_options['show_logo'])) {
                      printf('<img class="img-responsive logo pull-left" src="%s" alt="logo"/>', $mclinic_options['logo_url']['url']);
                    }
                    ?>
                    <span class="main_title visible-sm"><?php bloginfo('name'); ?></span>

                  </a></h1>
              </div>
              <?php theme_primary_menu();?>              
            </div>
          </nav><!-- Menu End -->
        </div><!-- Top Header End -->
      </header><!--/#site-header -->