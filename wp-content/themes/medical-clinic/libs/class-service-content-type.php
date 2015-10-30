<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class-service-content-type
 *
 * @author Anup Biswas <anup@illusivedesign.net>
 */
class Service_Content_Type {

  private $post_type = 'mclinic_service';
  private $slug = 'services';
  private $lan = 'mclinic';
  private $taxonomy = 'service-catalog';

  function __construct() {
    add_action('init', array($this, 'register'));
    add_action('init', array($this, 'taxonomies'));
    add_shortcode('services', array($this, 'shortcodes'));
    $this->metabox();
  }

  public function register() {
    $service_labels = array(
      'name' => _x('Service', 'post type general name', $this->lan),
      'singular_name' => _x('Service', 'post type singular name', $this->lan),
      'menu_name' => _x('Services', 'admin menu', $this->lan),
      'name_admin_bar' => _x('Service', 'add new on admin bar', $this->lan),
      'add_new' => _x('Add New', 'Service', $this->lan),
      'add_new_item' => __('Add New Service', $this->lan),
      'new_item' => __('New Service', $this->lan),
      'edit_item' => __('Edit Service', $this->lan),
      'view_item' => __('View Service', $this->lan),
      'all_items' => __('All Services', $this->lan),
      'search_items' => __('Search Services', $this->lan),
      'parent_item_colon' => __('Parent Services:', $this->lan),
      'not_found' => __('No services found.', $this->lan),
      'not_found_in_trash' => __('No services found in Trash.', $this->lan)
    );
    $service_arg = array(
      'labels' => $service_labels,
      'description' => __('Description.', $this->lan),
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'query_var' => true,
      'rewrite' => array('slug' => $this->slug),
      'capability_type' => 'post',
      'has_archive' => true,
      'hierarchical' => false,
      'menu_position' => null,
      'show_in_nav_menus' => FALSE,
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
      'menu_icon' => MCLINIC_THEME_URL . '/images/icon-service.png'
    );
    register_post_type($this->post_type, $service_arg);
  }

  public function taxonomies() {
    $labels = array(
      'name' => _x('Service Catalogs', 'taxonomy general name'),
      'singular_name' => _x('Catalog', 'taxonomy singular name'),
      'search_items' => __('Search Catalogs'),
      'all_items' => __('All Catalogs'),
      'parent_item' => __('Parent Catalog'),
      'parent_item_colon' => __('Parent Catalog:'),
      'edit_item' => __('Edit Catalog'),
      'update_item' => __('Update Catalog'),
      'add_new_item' => __('Add New Catalog'),
      'new_item_name' => __('New Catalog Name'),
      'menu_name' => __('Catalog'),
    );

    $args = array(
      'hierarchical' => true,
      'labels' => $labels,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => array('slug' => $this->taxonomy),
    );

    register_taxonomy($this->taxonomy, $this->post_type, $args);
  }

  public function shortcodes($attrs, $content) {
    
  }

  function metabox() {
    if (function_exists("register_field_group")) {
      register_field_group(array(
        'id' => 'acf_service_metabox',
        'title' => 'Service Fields',
        'fields' => array(
          array(
            'key' => 'service_icon',
            'label' => 'Icon Image',
            'name' => 'icon',
            'type' => 'image',
            'save_format' => 'object',
            'preview_size' => 'thumbnail',
            'library' => 'all',
          ),
          array(
            'key' => 'service_custom_order',
            'label' => 'Order',
            'name' => 'custom_order',
            'type' => 'number',
            'default_value' => '1',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => '',
            'max' => '',
            'step' => '',
          ),
        ),
        'location' => array(
          array(
            array(
              'param' => 'post_type',
              'operator' => '==',
              'value' => $this->post_type,
              'order_no' => 0,
              'group_no' => 0,
            ),
          ),
        ),
        'options' => array(
          'position' => 'normal',
          'layout' => 'default',
          'hide_on_screen' => array(
          ),
        ),
        'menu_order' => 0,
      ));
    }
  }

}

new Service_Content_Type();

function get_mclinic_services($args = array()) {
  $defaults = array(
    'post_type' => 'mclinic_service',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_key' => 'custom_order',
    'posts_per_page' => -1,    
  );
  
  $args = wp_parse_args($args, $defaults);

  $services_query = get_posts($args);
  $services_data = array();
  if (!empty($services_query)) {
    foreach ($services_query as $key => $service) {
      $sdata = new stdClass();
      $sdata->title = $service->post_title;
      $sdata->excerpt = $service->post_excerpt;
      $sdata->content = $service->post_content;
      $sdata->url = get_the_permalink($service->ID);
      $icon_att_id = get_field('icon', $service->ID);
      $sdata->icon = wp_get_attachment_url($icon_att_id);
      $attchment = get_post_thumbnail_id($service->ID, 'full');
      $sdata->img = wp_get_attachment_url($attchment);
      $services_data[$key] = $sdata;
    }
  }

  return $services_data;
}
