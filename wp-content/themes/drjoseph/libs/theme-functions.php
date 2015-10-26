
     <?php

     /*
      * @package WP-@IllusiveDesign
      * @subpackage IllusiveDesign
      * @since IllusiveDesign 1.0
      * 2015(c) IllusiveDesign
      */

     function illusive_layout($class = '') {
         global $illusive_redux;
         $layout_class = !empty($illusive_redux['site_layout']) ? 'container' : 'container-fluid';
         $layout_class = apply_filters('illusive_site_layout', $layout_class);
         $layout_class .=!empty($class) ? ' ' . $class : '';
         echo $layout_class;
     }

     function illusive_slider_layout($class = '') {
         global $illusive_redux;
         $layout_class = !empty($illusive_redux['home_slider_layout']) ? 'container' : 'container-fluid';
         $layout_class = apply_filters('home_slider_layout', $layout_class);
         $layout_class .=!empty($class) ? ' ' . $class : '';
         echo $layout_class;
     }

     function illusive_sliders() {
         global $illusive_redux;
         $slider_type = $illusive_redux['home_slider'];
         switch ($slider_type) :
             case 'theme-parallax':
                 illusive_parallax_slider_content();
                 break;
             case 'theme-camera':
                 illusive_sliders_slider_content();
                 break;
             default :
                 echo do_shortcode($illusive_redux['home_slider_shortcode']);
                 break;
         endswitch;
     }

     function illusive_parallax_slider_content() {
         global $illusive_redux;
         $theme_slides = $illusive_redux['theme_parallax_slides'];
         $parallax_wrap = '<div class="parallax_wrap" id="illusibve-parallax-slider">';
         if (!empty($theme_slides)) {
             $slider_count = count($theme_slides);

             $doted = '';

             foreach ($theme_slides as $key => $slide) {
                 $doted .= sprintf('<li><a href="#slider-%1$s" title="Next Section"></a></li>', $key);
                 $parallax_wrap .= sprintf('<div id="slider-%1$s" data-parallax="scroll" data-image-src="%2$s">', $key, $slide['image']);
                 $parallax_wrap .= sprintf('<h2 class="slider_title">%1$s<h2>', $slide['title']);
                 $parallax_wrap .= sprintf('<p class="slider_description">%1$s</p>', $slide['description']);
                 $parallax_wrap .= sprintf('<a href="">%1$s</a>', $slide['url']);


                 $parallax_wrap .= sprintf('</div>');
             }

             $parallax_wrap .= sprintf('<ul id="nav">%s</ul>', $doted);
             
         }
         $parallax_wrap .= sprintf('</div>');
         print $parallax_wrap;
     }

     function illusive_sliders_slider_content() {
         global $illusive_redux;
         $theme_slides = $illusive_redux['theme_slides'];
         $camera_wrap = '<div class="camera_wrap" id="illusibve-theme-slider">';
         if (!empty($theme_slides)) {
             foreach ($theme_slides as $key => $slide) {
                 $slideContent = '<div class="camera_caption">' . do_shortcode($slide['description']) . '</div>';
                 $camera_wrap .= sprintf('<div data-src="%1$s">%2$s</div>', $slide['image'], $slideContent);
             }
         }
         $slide_height = $illusive_redux['theme_slides_height'];
         $colors = $illusive_redux['theme_slides_colors'];
         $camera_wrap .= '</div>';
         $camera_wrap .= "<script>";
         $camera_wrap .= "jQuery('#illusibve-theme-slider').camera({ "
                 . "height: '{$slide_height}',"
                 . "fx: 'scrollLeft',"
                 . "pagination: true,"
                 . "thumbnails: false,"
                 . "loaderColor: '{$colors}',"
                 . "minHeight: '250px',"
                 . "loader: 'none',"
                 . "playPause: 'false',"
//               . "autoAdvance: 'false',"
//               . "navigationHover: 'false',"
                 . "});";
         $camera_wrap .= "</script>";

         print $camera_wrap;
     }

     function illusive_page_banner() {
         global $illusive_redux;

         if (is_page() || is_single()) {
             $post_id = get_the_ID();
             $banner_img = get_field('banner_image', $post_id);
             $banner_height = get_field('banner_height', $post_id);
             $banner_height = !empty($banner_height) ? $banner_height : 250;
             printf('<div class="banner-img" style="background-image:url(%1$s);height:%2$spx;"></div>', $banner_img, $banner_height);
         }
     }

     function illusive_contact_nav() {
         global $illusive_redux;
         $topcontent = $illusive_redux['support_phone'];
         echo '<div class="topbar-nav pull-right">';
         echo '<ul class="topbar-nav-menu">';
         if (!empty($topcontent)) {

             echo '<li class="menu-item">';
             echo '<a href="tel:' . $topcontent . '"><i class="illusive-icon-phone"></i></a>';
             echo '</li>';
             echo '<li class="menu-item">';
             echo '<a href="#Content-4-widgets"><i class="illusive-icon-comments"></i></a>';
             echo '</li>';
         }
         echo '</ul>';
         echo '</div>';
     }

     function get_acpt_plugins($plugins = '') {
         $illusive_redux = get_option('illusive_redux');
         $plugins = array();
         $featureds = array('sliders', 'profile', 'news', 'events', 'notice', 'albums', 'blog', 'brochure');
         foreach ($featureds as $ftd) {
             $active = $illusive_redux['illusive_featured_' . $ftd];
             if (!empty($active)) {
                 $plugins[] = $ftd;
             }
         }

         return $plugins;
     }

     add_filter('acpt_plugins', 'illusive_contents_featured');



//function optionsframework_option_name() {
//    // This gets the theme name from the stylesheet
//    $themename = wp_get_theme();
//    $themename = preg_replace("/\W/", "_", strtolower($themename));
//
//    $optionsframework_settings = get_option('optionsframework');
//    $optionsframework_settings['id'] = $themename;
//    update_option('optionsframework', $optionsframework_settings);
//}
//
//if ( ! function_exists( 'of_get_option' ) ) :
//function of_get_option( $name, $default = false ) {
//
//	$option_name = '';
//
//	// Gets option name as defined in the theme
//	if ( function_exists( 'optionsframework_option_name' ) ) {
//		$option_name = optionsframework_option_name();
//	}
// 
//	// Fallback option name
//	if ( '' == $option_name ) {
//		$option_name = get_option( 'stylesheet' );
//		$option_name = preg_replace( "/\W/", "_", strtolower( $option_name ) );
//	}
//
//	// Get option settings from database
//	$options = get_option( $option_name );
//       
//	// Return specific option
//	if ( isset( $options[$name] ) ) {
//		return $options[$name];
//	}
//
//	return $default;
//}
//endif;





