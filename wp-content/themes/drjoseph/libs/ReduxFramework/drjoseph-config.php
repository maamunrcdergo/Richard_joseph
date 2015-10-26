<?php

/*
 * @package WP-@IllusiveDesign
 * @subpackage RideFlag
 * @since RideFlag 1.0
 * 2015(c) IllusiveDesign
 */
if (!class_exists('Redux')) {
    return;
}

class DrjosephOptionConfig {

    var $opt_name = "drjoseph_options";
    var $theme;
    var $args;
    var $media_url;

    function __construct() {
        $this->theme = wp_get_theme();
        $this->media_url = DRJOSEPH_THEME_URL . '/images/';
        $this->opt_name = apply_filters('drjoseph_options', $this->opt_name);

        $this->addActions();
        $this->setArgs();
        $this->init();
        $this->addFilters();
    }

    public function addActions() {
        add_action("redux/extensions/{$this->opt_name}/before", array($this, 'addExtensions'), 0);
        add_action('admin_enqueue_scripts', array($this, 'scripts'));
    }

    public function addFilters() {
        
    }

    public function init() {
        Redux::setArgs($this->opt_name, $this->args);
        $sections = $this->addSections();
        Redux::setSections($this->opt_name, $sections);
    }

    public function setArgs() {
        $this->args = array(
            'opt_name' => $this->opt_name,
            'display_name' => $this->theme->get('Name'),
            'display_version' => $this->theme->get('Version'),
            'menu_type' => 'menu',
            'allow_sub_menu' => true,
            'menu_title' => __('Theme Options', 'drjoseph'),
            'page_title' => __('Theme Options', 'drjoseph'),
            'google_api_key' => '',
            'google_update_weekly' => false,
            'async_typography' => true,
            'admin_bar' => true,
            'admin_bar_icon' => 'dashicons-admin-tools',
            'admin_bar_priority' => 50,
            'global_variable' => '',
            'dev_mode' => FALSE,
            'update_notice' => FALSE,
            'customizer' => true,
            'page_priority' => 50,
            'page_parent' => 'themes.php',
            'page_permissions' => 'manage_options',
            'menu_icon' => $this->media_url . '/theme-options.png',
            'last_tab' => '',
            'page_icon' => 'dashicons-admin-tools',
            'page_slug' => '',
            'save_defaults' => false,
            'default_show' => false,
            'default_mark' => '',
            'show_import_export' => true,
            'transient_time' => 60 * MINUTE_IN_SECONDS,
            'output' => true,
            'output_tag' => true,
            'footer_credit' => '',
            'database' => '',
            'hints' => array(
                'icon' => 'el el-question-sign',
                'icon_position' => 'right',
                'icon_color' => 'lightgray',
                'icon_size' => 'normal',
                'tip_style' => array(
                    'color' => 'red',
                    'shadow' => true,
                    'rounded' => false,
                    'style' => '',
                ),
                'tip_position' => array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                ),
                'tip_effect' => array(
                    'show' => array(
                        'effect' => 'slide',
                        'duration' => '500',
                        'event' => 'mouseover',
                    ),
                    'hide' => array(
                        'effect' => 'slide',
                        'duration' => '500',
                        'event' => 'click mouseleave',
                    ),
                ),
            )
        );

// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
        $this->args['admin_bar_links'][] = array(
            'id' => 'redux-docs',
            'href' => 'http://docs.reduxframework.com/',
            'title' => __('Documentation', 'redux-framework-demo'),
        );

        $this->args['admin_bar_links'][] = array(
            //'id'    => 'redux-support',
            'href' => 'https://github.com/ReduxFramework/redux-framework/issues',
            'title' => __('Support', 'redux-framework-demo'),
        );

        $this->args['admin_bar_links'][] = array(
            'id' => 'redux-extensions',
            'href' => 'reduxframework.com/extensions',
            'title' => __('Extensions', 'redux-framework-demo'),
        );

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
        $this->args['share_icons'][] = array(
            'url' => 'https://github.com/ReduxFramework/ReduxFramework',
            'title' => 'Visit ReduxFramework on GitHub',
            'icon' => 'el el-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
        );
        $this->args['share_icons'][] = array(
            'url' => 'https://www.facebook.com/illusivedesign',
            'title' => 'Like us on Facebook',
            'icon' => 'el el-facebook'
        );
        $this->args['share_icons'][] = array(
            'url' => 'https://twitter.com/iLLusiveDesign2',
            'title' => 'Follow us on Twitter',
            'icon' => 'el el-twitter'
        );
        $this->args['share_icons'][] = array(
            'url' => 'https://www.linkedin.com/pub/illusive-design/8a/7a4/951',
            'title' => 'Find us on LinkedIn',
            'icon' => 'el el-linkedin'
        );
        $this->args['share_icons'][] = array(
            'url' => 'https://www.youtube.com/channel/UC4vJqSU7BdgR19t16Y8xMJA',
            'title' => 'Find us on Youtube',
            'icon' => 'el el-youtube'
        );
        // Panel Intro text -> before the form
        if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
            if (!empty($this->args['global_variable'])) {
                $v = $this->args['global_variable'];
            } else {
                $v = str_replace('-', '_', $this->args['opt_name']);
            }
            $this->args['intro_text'] = sprintf(__('<p>To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'drjoseph'), $v);
        } else {
            $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'drjoseph');
        }

        // Add content after the form.
        $this->args['footer_text'] = __("<p>&copy;2015 Modified by <a href=\"{$this->theme->ThemeURI}\">{$this->theme->Author}</a></p>", 'drjoseph');
    }

    public function addSections() {
        $sections[] = $this->optionBasic();
        //$sections[] = $this->optionFeatures();
        //$sections[] = $this->optionStyles();
       // $sections[] = $this->optionTypography();
       // $sections[] = $this->optionSlider();
      //  $sections[] = $this->optionHome();
      //  $sections[] = $this->optionFooter();
      //  $sections[] = $this->optionSocial();

        return apply_filters('add_illusive_theme_option', $sections);
    }

    function optionBasic() {
        $fields = array(
            array(
                'id' => 'show_logo',
                'type' => 'switch',
                'title' => __('Show Logo', 'drjoseph'),
                'subtitle' => __('Others showing site title.', 'drjoseph'),
                'default' => true,
            ),
            array(
                'id' => 'logo_url',
                'type' => 'media',
                'url' => true,
                'title' => __('Logo', 'drjoseph'),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Basic media uploader with disabled URL input field.', 'drjoseph'),
                'default' => array('url' => $this->media_url . 'default-logo.png'),
                'required' => array('show_logo', '=', '1'),
            ),
            array(
                'id' => 'show_logo_sx',
                'type' => 'switch',
                'title' => __('Enable Mobile Logo', 'drjoseph'),
                'subtitle' => __('In small device  show a alternative Logo', 'drjoseph'),
                'default' => true,
            ),
            array(
                'id' => 'logo_url_sx',
                'type' => 'media',
                'url' => true,
                'title' => __('Logo', 'drjoseph'),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Basic media uploader with disabled URL input field.', 'drjoseph'),
                'default' => array('url' => $this->media_url . 'default-logo-sx.png'),
                'required' => array('show_logo_sx', '=', '1'),
            ),
            array(
                'id' => 'show_tagline',
                'type' => 'switch',
                'title' => __('Show Tagline', 'drjoseph'),
                'default' => FALSE,
            ),
            array(
                'id' => 'custom_favicon',
                'type' => 'media',
                'url' => true,
                'title' => __('Custom Favicon Icon', 'drjoseph'),
                'default' => array('url' => $this->media_url . 'favicon.ico'),
                'preview' => false,
            ),
            array(
                'id' => 'support_phone',
                'type' => 'text',
                'title' => __('Support Phone', 'drjoseph'),
            ),
            array(
                'id' => 'site_layout',
                'type' => 'switch',
                'title' => __('Site Layout', 'drjoseph'),
                'default' => 1,
                'on' => 'Boxed',
                'off' => 'Fluid',
            ),
            array(
                'id' => 'site_breakpoint',
                'type' => 'select',
                'title' => __('Break Point', 'drjoseph'),
                'options' => array(
                    '768' => '768px',
                    '992' => '992px',
                    '1200' => '1200px',
                ),
                'default' => '768'
            ),
        );
        return array(
            'title' => __('Basic Fields', 'drjoseph'),
            'id' => 'illusive-basic',
            'desc' => __('', 'drjoseph'),
            'customizer_width' => '400px',
            'icon' => 'el el-home',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/illusive-basic/fields', $fields),
        );
    }

    function optionFeatures() {
        
        $fields = array(
            array(
                'title' => __('Enable Blog', 'uiu'),                
                'id' => 'illusive_featured_blog',
                'default' => 1,
                'type' => 'checkbox'
            ),
            array(
                'title' => __('Enable Brochure', 'uiu'),                
                'id' => 'illusive_featured_brochure',
                'default' => 1,
                'type' => 'checkbox'
            )
        );
        return array(
            'title' => __('Features', 'drjoseph'),
            'id' => 'illusive-features',
            'desc' => __('', 'drjoseph'),
            'customizer_width' => '400px',
            'icon' => 'el el-home',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/illusive-features/fields', $fields),
        );
    }

    function optionStyles() {
        $fields = array(
            array(
                'id' => 'header_border',
                'type' => 'border',
                'title' => __('Header Border', 'drjoseph'),
                'output' => array('.site-header'),
                'all' => false,
                'default' => array(
                    'border-color' => '#1e73be',
                    'border-style' => 'solid',
                    'border-top' => '0px',
                    'border-right' => '0px',
                    'border-bottom' => '1px',
                    'border-left' => '0px'
                )
            ),
            array(
                'id' => 'body_bg_color',
                'type' => 'color',
                'output' => array('body'),
                'title' => __('Body Background color', 'drjoseph'),
                'default' => '#ffffff',
                'mode' => 'background',
            ),
            array(
                'id' => 'header_bg_color',
                'type' => 'color_rgba',
                'title' => __('Header Background', 'drjoseph'),
                'default' => array(
                    'color' => '#000000',
                    'alpha' => '.8'
                ),
                'output' => array('.site-header'),
                'mode' => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id' => 'menu_bg_color',
                'type' => 'color',
                'title' => __('Primary Menu Background', 'drjoseph'),
                'default' => '#ffff',
                'output' => array('#navbar-primary .navbar-nav'),
                'mode' => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id' => 'menu_item_color',
                'type' => 'link_color',
                'title' => __('Menu Links Color', 'drjoseph'),
                'output' => array('#navbar-primary .navbar-nav > .menu-item > a'),
                'active' => false,
                'visited' => false,
                'default' => array(
                    'regular' => '#aaa',
                    'hover' => '#bbb',
                )
            ),
            array(
                'id' => 'menu_item_active_color',
                'type' => 'link_color',
                'title' => __('Menu Active Links Color', 'drjoseph'),
                'output' => array('#navbar-primary .navbar-nav > .current-menu-item > a'),
                'active' => false,
                'visited' => false,
                'default' => array(
                    'regular' => '#aaa',
                    'hover' => '#bbb',
                )
            ),
            array(
                'id' => 'mobile_menu_theme',
                'type' => 'image_select',
                'title' => __('Mobile Menu Theme', 'drjoseph'),
                'options' => Array(
                    'theme-ffffff' => $this->media_url . '/patterns/ffffff.png',
                    'theme-000000' => $this->media_url . '/patterns/000000.png',
                    'theme-333333' => $this->media_url . '/patterns/333333.png',
                    'theme-ff0000' => $this->media_url . '/patterns/ff0000.png',
                    'theme-6cb543' => $this->media_url . '/patterns/6cb543.png',
                ),
                'default' => 'theme-ffffff',
            ),
        );
        return array(
            'title' => __('Styles', 'drjoseph'),
            'id' => 'illusive-style',
            'icon' => 'el el-brush',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/illusive-style/fields', $fields),
        );
    }

    function optionTypography() {
        $fields = array(
        );
        return array(
            'title' => __('Typography', 'drjoseph'),
            'id' => 'illusive-typography',
            'icon' => 'el el-font',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/illusive-typography/fields', $fields),
                //'subsection' => TRUE,
        );
    }

    function optionSlider() {
        $fields = array(
            array(
                'id' => 'home_slider',
                'type' => 'select',
                'title' => __('Home Page Slider', 'drjoseph'),
                'options' => array(
                    'revslider' => 'Revolution Sliders',
                    'theme-camera' => 'Theme Default Slider(camera)',
                    'theme-parallax' => 'Theme Parallax Slider',
                ),
                'default' => 'revslider'
            ),
            array(
                'id' => 'home_slider_shortcode',
                'type' => 'text',
                'title' => __('Slider Shortcode', 'drjoseph'),
                'default' => '[rev_slider home-page]',
                'required' => array('home_slider', '=', array('revslider')),
            ),
            array(
                'id' => 'home_slider_layout',
                'type' => 'switch',
                'title' => __('Slider Type', 'drjoseph'),
                'default' => 1,
                'on' => 'Content Width',
                'off' => 'Full Width',
            ),
            array(
                'id' => 'theme_slides',
                'type' => 'slides',
                'title' => __('Slides', 'drjoseph'),
                'required' => array('home_slider', '=', 'theme-camera'),
                'placeholder' => array(
                    'title' => __('This is a title', 'redux-framework-demo'),
                    'description' => __('Description Here', 'redux-framework-demo'),
                    'url' => __('Give us a link!', 'redux-framework-demo'),
                ),
            ),
            array(
                'id' => 'theme_slides_height',
                'type' => 'text',
                'title' => __('Slider Height', 'drjoseph'),
                'default' => '30%',
                'required' => array('home_slider', '=', 'theme-camera'),
            ),
            array(
                'id' => 'theme_slides_colors',
                'type' => 'color',
                'title' => __('Color Theme', 'drjoseph'),
                'default' => '#333',
                'required' => array('home_slider', '=', 'theme-camera'),
            ),
            array(
                'id' => 'theme_parallax_slides',
                'type' => 'slides',
                'title' => __('Slides', 'drjoseph'),
                'required' => array('home_slider', '=', 'theme-parallax'),
                'placeholder' => array(
                    'title' => __('This is a title', 'redux-framework-demo'),
                    'description' => __('Description Here', 'redux-framework-demo'),
                    'url' => __('Give us a link!', 'redux-framework-demo'),
                ),
            ),
        );
        return array(
            'title' => __('Slider', 'drjoseph'),
            'id' => 'illusive-slider',
            'icon' => 'el el-picture',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/illusive-slider/fields', $fields),
                //'subsection' => TRUE,
        );
    }

    function optionHome() {
        $fields = array(
            array(
                'title' => __('1st Content Title', 'drjoseph'),
                'id' => 'title1',
                'type' => 'text'
            ),
            array(
                'title' => __('2nd Content Title', 'drjoseph'),
                'id' => 'title2',
                'type' => 'text'
            ),
            array(
                'title' => __('3rd Content Title', 'drjoseph'),
                'id' => 'title3',
                'type' => 'text'
            ),
            array(
                'title' => __('4th Content Title', 'drjoseph'),
                'id' => 'title4',
                'type' => 'text'
            )
        );
        return array(
            'title' => __('Home Content Title', 'drjoseph'),
            'id' => 'illusive-home_title',
            'icon' => 'el el-home-alt',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/illusive-home_title/fields', $fields),
                //'subsection' => TRUE,
        );
    }

    function optionFooter() {
        $fields = array(
            array(
                'id' => 'show_footer_nav',
                'type' => 'switch',
                'title' => __('Show Footer Navigation', 'drjoseph'),
                'default' => true,
            ),
            array(
                'id' => 'site_copyright',
                'type' => 'editor',
                'title' => __('Copyright', 'drjoseph'),
                'default' => '&copy; ' . date('Y') . ' <a href="' . get_bloginfo('site_url') . '">' . get_bloginfo('name') . '</a>',
            ),
        );
        return array(
            'title' => __('Footer', 'drjoseph'),
            'id' => 'illusive-footer',
            'icon' => 'el el-adjust',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/illusive-footer/fields', $fields),
                //'subsection' => TRUE,
        );
    }

    function optionSocial() {
        $fields = array(
            array(
                'title' => __('Facebook', 'drjoseph'),
                'id' => 'social_facebook',
                'type' => 'text'
            ),
            array(
                'title' => __('Twitter', 'drjoseph'),
                'id' => 'social_twitter',
                'type' => 'text'
            ),
            array(
                'title' => __('Google+', 'drjoseph'),
                'id' => 'social_google-plus',
                'type' => 'text'
            ),
            array(
                'title' => __('Youtube', 'drjoseph'),
                'id' => 'social_youtube',
                'type' => 'text'
            ),
            array(
                'title' => __('LinkedIn', 'drjoseph'),
                'id' => 'social_linkedin',
                'type' => 'text'
            ),
            array(
                'title' => __('Pinterest', 'drjoseph'),
                'id' => 'social_pinterest',
                'type' => 'text'
            ),
            array(
                'title' => __('RSS Feed', 'drjoseph'),
                'id' => 'social_rss',
                'type' => 'text'
            ),
            array(
                'title' => __('Tumblr', 'drjoseph'),
                'id' => 'social_tumblr',
                'type' => 'text'
            ),
            array(
                'title' => __('Flickr', 'drjoseph'),
                'id' => 'social_flickr',
                'type' => 'text'
            ),
            array(
                'title' => __('Instagram', 'drjoseph'),
                'id' => 'social_instagram',
                'type' => 'text'
            ),
            array(
                'title' => __('Dribbble', 'drjoseph'),
                'id' => 'social_dribbble',
                'type' => 'text'
            ),
            array(
                'title' => __('Skype', 'drjoseph'),
                'id' => 'social_skype',
                'type' => 'text'
            ),
            array(
                'title' => __('Github', 'drjoseph'),
                'id' => 'social_github',
                'type' => 'text'
            ),
            array(
                'title' => __('Slideshare', 'drjoseph'),
                'id' => 'social_slideshare',
                'type' => 'text'
            ),
            array(
                'title' => __('VK.com', 'drjoseph'),
                'id' => 'social_vk',
                'type' => 'text'
            ),
        );
        return array(
            'title' => __('Social', 'drjoseph'),
            'id' => 'illusive-social',
            'icon' => 'el el-star',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/illusive-social/fields', $fields),
                //'subsection' => TRUE,
        );
    }

    public function addExtensions($ReduxFramework) {
        $path = dirname(__FILE__) . '/extensions/';
        $folders = scandir($path, 1);
        foreach ($folders as $folder) {
            if ($folder === '.' or $folder === '..' or ! is_dir($path . $folder)) {
                continue;
            }
            $extension_class = 'ReduxFramework_Extension_' . $folder;
            if (!class_exists($extension_class)) {
                // In case you wanted override your override, hah.
                $class_file = $path . $folder . '/extension_' . $folder . '.php';
                $class_file = apply_filters('redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file);
                if ($class_file) {
                    require_once( $class_file );
                }
            }
            if (!isset($ReduxFramework->extensions[$folder])) {
                $ReduxFramework->extensions[$folder] = new $extension_class($ReduxFramework);
            }
        }
    }

    public function scripts() {
        //wp_enqueue_style();
    }

}

$theme_options = new DrjosephOptionConfig();
$theme_options->init();
