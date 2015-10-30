<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
add_action('wp_head', 'theme_custom_favicon');
add_action('wp_head', 'theme_apple_touch_icon');
add_action('wp_head', 'theme_humans_txt');
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
function theme_apple_touch_icon() {
  global $drjoseph_options;
  if (!empty($drjoseph_options['apple_touch_icon'])) {
    printf('<link rel="apple-touch-icon" href="%s">',$drjoseph_options['custom_favicon']['url']);   
  }
}
function theme_humans_txt() {
  global $drjoseph_options;
  if (!empty($drjoseph_options['humans_txt'])) {
    $link = DRJOSEPH_THEME_URL.'/humans.txt';
   echo "<link rel='author' href='{$link}' />";
  }
}
