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
    <script src="<?php echo DRJOSEPH_THEME_URL ?>/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <?php wp_head(); ?>	
  </head>
  <body <?php body_class(); ?>>
  <?php get_template_part('templates/browser', 'outdated'); ?>   
  	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'drjoseph' ); ?></a>  
     <?php wp_footer(); ?>	
  </body>
</html>
