<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
add_action('init', 'acpt_services_init');
function acpt_services_init(){
    $args_services = array(
        'supports' => array('title', 'editor', 'thumbnail','excerpt'),
        'hierarchical' => true,
    );
    $services = acpt_post_type('service', 'services', false, $args_services)->icon('mic');
    acpt_tax('stype', 'stypes', $services, true, false);
    $services_Admin = new Custom_Post_Type_Admin('service',array('stype'));
}