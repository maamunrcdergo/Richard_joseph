<?php

add_action('init', 'acpt_blog_init');

function acpt_blog_init() {
    $args_blog = array(
        'supports' => array('title', 'editor', 'thumbnail','author','excerpt','post-formats'),
        'hierarchical' => FALSE,
    );
    $blog = acpt_post_type('blog', 'blogs', false, $args_blog)->icon('calendar');    
    acpt_tax('Blog Category', 'Blog Categories', $blog, true, false);
    $collection_Admin = new Custom_Post_Type_Admin('blog',array('blog-category'));
}
