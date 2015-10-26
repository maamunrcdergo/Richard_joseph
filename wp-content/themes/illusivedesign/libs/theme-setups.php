<?php

/*
 * @package WP-@IllusiveDesign
 * @subpackage IllusiveDesign
 * @since IllusiveDesign 1.0
 * 2015(c) IllusiveDesign
 */
if (!function_exists('illusive_wptheme_setup')) :

    function illusive_wptheme_setup() {
        load_theme_textdomain(ILLUSIVE_THEME, ILLUSIVE_THEME_DIR . '/languages');
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_post_type_support('page', 'excerpt');

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'primary-nav' => __('Primary Menu', ILLUSIVE_THEME),
            'primary-sm-nav' => __('Primary Small Device Menu', ILLUSIVE_THEME),
            'footer-nav' => __('Footer Links Menu', ILLUSIVE_THEME),
            'topbar-nav' => __('Topbar Links Menu', ILLUSIVE_THEME),
        ));
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
    }

    add_action('after_setup_theme', 'illusive_wptheme_setup');
endif;
if (!function_exists('illusive_wptheme_scripts')) :

    function illusive_wptheme_scripts() {
        global $illusive_redux;

        $fonts = array(
            'Roboto' => '400,100,300,700,400italic,900',
        );
        wp_enqueue_style('theme-fonts', theme_font_url($fonts), array(), null);


        //Icon front
        wp_enqueue_style('font-awesome', ILLUSIVE_THEME_ASSETS_URI . '/font-awesome/css/font-awesome.min.css', array(), '4.3.0');
        //Illusive front
        wp_enqueue_style('illusive-icon', ILLUSIVE_THEME_ASSETS_URI . '/css/illusive-icon.css', array(), '4.3.0');
        //Bootstrap Customized
        wp_enqueue_style('bootstarp', ILLUSIVE_THEME_ASSETS_URI . '/css/bootstrap.css', array(), '3.3.5');
        wp_enqueue_script('bootstarp-js', ILLUSIVE_THEME_ASSETS_URI . '/js/bootstrap.min.js', array('jquery'), '3.3.5', FALSE);

        //Owl Carousel
        wp_enqueue_style('owl-carousel-css', ILLUSIVE_THEME_ASSETS_URI . '/css/owl.carousel.css', array(), '3.3.5');
        wp_enqueue_script('owl-carousel-js', ILLUSIVE_THEME_ASSETS_URI . '/js/owl.carousel.js', array('jquery'), '3.3.5', FALSE);
        wp_enqueue_script('imagesloaded-js', ILLUSIVE_THEME_ASSETS_URI . '/js/imagesloaded.pkgd.min.js');
        
        wp_enqueue_script('social-share', get_template_directory_uri() . '/widgets/scripts/buttons.js');
        
        
        wp_enqueue_script('scrollTo', ILLUSIVE_THEME_ASSETS_URI . '/js/jquery.scrollTo-1.4.2-min.js', array('jquery'));
        wp_enqueue_script('localscroll', ILLUSIVE_THEME_ASSETS_URI . '/js/jquery.localscroll-1.2.7-min.js', array('jquery'));
        wp_enqueue_script('parallax', ILLUSIVE_THEME_ASSETS_URI . '/js/jquery.parallax-1.1.3.js',array('jquery'),1.1,false);
        wp_enqueue_style('parallax-css', ILLUSIVE_THEME_ASSETS_URI . '/css/parallax-style.css');
        
        //Page Loader
        //wp_enqueue_style('pageloader-css', ILLUSIVE_THEME_ASSETS_URI . '/page-loader/css/introLoader.css', array(), '1.6.2');
        //wp_enqueue_script('pageloader-js', ILLUSIVE_THEME_ASSETS_URI . '/page-loader/jquery.introLoader.pack.min.js', array('jquery'), '1.6.2', FALSE);
        //Mobile MEnu
        // wp_enqueue_style('mmenu-style', ILLUSIVE_THEME_ASSETS_URI . '/css/jquery.mmenu.all.css', array(), '5.3.0');
        // wp_enqueue_script('mmenu-js', ILLUSIVE_THEME_ASSETS_URI . '/js/jquery.mmenu.min.all.js', array('jquery'), '5.3.0', FALSE);
        //Slider script
        $slider_type = $illusive_redux['home_slider'];
        if ($slider_type == 'theme-camera') {
            wp_enqueue_style('camera-slider-css', ILLUSIVE_THEME_ASSETS_URI . '/camera/css/camera.css', array(), ILLUSIVE_THEME_VAR);
            wp_enqueue_script('easing', ILLUSIVE_THEME_ASSETS_URI . '/camera/scripts/jquery.easing.1.3.js', array('jquery'), '1.3', FALSE);
            if (wp_is_mobile()) {
                wp_enqueue_script('jquery-mobile', ILLUSIVE_THEME_ASSETS_URI . '/camera/scripts/jquery.mobile.customized.min.js', array('jquery'), '1.3', FALSE);
            }
            wp_enqueue_script('camera-scripts', ILLUSIVE_THEME_ASSETS_URI . '/camera/scripts/camera.min.js', array('jquery'), ILLUSIVE_THEME_VAR, FALSE);
        }
        //jquery magnific popup
        //wp_enqueue_style('magnific-popup', ILLUSIVE_THEME_ASSETS_URI . '/css/magnific-popup.css', array(), '1.0.0');
        //wp_enqueue_script('jquery.magnific-popup', ILLUSIVE_THEME_ASSETS_URI . '/js/jquery.magnific-popup.min.js', array('jquery'), '1.0.0', FALSE);
        //custom Stye
        wp_enqueue_style(ILLUSIVE_THEME . '-style', ILLUSIVE_THEME_ASSETS_URI . '/css/' . ILLUSIVE_THEME . '.css', array('bootstarp'), ILLUSIVE_THEME_VAR);
        wp_enqueue_script(ILLUSIVE_THEME . '-js', ILLUSIVE_THEME_ASSETS_URI . '/js/' . ILLUSIVE_THEME . '.js', array('jquery'), ILLUSIVE_THEME_VAR, true);
        wp_localize_script(ILLUSIVE_THEME . '-js', 'illusive_objects', array(
            'site_url' => get_site_url(),
            'ajaxUrl' => admin_url('ajax.php'),
            'mm_theme' => $illusive_redux['mobile_menu_theme'],
            'mm_show_logo' => ($illusive_redux['show_logo_sx']) ? TRUE : FALSE,
            'mm_logo' => $illusive_redux['logo_url_sx']['url'],
                )
        );
    }

    add_action('wp_enqueue_scripts', 'illusive_wptheme_scripts');
endif;

function illusive_required_plugins() {
    $plugin = array(
        array(
            'name' => 'Advanced Custom Fields',
            'slug' => 'advanced-custom-fields',
            'source' => ILLUSIVE_THEME_LIBS_DIR . '/plugins/advanced-custom-fields.zip',
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
            'source' => ILLUSIVE_THEME_LIBS_DIR . '/plugins/contact-form-7.zip',
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
            'source' => ILLUSIVE_THEME_LIBS_DIR . '/plugins/really-simple-captcha.zip',
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

add_action('tgmpa_register', 'illusive_required_plugins');



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
        } else {
//$bind_family = str_replace(" ", "+", $font_family);
            $bind_weight = str_replace(" ", "", $weight);
            $urlencode = urlencode($font_family . ':' . $bind_weight);
        }
        $font_url = add_query_arg('family', $urlencode, "//fonts.googleapis.com/css");

        return $font_url;
    }

}