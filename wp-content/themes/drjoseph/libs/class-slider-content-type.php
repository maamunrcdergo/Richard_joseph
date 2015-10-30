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
      'has_archive' => false,
      'hierarchical' => false,
      'menu_position' => null,
      'exclude_from_search' => TRUE,
      'show_in_nav_menus' => FALSE,
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
        'title' => 'Slide Links',
        'fields' => array(
          array(
            'key' => 'slide_link_text',
            'label' => 'Link Text',
            'name' => 'link_text',
            'type' => 'text',
            'default_value' => 'Learn more',
            'placeholder' => 'Learn more',
            'prepend' => '',
            'append' => '',
            'formatting' => 'html',
            'maxlength' => '',
          ),
          array(
            'key' => 'slide_link_link',
            'label' => 'Link Url',
            'name' => 'link_url',
            'type' => 'text',
            'default_value' => '#',
            'placeholder' => 'http:\\',
            'prepend' => '',
            'append' => '',
            'formatting' => 'html',
            'maxlength' => '',
          ),
          array(
            'key' => 'slide_order',
            'label' => 'Custom Order',
            'name' => 'custom_order',
            'type' => 'number',
            'default_value' => '1',            
            'prepend' => '',
            'append' => '',            
            'maxlength' => '',
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

new Sliders_Content_Type();

function get_drjosefh_slides($args=array()){
  $defaults = array(
    'post_type'=>'drjosefh_slider',
    'orderby' => 'meta_value_num',
    'order'   => 'ASC',
    'meta_key'  => 'custom_order',
    'posts_per_page' => 8,
    );
  $args = wp_parse_args( $args, $defaults );
  $slides_query = get_posts($args);
  $slides_data = array();
  if(!empty($slides_query)){
    foreach($slides_query as $key=>$slide){
      $sdata = new stdClass();
      $sdata->title = $slide->post_title;
      $sdata->content = $slide->post_excerpt;
      $sdata->link_text = get_field('link_text', $slide->ID);
      $sdata->link_url = get_field('link_url', $slide->ID);
      $attchment = get_post_thumbnail_id($slide->ID, 'full');
      $sdata->img = wp_get_attachment_url( $attchment );      
      $slides_data[$key]= $sdata;
    }
  }
return $slides_data;
}