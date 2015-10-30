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
class Doctors_Content_Type {

  private $post_type = 'drjosefh_doctor';
  private $slug = 'doctor';
  private $lan = 'drjosefh';

  function __construct() {
    add_action('init', array($this, 'register'));
    $this->metabox();
  }

  public function register() {
    $doctors_labels = array(
      'name' => _x('Doctor', 'post type general name', $this->lan),
      'singular_name' => _x('Doctor', 'post type singular name', $this->lan),
      'menu_name' => _x('Doctors', 'admin menu', $this->lan),
      'name_admin_bar' => _x('Doctor', 'add new on admin bar', $this->lan),
      'add_new' => _x('Add New', 'Doctor', $this->lan),
      'add_new_item' => __('Add New Doctor', $this->lan),
      'new_item' => __('New Doctor', $this->lan),
      'edit_item' => __('Edit Doctor', $this->lan),
      'view_item' => __('View Doctor', $this->lan),
      'all_items' => __('All Doctors', $this->lan),
      'search_items' => __('Search Doctors', $this->lan),
      'parent_item_colon' => __('Parent Doctors:', $this->lan),
      'not_found' => __('No doctors found.', $this->lan),
      'not_found_in_trash' => __('No doctors found in Trash.', $this->lan)
    );
    $doctors_arg = array(
      'labels' => $doctors_labels,
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
      'supports' => array('title', 'thumbnail', 'excerpt','editor',),
      'menu_icon' => DRJOSEPH_THEME_URL . '/images/icon-doctor.png'
    );
    register_post_type($this->post_type, $doctors_arg);
  }

  public function shortcodes($attrs, $content) {
    
  }

  function metabox() {
    if (function_exists("register_field_group")) {
      register_field_group(array(
        'id' => 'acf_doctors_metabox',
        'title' => 'Profile Informations',
        'fields' => array(
          array(
            'key' => 'doctor_field_tab_qualification',
            'label' => 'Qualification',
            'name' => '',
            'type' => 'tab',
          ),
          array(
            'key' => 'doctor_degree',
            'label' => 'Degree',
            'name' => 'degree',
            'type' => 'text',
            'default_value' => 'M.B.B.S / F.C.P.S',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'formatting' => 'html',
            'maxlength' => '',
          ),
          array(
            'key' => 'doctor_speciality',
            'label' => 'Speciality',
            'name' => 'speciality',
            'type' => 'text',
            'default_value' => 'Surgery/Medicine',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'formatting' => 'html',
            'maxlength' => '',
          ),
          array(
            'key' => 'doctor_order',
            'label' => 'Order or Rank',
            'name' => 'custom_order',
            'type' => 'number',
            'default_value' => '1',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
          ),
          array(
            'key' => 'doctor_field_tab_socializing',
            'label' => 'Socializing',
            'name' => '',
            'type' => 'tab',
          ),
          array(
            'key' => 'doctor_socializing_facebook',
            'label' => 'Facebook',
            'name' => 'facebook',
            'type' => 'text',
            'default_value' => '',
            'placeholder' => 'https://www.facebook.com/{profile-name}',
            'prepend' => '',
            'append' => '',
            'formatting' => 'none',
            'maxlength' => '',
          ),
          array(
            'key' => 'doctor_socializing_twitter',
            'label' => 'Twitter',
            'name' => 'twitter',
            'type' => 'text',
            'default_value' => '',
            'placeholder' => 'https://twitter.com//{profile-name}',
            'prepend' => '',
            'append' => '',
            'formatting' => 'none',
            'maxlength' => '',
          ),
          array(
            'key' => 'doctor_socializing_plus_google',
            'label' => 'Google Plus',
            'name' => 'googleplus',
            'type' => 'text',
            'default_value' => '',
            'placeholder' => 'https://plus.google.com/{profile-name}',
            'prepend' => '',
            'append' => '',
            'formatting' => 'none',
            'maxlength' => '',
          ),
          array(
            'key' => 'doctor_socializing_linkedin',
            'label' => 'Linkedin',
            'name' => 'linkedin',
            'type' => 'text',
            'default_value' => '',
            'placeholder' => 'https://www.linkedin.com/{profile-name}',
            'prepend' => '',
            'append' => '',
            'formatting' => 'none',
            'maxlength' => '',
          ),
          array(
            'key' => 'doctor_socializing_skype',
            'label' => 'Skype',
            'name' => 'skype',
            'type' => 'text',
            'default_value' => '',
            'placeholder' => 'skype user name',
            'prepend' => '',
            'append' => '',
            'formatting' => 'none',
            'maxlength' => '',
          ),
          array(
            'key' => 'doctor_socializing_email',
            'label' => 'Email Address',
            'name' => 'email',
            'type' => 'email',
            'default_value' => '',
            'placeholder' => 'email address',
            'prepend' => '',
            'append' => '',
            'formatting' => 'none',
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

new Doctors_Content_Type();

function get_drjosefh_doctors($args = array()) {
  $defaults = array(
    'post_type' => 'drjosefh_doctor',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_key' => 'custom_order',
    'posts_per_page' => -1,
  );
  $args = wp_parse_args($args, $defaults);
  $doctors_query = get_posts($args);
  $doctors_data = array();
  if (!empty($doctors_query)) {
    foreach ($doctors_query as $key => $doctor) {
      $sdata = new stdClass();
      $sdata->name = $doctor->post_title;
      $sdata->short_bio = $doctor->post_excerpt;
      $sdata->bio = $doctor->post_content;
      $sdata->link = get_the_permalink($doctor->ID);      
      $attchment = get_post_thumbnail_id($doctor->ID, 'full');
      $sdata->img = wp_get_attachment_url($attchment);
      $sdata->facebook = get_field('facebook', $doctor->ID);
      $sdata->twitter = get_field('twitter', $doctor->ID);
      $sdata->googleplus = get_field('googleplus', $doctor->ID);
      $sdata->linkedin = get_field('linkedin', $doctor->ID);
      $sdata->skype = get_field('skype', $doctor->ID);
      $sdata->email = get_field('email', $doctor->ID);
      $doctors_data[$key] = $sdata;
    }
  }
  return $doctors_data;
}
