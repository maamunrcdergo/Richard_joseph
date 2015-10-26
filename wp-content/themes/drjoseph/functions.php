<?php 
define('DRJOSEPH_THEME_URL', get_stylesheet_directory_uri());
define('DRJOSEPH_THEME_PATH', get_stylesheet_directory());
define('DRJOSEPH_HOME_URL',  home_url( '/' ));

	
	function drjosefh_default_function(){
            add_theme_support('title-tag');
            add_theme_support('post-thumbnails');
            add_theme_support('custom-background');
            register_post_type('drjosefh_service',array(
                'labels' =>array(
                    'name' =>'Services',
                    'add_new_item' => __('add new services','drjosefh_service'),
                    ),
                    'public' => true,
                    'supports' => array('title','editor','thumbnail'),
                    'menu_icon'=> get_template_directory_uri().'/images/service.png',
            ));
            
            load_theme_textdomain('drjosefh', get_template_directory_uri().'/languages');
            if(function_exists('register_nav_menu')){
                register_nav_menu('main-menu',__('Main Menu','drjosefh'));
            }
            
            
            //------------------------CSS & JS ADD ---------------------
            wp_register_style('bootstrap' , get_template_directory_uri().'/css/bootstrap.min.css');
            wp_register_style('font-awesome' , get_template_directory_uri().'/css/font-awesome.css');
            wp_register_style('owl_carousel_css' , get_template_directory_uri().'/css/owl.carousel.css');
            wp_register_style('animate_css' , get_template_directory_uri().'/css/animate.css');
            wp_register_style('wp_default_css' , get_template_directory_uri().'/style.css');
            wp_register_style('main_css' , get_template_directory_uri().'/css/style.css');
            
            
            //CSS
            wp_enqueue_style('bootstrap');
            wp_enqueue_style('font-awesome');
            wp_enqueue_style('owl_carousel_css');
            wp_enqueue_style('animate_css');
            wp_enqueue_style('wp_default_css');
            wp_enqueue_style('main_css');
            
            //js
            wp_enqueue_script('jquery_main', get_template_directory_uri().'/js/jquery.min.js');
            wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery_main'));
            wp_enqueue_script('carousel', get_template_directory_uri().'/js/owl.carousel.js', array('jquery_main'));
            wp_enqueue_script('imgViewer', get_template_directory_uri().'/js/imgViewer.js', array('jquery_main'));
            wp_enqueue_script('datepicker', get_template_directory_uri().'/js/datepicker.js', array('jquery_main'));
            wp_enqueue_script('waypoints', get_template_directory_uri().'/js/waypoints.min.js', array('jquery_main'));
            wp_enqueue_script('them', get_template_directory_uri().'/js/them.js', array('jquery_main'));
            //JS
            wp_enqueue_script('jquery_main');
            wp_enqueue_script('bootstrap');
            wp_enqueue_script('carousel');
            wp_enqueue_script('imgViewer');
            wp_enqueue_script('datepicker');
            wp_enqueue_script('waypoints');
            wp_enqueue_script('them');
             //------------------------CSS & JS End ---------------------
            
            
	}
        add_action('after_setup_theme','drjosefh_default_function');
        
        
        //Default menu
        function defauli_main_menu(){
            echo '<ul class="nav navbar-nav">';
                echo '<li><a href="'.home_url().'">Home</a></li>';
            echo '</ul>';
        }
        require_once ('navwalker.php');
        require_once ('navwalker.php');
        //Default menu End
?>