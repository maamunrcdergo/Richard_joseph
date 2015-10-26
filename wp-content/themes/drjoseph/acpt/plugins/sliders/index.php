<?php
add_action('init', 'acpt_sliders_init');
function acpt_sliders_init(){
    $args_sliders = array(
        'supports' => array('title', 'editor', 'thumbnail'),
        'hierarchical' => TRUE,
        'exclude_from_search'=>FALSE,
    );
    $product = acpt_post_type('slider', 'sliders', FALSE, $args_sliders)->icon('box');
    
    $product_Admin = new Custom_Post_Type_Admin('slider');
    
}