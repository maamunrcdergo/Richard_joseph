<?php

/*
 * @package WP-@IllusiveDesign
 * @subpackage IllusiveDesign
 * @since IllusiveDesign 1.0
 * 2015(c) IllusiveDesign
 */
/*
  ########################drjoseph_wptheme_setup#################################
 */
if (!function_exists('drjoseph_wptheme_setup')) :

  function drjoseph_wptheme_setup() {
    load_theme_textdomain('drjoseph', DRJOSEPH_THEME_PATH . '/languages');
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_post_type_support('page', 'excerpt');
    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
      'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));
    add_theme_support('post-formats', array(
      'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio',
    ));
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(825, 510, true);
    add_image_size('square-thumb', 480, 480, true);

    register_nav_menu('main-menu', __('Main Menu', 'drjosefh'));
  }

  add_action('after_setup_theme', 'drjoseph_wptheme_setup');
endif;
/*
  ########################drjoseph_wptheme_scripts#################################
 */
if (!function_exists('drjoseph_wptheme_scripts')) :

  function drjoseph_wptheme_scripts() {
    global $drjoseph_options;
    //Fonts  
    $fonts = array(
      'Raleway' => '400,100,300,700,400italic,900',
    );
    wp_enqueue_style('theme-fonts', theme_font_url($fonts), array(), null);
    wp_enqueue_style('font-awesome', DRJOSEPH_THEME_URL . '/css/font-awesome.css');
    //Style
    wp_enqueue_style('bootstrap', DRJOSEPH_THEME_URL . '/css/bootstrap.min.css');
    wp_enqueue_style('owl_carousel_css', DRJOSEPH_THEME_URL . '/css/owl.carousel.css');
    wp_enqueue_style('animate_css', DRJOSEPH_THEME_URL . '/css/animate.css');
    wp_enqueue_style('wp_default_css', DRJOSEPH_THEME_URL . '/style.css');
    wp_enqueue_style('main_css', DRJOSEPH_THEME_URL . '/css/style.css');
    //Javascripts
    wp_enqueue_script('bootstrap', DRJOSEPH_THEME_URL. '/js/bootstrap.min.js', array('jquery'),3.0,FALSE);
    wp_enqueue_script('carousel', DRJOSEPH_THEME_URL . '/js/owl.carousel.js', array('jquery'),3.0,FALSE);
    wp_enqueue_script('imgViewer', DRJOSEPH_THEME_URL . '/js/imgViewer.js', array('jquery'),3.0,FALSE);
    wp_enqueue_script('datepicker', DRJOSEPH_THEME_URL . '/js/datepicker.js', array('jquery'),3.0,FALSE);
    wp_enqueue_script('waypoints', DRJOSEPH_THEME_URL . '/js/waypoints.min.js', array('jquery'),3.0,FALSE);
    wp_enqueue_script('drjoseph-js', DRJOSEPH_THEME_URL . '/js/them.js', array('jquery'),1.0,TRUE);
  }

  add_action('wp_enqueue_scripts', 'drjoseph_wptheme_scripts');
endif;
/*
  ########################drjoseph_wptheme_required_plugins#################################
 */

function drjoseph_wptheme_required_plugins() {
  $plugin = array(
    array(
      'name' => 'Advanced Custom Fields',
      'slug' => 'advanced-custom-fields',
      'source' => DRJOSEPH_THEME_LIBSPATH . '/plugins/advanced-custom-fields.zip',
      'required' => true,
      'version' => '',
      'force_activation' => TRUE,
      'force_deactivation' => FALSE,
      'external_url' => '',
      'is_callable' => '',
    ),
    array(
      'name' => 'Contact Form 7',
      'slug' => 'contact-form-7',
      'source' => DRJOSEPH_THEME_LIBSPATH . '/plugins/contact-form-7.zip',
      'required' => FALSE,
      'version' => '',
      'force_activation' => FALSE,
      'force_deactivation' => FALSE,
      'external_url' => '',
      'is_callable' => '',
    ),
    array(
      'name' => 'Really Simple CAPTCHA',
      'slug' => 'really-simple-captcha',
      'source' => DRJOSEPH_THEME_LIBSPATH . '/plugins/really-simple-captcha.zip',
      'required' => FALSE,
      'version' => '',
      'force_activation' => FALSE,
      'force_deactivation' => FALSE,
      'external_url' => '',
      'is_callable' => '',
    ),
  );
  $config = array(
    'has_notices' => true,
    'is_automatic' => true,
    'nag_type' => 'error',
  );
  tgmpa($plugin, $config);
}

add_action('tgmpa_register', 'drjoseph_wptheme_required_plugins');



if (!function_exists('theme_font_url')) {

  /**
   * Display the classes for the footer element.
   * @since 1.2
   */
  function theme_font_url($font_family = '', $weight = '') {
    $font_url = '';
    /*
     * Translators: If there are characters in your language that are not supported
     * by Lato, translate this to 'off'. Do not translate into your own language.
     */
    if (empty($font_family)) {
      $font_family = 'Open Sans';
    }

    if (empty($weight)) {
      $weight = '400,300,300italic,400italic,600,600italic,700,700italic';
    }

    if (is_array($font_family)) {
      $url = '';
      $index = 0;
      foreach ($font_family as $family => $weight) {
        if ($index != 0) {
          $url .= '|';
        }
//$bind_family = str_replace(" ", "+", $family);
        $bind_weight = str_replace(" ", "", $weight);
        $url .= $family . ':' . $bind_weight;


        $index++;
      }
      $urlencode = urlencode($url);
    }
    else {
//$bind_family = str_replace(" ", "+", $font_family);
      $bind_weight = str_replace(" ", "", $weight);
      $urlencode = urlencode($font_family . ':' . $bind_weight);
    }
    $font_url = add_query_arg('family', $urlencode, "//fonts.googleapis.com/css");

    return $font_url;
  }

}