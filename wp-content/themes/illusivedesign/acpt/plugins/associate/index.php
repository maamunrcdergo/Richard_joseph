<?php
add_action('init', 'acpt_associate_init');
function acpt_associate_init(){
    $args_associate = array(
        'supports' => array('title', 'editor', 'thumbnail'),
        'hierarchical' => true,
    );
    $associate = acpt_post_type('associate', 'associates', false, $args_associate)->icon('cake');
     acpt_tax('concern', 'concerns', $associate, true, false);
      $associate_Admin = new Custom_Post_Type_Admin('associate',array('concern'));
}
