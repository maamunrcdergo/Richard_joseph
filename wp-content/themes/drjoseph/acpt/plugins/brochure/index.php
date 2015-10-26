<?php

add_action('init', 'acpt_brochure_init');

function acpt_brochure_init() {
    $args_brochure = array(
        'supports' => array('title', 'editor', 'thumbnail','author','excerpt','post-formats'),
        'hierarchical' => FALSE,
    );
    $brochure = acpt_post_type('brochure', 'brochures', false, $args_brochure)->icon('cake');    
    //acpt_tax('Job Category', 'Job Categories', $job, true, false);
    $collection_Admin = new Custom_Post_Type_Admin('brochure',array('brochure-category'));
}
