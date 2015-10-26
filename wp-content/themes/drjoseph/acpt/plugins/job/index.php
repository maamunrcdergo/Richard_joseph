<?php

add_action('init', 'acpt_job_init');

function acpt_job_init() {
    $args_job = array(
        'supports' => array('title', 'editor', 'thumbnail','author','excerpt','post-formats'),
        'hierarchical' => FALSE,
    );
    $job = acpt_post_type('job', 'jobs', false, $args_job)->icon('cake');    
    //acpt_tax('Job Category', 'Job Categories', $job, true, false);
    $collection_Admin = new Custom_Post_Type_Admin('job',array('job-category'));
}
