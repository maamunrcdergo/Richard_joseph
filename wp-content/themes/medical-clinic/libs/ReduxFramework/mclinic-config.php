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

  var $opt_name = "mclinic_options";
  var $theme;
  var $args;
  var $media_url;

  function __construct() {
    $this->theme = wp_get_theme();
    $this->media_url = MCLINIC_THEME_URL . '/images/';
    $this->opt_name = apply_filters('mclinic_options', $this->opt_name);

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
      'menu_title' => __('Theme Options', 'mclinic'),
      'page_title' => __('Theme Options', 'mclinic'),
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
      }
      else {
        $v = str_replace('-', '_', $this->args['opt_name']);
      }
      $this->args['intro_text'] = sprintf(__('<p>To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'mclinic'), $v);
    }
    else {
      $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'mclinic');
    }

    // Add content after the form.
    $this->args['footer_text'] = __("<p>&copy;2015 Modified by <a href=\"{$this->theme->ThemeURI}\">{$this->theme->Author}</a></p>", 'mclinic');
  }

  public function addSections() {
    $sections[] = $this->optionBasic();
    $sections[] = $this->frontPage();
    //$sections[] = $this->optionStyles();
    // $sections[] = $this->optionTypography();
    // $sections[] = $this->optionSlider();
    $sections[] = $this->optionInnerContent();
    $sections[] = $this->optionFooter();
    $sections[] = $this->optionSocial();

    return apply_filters('add_illusive_theme_option', $sections);
  }

  function optionBasic() {
    $fields = array(
      array(
        'id' => 'show_logo',
        'type' => 'switch',
        'title' => __('Show Logo', 'mclinic'),
        'subtitle' => __('Others showing site title.', 'mclinic'),
        'default' => true,
      ),
      array(
        'id' => 'logo_url',
        'type' => 'media',
        'url' => true,
        'title' => __('Logo', 'mclinic'),
        'compiler' => 'true',
        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
        'desc' => __('Basic media uploader with disabled URL input field.', 'mclinic'),
        'default' => array('url' => $this->media_url . 'default-logo.png'),
        'required' => array('show_logo', '=', '1'),
      ),
      array(
        'id' => 'show_logo_sx',
        'type' => 'switch',
        'title' => __('Enable Mobile Logo', 'mclinic'),
        'subtitle' => __('In small device  show a alternative Logo', 'mclinic'),
        'default' => true,
      ),
      array(
        'id' => 'logo_url_sx',
        'type' => 'media',
        'url' => true,
        'title' => __('Logo', 'mclinic'),
        'compiler' => 'true',
        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
        'desc' => __('Basic media uploader with disabled URL input field.', 'mclinic'),
        'default' => array('url' => $this->media_url . 'default-logo-sx.png'),
        'required' => array('show_logo_sx', '=', '1'),
      ),
      array(
        'id' => 'mobile_menu_theme',
        'type' => 'image_select',
        'title' => __('Mobile Menu Theme', 'mclinic'),
        'options' => Array(
          'theme-ffffff' => $this->media_url . '/patterns/ffffff.png',
          'theme-000000' => $this->media_url . '/patterns/000000.png',
          'theme-333333' => $this->media_url . '/patterns/333333.png',
          'theme-ff0000' => $this->media_url . '/patterns/ff0000.png',
          'theme-6cb543' => $this->media_url . '/patterns/6cb543.png',
          'theme-193874' => $this->media_url . '/patterns/193874.png',
        ),
        'default' => 'theme-ffffff',
      ),
      array(
        'id' => 'show_tagline',
        'type' => 'switch',
        'title' => __('Show Tagline', 'mclinic'),
        'default' => FALSE,
      ),
      array(
        'id' => 'custom_favicon',
        'type' => 'media',
        'url' => true,
        'title' => __('Custom Favicon Icon', 'mclinic'),
        'default' => array('url' => $this->media_url . 'favicon.ico'),
        'preview' => false,
      ),
      array(
        'id' => 'apple_touch_icon',
        'type' => 'media',
        'url' => true,
        'title' => __('Apple touch icon', 'mclinic'),
        'compiler' => 'true',
        'desc' => __('Upload image 180X180 px', 'mclinic'),
        'default' => array('url' => $this->media_url . 'default-apple-icon.png'),
      ),
    );
    return array(
      'title' => __('Basic Fields', 'mclinic'),
      'id' => 'theme-optionbasic',
      'desc' => __('', 'mclinic'),
      'customizer_width' => '400px',
      'icon' => 'el el-dashboard',
      'fields' => apply_filters('redux/' . $this->opt_name . '/sections/basic/fields', $fields),
    );
  }

  function frontPage() {
    $fields = array(
      array(
        'id' => 'section-slider',
        'type' => 'section',
        'title' => __('Slider', 'mclinic'),
        'indent' => true, // Indent all options below until the next 'section' option is set.
      ),
      array(
        'id' => 'slide_count',
        'type' => 'text',
        'title' => __('Number of slide to show', 'mclinic'),
        'validate' => 'numeric',
        'default' => '3',
      ),
      array(
        'id' => 'slide_interval',
        'type' => 'text',
        'title' => __('Slide Interval', 'mclinic'),
        'validate' => 'numeric',
        'default' => '2000',
      ),
      array(
        'id' => 'section-services',
        'type' => 'section',
        'title' => __('Services', 'mclinic'),
        'indent' => true,
      ),
      array(
        'id' => 'service_sec_title',
        'type' => 'text',
        'title' => __('Secton/Block Title', 'mclinic'),
        'default' => 'Services',
      ),
      array(
        'id' => 'home_services',
        'type' => 'select',
        'data' => 'post',
        'args' => array('post_type' => 'mclinic_service', 'posts_per_page' => -1),
        'multi' => true,
        'title' => __('Select Services', 'mclinic'),
        'desc' => __('You can select multiple service to show only front page', 'mclinic'),
      ),
      array(
        'id' => 'service_page_id',
        'type' => 'select',
        'data' => 'page',
        'multi' => FALSE,
        'title' => __('Select Services List Page', 'mclinic'),
        'desc' => __('Link page to show all services', 'mclinic'),
      ),
      array(
        'id' => 'section-doctors',
        'type' => 'section',
        'title' => __('Doctor List', 'mclinic'),
        'indent' => true,
      ),
      array(
        'id' => 'doctors_sec_title',
        'type' => 'text',
        'title' => __('Secton/Block Title', 'mclinic'),
        'default' => 'Meet our doctors',
      ),
      array(
        'id' => 'doctors_sec_srtdesc',
        'type' => 'textarea',
        'title' => __('Secton/Block Short Description', 'mclinic'),
        'default' => 'Meet our doctors',
        'validate' => 'no_html',
      ),
      array(
        'id' => 'home_doctors',
        'type' => 'select',
        'data' => 'post',
        'args' => array('post_type' => 'mclinic_doctor', 'posts_per_page' => -1),
        'multi' => true,
        'title' => __('Select Doctors', 'mclinic'),
        'desc' => __('You can select multiple doctor to show only front page', 'mclinic'),
      ),
      array(
        'id' => 'doctors_page_id',
        'type' => 'select',
        'data' => 'page',
        'multi' => FALSE,
        'title' => __('Select Doctors List Page', 'mclinic'),
        'desc' => __('Link page to show all Doctors', 'mclinic'),
      ),
      array(
        'id' => 'section-products',
        'type' => 'section',
        'title' => __('Products carousel', 'mclinic'),
        'indent' => true,
      ),
      array(
        'id' => 'products_sec_title',
        'type' => 'text',
        'title' => __('Secton/Block Title', 'mclinic'),
        'default' => 'Our Products',
      ),
      array(
        'id' => 'featured_product_count',
        'type' => 'text',
        'title' => __('Number of product to show', 'mclinic'),
        'validate' => 'numeric',
        'default' => '8',
      ),
      array(
        'id' => 'section-testimonial',
        'type' => 'section',
        'title' => __('Testimonial', 'mclinic'),
        'indent' => true,
      ),
      array(
        'id' => 'testimonial_sec_title',
        'type' => 'text',
        'title' => __('Secton/Block Title', 'mclinic'),
        'default' => 'Testimonial',
      ),
      array(
        'id' => 'testimonial_count',
        'type' => 'text',
        'title' => __('Number of testimonial to show', 'mclinic'),
        'validate' => 'numeric',
        'default' => '3',
      ),
    );
    return array(
      'title' => __('Front Page Template', 'mclinic'),
      'id' => 'tpl-front-page',
      'icon' => 'el el-home',
      'fields' => apply_filters('redux/' . $this->opt_name . '/sections/frontpage/fields', $fields),
    );
  }

  function optionFooter() {
    $fields = array(
      array(
        'id' => 'show_footer_nav',
        'type' => 'switch',
        'title' => __('Show Footer Navigation', 'mclinic'),
        'default' => FALSE,
      ),
      array(
        'id' => 'show_footer_widgets',
        'type' => 'switch',
        'title' => __('Show Footer Widgets', 'mclinic'),
        'default' => TRUE,
      ),
      array(
        'id' => 'footer_widgets_count',
        'type' => 'text',
        'title' => __('Number of Footer Column', 'mclinic'),
        'validate' => 'numeric',
        'default' => '3',
      ),
      array(
        'id' => 'site_copyright',
        'type' => 'editor',
        'title' => __('Copyright', 'mclinic'),
        'default' => '&copy; ' . date('Y') . ' <a class="site-copyright" href="' . get_bloginfo('site_url') . '">' . get_bloginfo('name') . '</a> | <a  class="devloped-by" title="Web Design and Development by Illusive Design" target="_BLANK" href="http://www.illusivedesign.ca">Web Design and Development by Illusive Design.</a>',
      ),
    );
    return array(
      'title' => __('Footer', 'mclinic'),
      'id' => 'theme-optionfooter',
      'icon' => 'el el-adjust',
      'fields' => apply_filters('redux/' . $this->opt_name . '/sections/footer/fields', $fields),
        //'subsection' => TRUE,
    );
  }

  function optionSocial() {
    $fields = array(
      array(
        'id' => 'section-contact',
        'type' => 'section',
        'title' => __('Contact Info', 'mclinic'),
        'indent' => true,
      ),
      array(
        'title' => __('Address', 'mclinic'),
        'id' => 'contact_address',
        'type' => 'textarea'
      ),
      array(
        'title' => __('Email', 'mclinic'),
        'id' => 'contact_email',
        'type' => 'text'
      ),
      array(
        'title' => __('Phone', 'mclinic'),
        'id' => 'contact_phone',
        'type' => 'text'
      ),
      array(
        'title' => __('Web Address', 'mclinic'),
        'id' => 'contact_website',
        'type' => 'text'
      ),
      array(
        'id' => 'section-social',
        'type' => 'section',
        'title' => __('Social Links', 'mclinic'),
        'indent' => true,
      ),
      array(
        'title' => __('Widget Inner Text', 'mclinic'),
        'id' => 'social_icons_prefix',
        'type' => 'text'
      ),
      array(
        'title' => __('Facebook', 'mclinic'),
        'id' => 'social_facebook',
        'type' => 'text'
      ),
      array(
        'title' => __('Twitter', 'mclinic'),
        'id' => 'social_twitter',
        'type' => 'text'
      ),
      array(
        'title' => __('Google+', 'mclinic'),
        'id' => 'social_google-plus',
        'type' => 'text'
      ),
      array(
        'title' => __('Youtube', 'mclinic'),
        'id' => 'social_youtube',
        'type' => 'text'
      ),
      array(
        'title' => __('LinkedIn', 'mclinic'),
        'id' => 'social_linkedin',
        'type' => 'text'
      ),
      array(
        'title' => __('Pinterest', 'mclinic'),
        'id' => 'social_pinterest',
        'type' => 'text'
      ),
      array(
        'title' => __('RSS Feed', 'mclinic'),
        'id' => 'social_rss',
        'type' => 'text'
      ),
      array(
        'title' => __('Tumblr', 'mclinic'),
        'id' => 'social_tumblr',
        'type' => 'text'
      ),
      array(
        'title' => __('Flickr', 'mclinic'),
        'id' => 'social_flickr',
        'type' => 'text'
      ),
      array(
        'title' => __('Instagram', 'mclinic'),
        'id' => 'social_instagram',
        'type' => 'text'
      ),
      array(
        'title' => __('Dribbble', 'mclinic'),
        'id' => 'social_dribbble',
        'type' => 'text'
      ),
      array(
        'title' => __('Skype', 'mclinic'),
        'id' => 'social_skype',
        'type' => 'text'
      ),
      array(
        'title' => __('Github', 'mclinic'),
        'id' => 'social_github',
        'type' => 'text'
      ),
      array(
        'title' => __('Slideshare', 'mclinic'),
        'id' => 'social_slideshare',
        'type' => 'text'
      ),
      array(
        'title' => __('VK.com', 'mclinic'),
        'id' => 'social_vk',
        'type' => 'text'
      ),
    );
    return array(
      'title' => __('Social', 'mclinic'),
      'id' => 'theme-optionsocial',
      'icon' => 'el el-star',
      'fields' => apply_filters('redux/' . $this->opt_name . '/sections/social/fields', $fields),
        //'subsection' => TRUE,
    );
  }

  function optionInnerContent() {
    $fields = array(
      array(
        'id' => 'default_page_banner',
        'type' => 'media',
        'url' => true,
        'title' => __('Logo', 'mclinic'),
        'compiler' => 'true',
        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
        'desc' => __('Upload a image with .jpeg with maximum low resolution minimum size 2200X250 px', 'mclinic'),
        'default' => array('url' => $this->media_url . 'default-banner.jpg'),       
      ),  
      array(
        'id' => 'show_subtitle',
        'type' => 'switch',
        'title' => __('Show Subtitle', 'mclinic'),
        'subtitle' => __('Show subtitle below page title', 'mclinic'),
        'default' => true,
      ),
    );
    return array(
      'title' => __('Page Inner', 'mclinic'),
      'id' => 'theme-optioninner-content',
      'icon' => 'el el-th-large',
      'fields' => apply_filters('redux/' . $this->opt_name . '/sections/inner-content/fields', $fields),
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
