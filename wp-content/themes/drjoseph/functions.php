<?php 
define('DRJOSEPH_THEME_URL', get_template_directory_uri());
define('DRJOSEPH_THEME_PATH', get_template_directory());
define('DRJOSEPH_THEME_LIBSPATH', DRJOSEPH_THEME_PATH.'/libs');
define('DRJOSEPH_HOME_URL',  home_url( '/' ));

//Required Files
require_once DRJOSEPH_THEME_LIBSPATH.'/navwalker.php';
require_once DRJOSEPH_THEME_LIBSPATH.'/tgm-plugin-activation.php';
require_once DRJOSEPH_THEME_LIBSPATH.'/ReduxFramework/ReduxCore/framework.php';
require_once DRJOSEPH_THEME_LIBSPATH.'/ReduxFramework/drjoseph-config.php';
require_once DRJOSEPH_THEME_LIBSPATH.'/theme-setups.php';
require_once DRJOSEPH_THEME_LIBSPATH.'/theme-functions.php';
//Add Custom Post Type
require_once DRJOSEPH_THEME_LIBSPATH.'/class-service-content-type.php';
require_once DRJOSEPH_THEME_LIBSPATH.'/class-slider-content-type.php';
require_once DRJOSEPH_THEME_LIBSPATH.'/class-doctor-content-type.php';

function wpprint($data){
  echo '<pre>';
  print_r($data);
  echo '</pre>';
}
