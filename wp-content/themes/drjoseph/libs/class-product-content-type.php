<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class-product-content-type
 *
 * @author Anup Biswas <anup@illusivedesign.net>
 */
class Product_Content_Type {

  private $post_type = 'drjosefh_product';
  private $slug = 'product';
  private $lan = 'drjosefh';
  private $taxonomy = 'product-category';

  function __construct() {
    add_action('init', array($this, 'register'));
    add_action('init', array($this, 'taxonomies'));
    add_shortcode('products', array($this, 'shortcodes'));
    $this->metabox();
  }

  public function register() {
    $product_labels = array(
      'name' => _x('Product', 'post type general name', $this->lan),
      'singular_name' => _x('Product', 'post type singular name', $this->lan),
      'menu_name' => _x('Products', 'admin menu', $this->lan),
      'name_admin_bar' => _x('Product', 'add new on admin bar', $this->lan),
      'add_new' => _x('Add New', 'Product', $this->lan),
      'add_new_item' => __('Add New Product', $this->lan),
      'new_item' => __('New Product', $this->lan),
      'edit_item' => __('Edit Product', $this->lan),
      'view_item' => __('View Product', $this->lan),
      'all_items' => __('All Products', $this->lan),
      'search_items' => __('Search Products', $this->lan),
      'parent_item_colon' => __('Parent Products:', $this->lan),
      'not_found' => __('No products found.', $this->lan),
      'not_found_in_trash' => __('No products found in Trash.', $this->lan)
    );
    $product_arg = array(
      'labels' => $product_labels,
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
      'menu_icon' => DRJOSEPH_THEME_URL . '/images/icon-product.png'
    );
    register_post_type($this->post_type, $product_arg);
  }

  public function taxonomies() {
    $labels = array(
      'name' => _x('Product Categories', 'taxonomy general name'),
      'singular_name' => _x('Category', 'taxonomy singular name'),
      'search_items' => __('Search Categories'),
      'all_items' => __('All Categories'),
      'parent_item' => __('Parent Category'),
      'parent_item_colon' => __('Parent Category:'),
      'edit_item' => __('Edit Category'),
      'update_item' => __('Update Category'),
      'add_new_item' => __('Add New Category'),
      'new_item_name' => __('New Category Name'),
      'menu_name' => __('Categories'),
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
        'id' => 'acf_product_metabox',
        'title' => 'Product Attribute or Additional Info',
        'fields' => array(
          array(
            'key' => 'product_attr_name',
            'label' => 'Name',
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'General Name',
            'formatting' => 'none',
            'required' => '1',
          ),
          array(
            'key' => 'product_attr_price',
            'label' => 'Price',
            'name' => 'price',
            'type' => 'text',
            'default_value' => 'Contact clinic',
            'formatting' => 'none',
          ),
          array(
            'key' => 'product_custom_order',
            'label' => 'Order',
            'name' => 'custom_order',
            'type' => 'number',
            'default_value' => '1',
            'size' => 100,
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

new Product_Content_Type();

function get_drjosefh_products($args = array()) {
  $defaults = array(
    'post_type' => 'drjosefh_product',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_key' => 'custom_order',
    'posts_per_page' => -1,
  );
  if (!empty($args['cat'])) {
    $categories = explode(',', $args['cat']);
    $defaults['tax_query'] = array(
      array(
        'taxonomy' => 'product-category',
        'field' => 'slug',
        'terms' => $categories,
      ),
    );
  }
  $args = wp_parse_args($args, $defaults);

  $products_query = get_posts($args);
  $products_data = array();
  if (!empty($products_query)) {
    foreach ($products_query as $key => $product) {
      $sdata = new stdClass();
      $sdata->title = $product->post_title;
      $sdata->excerpt = $product->post_excerpt;
      $sdata->content = $product->post_content;
      $sdata->url = get_the_permalink($product->ID);
      $sdata->name = get_field('name', $product->ID);
      $sdata->price = get_field('price', $product->ID);

      $attchment = get_post_thumbnail_id($product->ID, 'full');
      $sdata->img = wp_get_attachment_url($attchment);
      $products_data[$key] = $sdata;
    }
  }
  return $products_data;
}
