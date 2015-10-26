<?php
/**
 * @package WP-@IllusiveDesign
 * @subpackage IllusiveDesign
 * @since IllusiveDesign 1.0
 * 2015(c) IllusiveDesign
 */
define('ILLUSIVE_THEME', 'illusivedesign');
define('ILLUSIVE_THEME_VAR', '1.0');

define('ILLUSIVE_THEME_DIR', get_template_directory());
define('ILLUSIVE_THEME_URI', get_template_directory_uri());
define('ILLUSIVE_THEME_LIBS_DIR', ILLUSIVE_THEME_DIR.'/libs');
define('ILLUSIVE_THEME_ASSETS_URI', ILLUSIVE_THEME_URI.'/assets');
define('THEME_DEV_MOD', TRUE);

if ( !class_exists( 'ReduxFramework' )) {
    require_once( ILLUSIVE_THEME_LIBS_DIR . '/ReduxFramework/ReduxCore/framework.php' );
    //require_once( ILLUSIVE_THEME_LIBS_DIR . '/ReduxFramework/rideflag-config.php' );
    require_once( ILLUSIVE_THEME_LIBS_DIR . '/ReduxFramework/illusive-config.php' );

  }
 require_once( ILLUSIVE_THEME_LIBS_DIR . '/theme-setups.php' );
 require_once( ILLUSIVE_THEME_LIBS_DIR . '/theme-functions.php' );
// if(!function_exists('of_get_option')){
//    function of_get_option(){
//        
//    }
//}

 require_once( ILLUSIVE_THEME_LIBS_DIR . '/shortcodes/shortcodes.php' );
 require_once( ILLUSIVE_THEME_DIR . '/widgets/widgets-init.php' );

 require_once( ILLUSIVE_THEME_DIR . '/acpt/init.php');
 
 //  Register TGM_Plugin_Activation class to install Redux Framework.
require_once ILLUSIVE_THEME_LIBS_DIR . '/tgm-plugin-activation.php';
 
function wpprint($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}