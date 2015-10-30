<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
add_action('wp_head', 'theme_custom_favicon');
add_action('wp_head', 'theme_apple_touch_icon');
add_action('wp_head', 'theme_humans_txt');
/*
 * add custom  favicon
 */

function theme_custom_favicon() {
  global $mclinic_options;
  if (!empty($mclinic_options['custom_favicon'])) {
    printf('<link rel="shortcut icon" href="%s" type="image/x-icon">', $mclinic_options['custom_favicon']['url']);
    printf('<link rel="icon" href="%s" type="image/x-icon">', $mclinic_options['custom_favicon']['url']);
  }
}

function theme_apple_touch_icon() {
  global $mclinic_options;
  if (!empty($mclinic_options['apple_touch_icon'])) {
    printf('<link rel="apple-touch-icon" href="%s">', $mclinic_options['custom_favicon']['url']);
  }
}

function theme_humans_txt() {
  global $mclinic_options;
  if (!empty($mclinic_options['humans_txt'])) {
    $link = MCLINIC_THEME_URL . '/humans.txt';
    echo "<link rel='author' href='{$link}' />";
  }
}

function theme_primary_menu() {
  wp_nav_menu(array(
    'theme_location' => 'main-menu',
    'container' => 'div',
    'container_class' => 'collapse navbar-collapse menu pull-right',
    'container_id' => 'main_menu',
    'menu_class' => 'nav navbar-nav',
    'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
    'depth' => 4,
    'walker' => new wp_bootstrap_navwalker()
  ));
}
function theme_page_title( $display = true) {
	global $wp_locale, $page, $paged;

	$m = get_query_var('m');
	$year = get_query_var('year');
	$monthnum = get_query_var('monthnum');
	$day = get_query_var('day');
	$search = get_query_var('s');
	$title = '';

	$t_sep = '%WP_TITILE_SEP%'; // Temporary separator, for accurate flipping, if necessary

	// If there is a post
	if ( is_single() || ( is_home() && !is_front_page() ) || ( is_page() && !is_front_page() ) ) {
		$title = single_post_title( '', false );
	}

	// If there's a post type archive
	if ( is_post_type_archive() ) {
		$post_type = get_query_var( 'post_type' );
		if ( is_array( $post_type ) )
			$post_type = reset( $post_type );
		$post_type_object = get_post_type_object( $post_type );
		if ( ! $post_type_object->has_archive )
			$title = post_type_archive_title( '', false );
	}

	// If there's a category or tag
	if ( is_category() || is_tag() ) {
		$title = single_term_title( '', false );
	}

	// If there's a taxonomy
	if ( is_tax() ) {
		$term = get_queried_object();
		if ( $term ) {
			$tax = get_taxonomy( $term->taxonomy );
			$title = single_term_title( $tax->labels->name . $t_sep, false );
		}
	}

	// If there's an author
	if ( is_author() && ! is_post_type_archive() ) {
		$author = get_queried_object();
		if ( $author )
			$title = $author->display_name;
	}

	// Post type archives with has_archive should override terms.
	if ( is_post_type_archive() && $post_type_object->has_archive )
		$title = post_type_archive_title( '', false );

	// If there's a month
	if ( is_archive() && !empty($m) ) {
		$my_year = substr($m, 0, 4);
		$my_month = $wp_locale->get_month(substr($m, 4, 2));
		$my_day = intval(substr($m, 6, 2));
		$title = $my_year . ( $my_month ? $t_sep . $my_month : '' ) . ( $my_day ? $t_sep . $my_day : '' );
	}

	// If there's a year
	if ( is_archive() && !empty($year) ) {
		$title = $year;
		if ( !empty($monthnum) )
			$title .= $t_sep . $wp_locale->get_month($monthnum);
		if ( !empty($day) )
			$title .= $t_sep . zeroise($day, 2);
	}

	// If it's a search
	if ( is_search() ) {
		/* translators: 1: separator, 2: search phrase */
		$title = sprintf(__('Search Results %1$s %2$s'), $t_sep, strip_tags($search));
	}

	// If it's a 404 page
	if ( is_404() ) {
		$title = __('Page not found');
	}
	
	// Send it out
	if ( $display )
		echo $title;
	else
		return $title;

}
function theme_page_subtitle($display = true){
global $wp_locale, $page, $paged;
  	$subtitle = get_option('blogname');
  
// If there is a post
	if ( is_page() ) {
    $page_id = get_the_ID();
		$subtitle = get_field( 'page_sub_title',$page_id);
	}
  if(is_single()){
    $post_type = get_query_var( 'post_type' );
    $post_typeobj = get_post_type_object( $post_type );
    $subtitle = $post_typeobj->labels->name;       
  } 
// Send it out
	if ( $display )
		echo $subtitle;
	else
		return $subtitle;
}