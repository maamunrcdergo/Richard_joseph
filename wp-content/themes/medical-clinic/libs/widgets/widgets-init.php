<?php
require_once dirname(__FILE__).'/widgets-social.php';
require_once dirname(__FILE__).'/widgets-contacts.php';
require_once dirname(__FILE__).'/widgets-gallery.php';
function theme_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar Left'),
        'id' => 'sidebar-left',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Sidebar Right'),
        'id' => 'sidebar-right',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</div></aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3><div class="winner">',
    ));
    global $mclinic_options;
    if ($mclinic_options['show_footer_widgets'] && !empty($mclinic_options['footer_widgets_count'])) {
        for ($i = 1; $i <= intval($mclinic_options['footer_widgets_count']); $i++) {
            register_sidebar(array(
                'name' => __('Footer Area '.$i),
                'id' => 'footer-area-'.$i,
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ));
        }
    }
    
   register_widget('Theme_Social_Widget');
   register_widget('Theme_Contact_Widget');
   register_widget('Gallery_Popup_Widget');
}

add_action('widgets_init', 'theme_widgets_init');
add_action('admin_enqueue_scripts', 'theme_widgets_admin_scripts');

function theme_widgets_admin_scripts() {
    wp_enqueue_media();
    wp_enqueue_style('theme-widgets-style', MCLINIC_THEME_URL . '/libs/widgets/scripts/theme-widgets-style.css');
    wp_enqueue_script('theme-widgets-js', MCLINIC_THEME_URL . '/libs/widgets/scripts/theme-widgets-js.js', array('jquery', 'media-upload'), '1.0', true);
    wp_localize_script('theme-widgets-js', 'theme_widgets_settings', array('ajax_url' => admin_url('admin-ajax.php'), 'action' => 'theme_widgets_stttings'));
}