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
class Sliders_Content_Type {

  private $post_type = 'drjosefh_slider';
  private $slug = 'slider';
  private $lan = 'drjosefh';

  function __construct() {
    add_action('init', array($this, 'register'));    
    $this->metabox();
  }

  public function register() {
    $service_labels = array(
      'name' => _x('Slider', 'post type general name', $this->lan),
      'singular_name' => _x('Slide', 'post type singular name', $this->lan),
      'menu_name' => _x('Slides', 'admin menu', $this->lan),
      'name_admin_bar' => _x('Slider', 'add new on admin bar', $this->lan),
      'add_new' => _x('Add New', 'Slide', $this->lan),
      'add_new_item' => __('Add New Slide', $this->lan),
      'new_item' => __('New Slide', $this->lan),
      'edit_item' => __('Edit Slide', $this->lan),
      'view_item' => __('View Slide', $this->lan),
      'all_items' => __('All Slides', $this->lan),
      'search_items' => __('Search Slides', $this->lan),
      'parent_item_colon' => __('Parent Slides:', $this->lan),
      'not_found' => __('No slides found.', $this->lan),
      'not_found_in_trash' => __('No slides found in Trash.', $this->lan)
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
      'supports' => array('title','thumbnail', 'excerpt'),
      'menu_icon'=> DRJOSEPH_THEME_URL.'/images/icon-slider.png'
    );
    register_post_type($this->post_type, $service_arg);
  }

  public function shortcodes($attrs, $content) {
    
  }

  function metabox() {
    if (function_exists("register_field_group")) {
      register_field_group(array(
        'id' => 'acf_sliders_metabox',
        'title' => 'Service Fields',
        'fields' => array(
          array(
            'key' => '',
            'label' => 'test',
            'name' => 'test',
            'type' => 'text',
            'default_value' => 'test',
            'placeholder' => 'test',
            'prepend' => '',
            'append' => '',
            'formatting' => 'html',
            'maxlength' => '',
          ),
        ),
        'location' => array(
          array(
            array(
              'param' => 'post_type',
              'operator' => '==',
              'value' => 'drjosefh_service',
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

new Sliders_Content_Type();
