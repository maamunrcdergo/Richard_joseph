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

  private $post_type = 'drjosefh_service';
  private $slug = 'service';
  private $lan = 'drjosefh';

  function __construct() {
    add_action('init', array($this, 'register'));
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
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
    );
    register_post_type($this->post_type, $service_arg);
  }

  public function shortcodes($attrs, $content) {
    
  }

  function metabox() {
    if (function_exists('acf_add_local_field_group')):
      acf_add_local_field_group(array(
        'key' => 'group_1',
        'title' => 'My Group',
        'fields' => array(
          array(
            'key' => 'field_1',
            'label' => 'Sub Title',
            'name' => 'sub_title',
            'type' => 'text',
            'prefix' => '',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
            'readonly' => 0,
            'disabled' => 0,
          )
        ),
        'location' => array(
          array(
            array(
              'param' => 'post_type',
              'operator' => '==',
              'value' => $this->post_type,
            ),
          ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
      ));

    endif;
  }

}
new Service_Content_Type();