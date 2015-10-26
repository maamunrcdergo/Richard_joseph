<?php

add_action('init', 'acpt_testimonials_init');

function acpt_testimonials_init() {

    // in supports add the meta box custom
    $args_testimonial = array(
        'supports' => array('title', 'editor', 'thumbnail'),
        'hierarchical' => true,
    );
    $testimonial = acpt_post_type('testimonial', 'testimonials', false, $args_testimonial)->icon('person');
    acpt_tax('author', 'author', $testimonial, true, false);
    
    $testimonial_Admin = new Custom_Post_Type_Admin('testimonial',array('author'));
}