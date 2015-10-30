<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ThemeShortcodes {
    function __construct() {
        add_action('init',array($this,'shortcodes'));
    }
    public function shortcodes(){
      add_shortcode('icons', array($this,'icons'));
      add_shortcode('googlemap', array($this,'googlemap'));
    }
    public function icons($attrs,$contents){
      $default = array('i'=>'info','color'=>'inherit');     
     $attrs = shortcode_atts($default, $attrs, 'icons' );    
      return sprintf('<i class="tscode fa fa-%1$s color-%2$s"></i>',$attrs['i'],$attrs['color']);
    }
    public function googlemap($attrs,$contents){
     // $default = array('i'=>'info','color'=>'inherit');     
     // $attrs = shortcode_atts($default, $attrs, 'icons' );    
      return '<div class="tscode embed-responsive embed-responsive-16by9"><iframe class="os" data-animate="fadeInDown" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2886.963205568124!2d-79.90031818423257!3d43.648933860724036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b6d4ab5e7f479%3A0xa9d4741fd3cf7114!2s280+Guelph+St+%2318%2C+Georgetown%2C+ON+L7G+4B1%2C+Canada!5e0!3m2!1sen!2s!4v1444998345556" frameborder="0" style="border:0" allowfullscreen></iframe></div>';
    }
}
new ThemeShortcodes();