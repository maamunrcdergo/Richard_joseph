<?php 
define('DRJOSEPH_THEME_URL', get_template_directory_uri());
define('DRJOSEPH_THEME_PATH', get_template_directory());
define('DRJOSEPH_THEME_LIBSPATH', DRJOSEPH_THEME_PATH.'/libs');
define('DRJOSEPH_HOME_URL',  home_url( '/' ));

//Required Files
require_once DRJOSEPH_THEME_LIBSPATH.'/navwalker.php';
require_once DRJOSEPH_THEME_LIBSPATH.'/theme-setups.php';
