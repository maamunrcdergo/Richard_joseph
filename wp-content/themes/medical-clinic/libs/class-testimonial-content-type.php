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
class Testimonials_Content_Type {

  private $post_type = 'mclinic_testimonial';
  private $slug = 'testimonial';
  private $lan = 'mclinic';

  function __construct() {
    add_action('init', array($this, 'register'));
    $this->metabox();
  }

  public function register() {
    $service_labels = array(
      'name' => _x('Testimonial', 'post type general name', $this->lan),
      'singular_name' => _x('Testimonial', 'post type singular name', $this->lan),
      'menu_name' => _x('Testimonials', 'admin menu', $this->lan),
      'name_admin_bar' => _x('Testimonial', 'add new on admin bar', $this->lan),
      'add_new' => _x('Add New', 'Testimonial', $this->lan),
      'add_new_item' => __('Add New Testimonial', $this->lan),
      'new_item' => __('New Testimonial', $this->lan),
      'edit_item' => __('Edit Testimonial', $this->lan),
      'view_item' => __('View Testimonial', $this->lan),
      'all_items' => __('All Testimonials', $this->lan),
      'search_items' => __('Search Testimonials', $this->lan),
      'parent_item_colon' => __('Parent Testimonials:', $this->lan),
      'not_found' => __('No testimonials found.', $this->lan),
      'not_found_in_trash' => __('No testimonials found in Trash.', $this->lan)
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
      'has_archive' => false,
      'hierarchical' => false,
      'menu_position' => null,
      'exclude_from_search' => TRUE,
      'show_in_nav_menus' => FALSE,
      'supports' => array('title', 'thumbnail', 'editor'),
      'menu_icon' => MCLINIC_THEME_URL . '/images/icon-testimonial.png'
    );
    register_post_type($this->post_type, $service_arg);
  }

  public function shortcodes($attrs, $content) {
    
  }

  function metabox() {
    if (function_exists("register_field_group")) {
      register_field_group(array(
        'id' => 'acf_testimonials_metabox',
        'title' => 'Testimonial Author',
        'fields' => array(
          array(
            'key' => 'testimonial_designation',
            'label' => 'Designation',
            'name' => 'designation',
            'type' => 'text',
            'default_value' => 'Secretary',            
            'formatting' => 'none',           
          ),
          array(
            'key' => 'testimonial_order',
            'label' => 'Custom Order',
            'name' => 'custom_order',
            'type' => 'number',
            'default_value' => '1',           
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

new Testimonials_Content_Type();

function get_mclinic_testimonials($args = array()) {
  $defaults = array(
    'post_type' => 'mclinic_testimonial',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_key' => 'custom_order',
    'posts_per_page' => -1,
  );
  $args = wp_parse_args($args, $defaults);
  $testimonials_query = get_posts($args);
  $testimonials_data = array();
  if (!empty($testimonials_query)) {
    foreach ($testimonials_query as $key => $testimonial) {
      $sdata = new stdClass();
      $sdata->author = $testimonial->post_title;
      $sdata->content = $testimonial->post_content;
      $sdata->designation = get_field('designation', $testimonial->ID);    
      $attchment = get_post_thumbnail_id($testimonial->ID, 'full');
      $sdata->img = wp_get_attachment_url($attchment);
      $testimonials_data[$key] = $sdata;
    }
  }
  return $testimonials_data;
}
