<?php

add_action('init', 'acpt_events_init');

function acpt_events_init() {
    $args_news_events = array(
        'supports' => array('title', 'editor', 'thumbnail','excerpt'),
        'hierarchical' => FALSE,
    );
    $news_events = acpt_post_type('event', 'events', false, $args_news_events)->icon('calendar'); 
    acpt_tax('Event Category', 'Event Category', $news_events, true, false);
    $collection_Admin = new Custom_Post_Type_Admin('event');
    
}