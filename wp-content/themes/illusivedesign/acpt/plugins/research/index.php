<?php

add_action('init', 'acpt_research_init');

function acpt_research_init() {
    $args_research = array(
        'supports' => array('title', 'editor', 'thumbnail','author','excerpt','post-formats'),
        'hierarchical' => FALSE,
    );
    $research = acpt_post_type('research', 'researches', false, $args_research)->icon('cake');    
    //acpt_tax('Research Category', 'Research Categories', $research, true, false);
    $collection_Admin = new Custom_Post_Type_Admin('research',array('research-category'));
}
