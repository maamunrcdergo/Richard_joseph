<?php

add_action('init', 'acpt_notice_init');

function acpt_notice_init() {
    $args_notice = array(
        'supports' => array('title', 'editor', 'thumbnail','author','excerpt'),
        'hierarchical' => FALSE,
    );
    $notice = acpt_post_type('notice', 'notices', false, $args_notice)->icon('clock');    
    acpt_tax('Notice Category', 'Notice Category', $notice, true, false);
    $collection_Admin = new Custom_Post_Type_Admin('notice',array('notice-category'));
}
