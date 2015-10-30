<?php 
define('MCLINIC_THEME_URL', get_template_directory_uri());
define('MCLINIC_THEME_PATH', get_template_directory());
define('MCLINIC_THEME_LIBSPATH', MCLINIC_THEME_PATH.'/libs');
define('MCLINIC_HOME_URL',  home_url( '/' ));

//Required Files
require_once MCLINIC_THEME_LIBSPATH.'/navwalker.php';
require_once MCLINIC_THEME_LIBSPATH.'/tgm-plugin-activation.php';
require_once MCLINIC_THEME_LIBSPATH.'/ReduxFramework/ReduxCore/framework.php';
require_once MCLINIC_THEME_LIBSPATH.'/ReduxFramework/mclinic-config.php';
require_once MCLINIC_THEME_LIBSPATH.'/theme-setups.php';
require_once MCLINIC_THEME_LIBSPATH.'/theme-functions.php';

//Add Custom Post Type
require_once MCLINIC_THEME_LIBSPATH.'/class-service-content-type.php';
require_once MCLINIC_THEME_LIBSPATH.'/class-slider-content-type.php';
require_once MCLINIC_THEME_LIBSPATH.'/class-doctor-content-type.php';
require_once MCLINIC_THEME_LIBSPATH.'/class-product-content-type.php';
require_once MCLINIC_THEME_LIBSPATH.'/class-testimonial-content-type.php';

//Addtional Functionalities
require_once MCLINIC_THEME_LIBSPATH.'/widgets/widgets-init.php';
require_once MCLINIC_THEME_LIBSPATH.'/shortcodes/shortcodes-init.php';
require_once MCLINIC_THEME_LIBSPATH.'/theme-content-fields.php';

function wpprint($data){
  echo '<pre>';
  print_r($data);
  echo '</pre>';
}
