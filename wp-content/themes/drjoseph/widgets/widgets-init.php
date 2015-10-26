<?php
add_filter('widget_text', 'do_shortcode');
/**
 * Register widgetized area and update sidebar with default widgets.
 */
require_once(get_template_directory() . "/widgets/widgets-featured-content.php");
require_once(get_template_directory() . "/widgets/widgets-advanced-featured.php");
require_once(get_template_directory() . "/widgets/widgets-page-carousel.php");
require_once(get_template_directory() . "/widgets/widgets-brochure.php");
require_once(get_template_directory() . "/widgets/widgets-blogs.php");
require_once(get_template_directory() . "/widgets/widgets-social.php");
require_once(get_template_directory() . "/widgets/widgets-services.php");
require_once(get_template_directory() . "/widgets/widgets-social-share.php");
require_once(get_template_directory() . "/widgets/quote/widgets.php");
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
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    global $illusive_redux;
    if ($illusive_redux['show_footer_widgets'] && !empty($illusive_redux['footer_widgets_count'])) {
        for ($i = 1; $i <= intval($illusive_redux['footer_widgets_count']); $i++) {
            register_sidebar(array(
                'name' => __('Footer Area ' . $i),
                'id' => 'footer-area-' . $i,
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ));
        }
    }
    $home_widgets_col = empty($illusive_redux['home_widget_col']) ? 'col-xs-12' : $illusive_redux['home_widget_col'];
    $home_widgets_col_2 = empty($illusive_redux['home_widget_col_2']) ? 'col-xs-12 col-sm-6' : $illusive_redux['home_widget_col_2'];
    $home_widgets_col_3 = empty($illusive_redux['home_widget_col_3']) ? 'col-xs-12 col-sm-4' : $illusive_redux['home_widget_col_3'];
    register_sidebar(array(
        'name' => __('Home Content 1 Widgets'),
        'id' => 'home-content-1-widgets',
        'before_widget' => '<aside id="%1$s" class="widget %2$s ' . $home_widgets_col . ' home-widgets">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Home Content 2 Widgets'),
        'id' => 'home-content-2-widgets',
        'before_widget' => '<aside id="%1$s" class="widget %2$s ' . $home_widgets_col . ' home-widgets">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Home Content 3 Widgets'),
        'id' => 'home-content-3-widgets',
        'before_widget' => '<aside id="%1$s" class="widget %2$s ' . $home_widgets_col_3 . ' home-widgets">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Home Content 4 Widgets'),
        'id' => 'home-content-4-widgets',
        'before_widget' => '<aside id="%1$s" class="widget %2$s ' . $home_widgets_col . ' home-widgets">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Home Content 5 Widgets'),
        'id' => 'home-content-5-widgets',
        'before_widget' => '<aside id="%1$s" class="widget %2$s ' . $home_widgets_col_2 . ' home-widgets">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Home Subscribe'),
        'id' => 'home-subscribe',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));


    register_sidebar(array(
        'name' => __('Footer Widget 1'),
        'id' => 'footer-widget-1',
        'description' => __('Used for footer widget area'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer Widget 2'),
        'id' => 'footer-widget-2',
        'description' => __('Used for footer widget area'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer Widget 3'),
        'id' => 'footer-widget-3',
        'description' => __('Used for footer widget area'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_widget('Featured_contents_Widget');
    register_widget('Advanced_Featured_Widget');
    register_widget('Page_Carousel_Widget');
    register_widget('Illusive_Brochure_Widget');
    register_widget('Illusive_Blog_Widget');
    register_widget('Theme_Social_Widget');
    register_widget('Illusive_Services_Widgets');
    register_widget('Illusive_Social_Share_Widget');
    //register_widget('Gallery_Popup_Widget');
}

add_action('widgets_init', 'theme_widgets_init');

function theme_widgets_admin_scripts() {
    
    wp_enqueue_media();
    wp_enqueue_style('icon-illusive', get_template_directory_uri() . '/widgets/scripts/illusive-icon.css');
    wp_enqueue_style('theme-widgets-style', get_template_directory_uri() . '/widgets/scripts/theme-widgets-style.css');

    wp_enqueue_script('theme-widgets-js', get_template_directory_uri() . '/widgets/scripts/theme-widgets-js.js', array('jquery', 'media-upload'), '1.0', true);
    wp_localize_script('theme-widgets-js', 'theme_widgets_settings', array('ajax_url' => admin_url('admin-ajax.php'), 'action' => 'theme_widgets_stttings'));
       

    $icons = array(
        'none' => 'Select Icon',
        'illusive-icon-ecommerce' => 'ecommerce',
        'illusive-icon-website' => 'website',
        'illusive-icon-support-maintenance' => 'support-maintenance',
        'illusive-icon-phone' => 'phone',
        'illusive-icon-comments' => 'comments',
        'illusive-icon-branding' => 'branding',
        'illusive-icon-start-ups' => 'start-ups',
        'illusive-icon-businesses' => 'businesses',
        'illusive-icon-agencies' => 'agencies'
    );
    wp_localize_script('theme-widgets-js', 'icons', $icons);
    wp_enqueue_script('illusive-icon');
}

add_action('admin_enqueue_scripts', 'theme_widgets_admin_scripts');

function theme_widgets_ajax_callback() {
    $query = $_POST['query'];
    switch ($query) {
        case 'get_parent_posts':
            $ptype = $_POST['post_type'];
            $posts = get_theme_widgets_posts($ptype);
            if (!empty($posts)) {
                $options = '';
                foreach ($posts as $post) {
                    $options .= sprintf('<option value="%1$s" selected>%2$s</option>', $post->ID, $post->post_title);
                }
                $segments = array('parent_pages' => $options);
                echo json_encode($segments);
            }
            break;
    }
    exit();
}

add_action('wp_ajax_theme_widgets_stttings', 'theme_widgets_ajax_callback');

function get_theme_widgets_posts($type = 'post', $parent = 0) {
    $posts = get_posts(array('post_type' => $type, 'posts_per_page' => -1, 'post_parent' => $parent));
    return $posts;
}

//add_filter('in_widget_form', 'bootstrap_widget_grid', 100, 3);

function bootstrap_widget_grid($t, $return, $instance) {
    $instance = wp_parse_args((array) $instance, array('title' => '', 'text' => '', 'float' => 'none'));
    if (!isset($instance['bs_grid']))
        $instance['bs_grid'] = 12;
    ?>
    <p>
        <label for="<?php echo $t->get_field_id('bs_grid'); ?>">Grid(1-12):</label>
        <select id="<?php echo $t->get_field_id('bs_grid'); ?>" name="<?php echo $t->get_field_name('bs_grid'); ?>">
            <option <?php selected($instance['bs_grid'], '1'); ?> value="1">Column One</option>
            <option <?php selected($instance['bs_grid'], '2'); ?>value="2">Column Two</option>
            <option <?php selected($instance['bs_grid'], '3'); ?> value="3">Column Three</option>
            <option <?php selected($instance['bs_grid'], '4'); ?> value="4">Column Four</option>
            <option <?php selected($instance['bs_grid'], '5'); ?> value="5">Column Five</option>
            <option <?php selected($instance['bs_grid'], '6'); ?> value="6">Column Six</option>
            <option <?php selected($instance['bs_grid'], '7'); ?> value="7">Column Seven</option>
            <option <?php selected($instance['bs_grid'], '8'); ?> value="8">Column Eight</option>
            <option <?php selected($instance['bs_grid'], '9'); ?> value="9">Column Nine</option>
            <option <?php selected($instance['bs_grid'], '10'); ?> value="10">Column Ten</option>
            <option <?php selected($instance['bs_grid'], '11'); ?> value="11">Column Eleven</option>
            <option <?php selected($instance['bs_grid'], '12'); ?> value="11">Column Twelve</option>
        </select>
    </p>

    <?php
    $retrun = null;
    return array($t, $return, $instance);
}
