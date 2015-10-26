<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


add_action('init', 'acpt_products_init');

function acpt_products_init() {
    $args_products = array(
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'hierarchical' => true,
    );
    $product = acpt_post_type('product', 'products', false, $args_products)->icon('ipad');
    acpt_tax('group', 'groups', $product, true, false);
    
     $people_Admin = new Custom_Post_Type_Admin('product',array('group'));
}