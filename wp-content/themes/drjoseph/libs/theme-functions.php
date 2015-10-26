<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
add_action('wp_head', 'theme_custom_favicon');
/*
 * add custom  favicon
 */
function theme_custom_favicon() {
  global $drjoseph_options;
  if (!empty($drjoseph_options['custom_favicon'])) {
    printf('<link rel="shortcut icon" href="%s" type="image/x-icon">',$drjoseph_options['custom_favicon']['url']);
    printf('<link rel="icon" href="%s" type="image/x-icon">',$drjoseph_options['custom_favicon']['url']);
  }
}
