<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
add_action('init', 'acpt_featuredlink_init');
function acpt_featuredlink_init(){
    $args_featuredlink = array(
        'supports' => array('title','thumbnail'),
        'hierarchical' => true,
    );
    $product = acpt_post_type('featuredlink', 'featuredlinks', false, $args_featuredlink)->icon('person');
      $featuredlink_Admin = new Custom_Post_Type_Admin('featuredlink');
}