<?php

add_action('init', 'acpt_news_init');

function acpt_news_init() {
    $args_news = array(
        'supports' => array('title', 'editor', 'thumbnail','author','excerpt','post-formats'),
        'hierarchical' => FALSE,
    );
    $news = acpt_post_type('news', 'news', false, $args_news)->icon('cake');    
    acpt_tax('News Category', 'News Categories', $news, true, false);
    $collection_Admin = new Custom_Post_Type_Admin('news',array('news-category'));
}
