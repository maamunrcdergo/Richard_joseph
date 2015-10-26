<?php
/*
 * @package WP-@IllusiveDesign
 * @subpackage RideFlag
 * @since RideFlag 1.0
 * 2015(c) IllusiveDesign
 */
global $illusive_redux;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <!--[if lt IE 9]>
        <script src="<?php echo ILLUSIVE_THEME_ASSETS_URI ?>/js/html5.js"></script>
        <script src="<?php echo ILLUSIVE_THEME_ASSETS_URI ?>/js/respond.min.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="site-wrap">
            <header id="header" class="site-header">
                <div class="<?php illusive_layout(); ?>">
                    <div class="navbar-header">
                        <?php if ($illusive_redux['show_logo']): ?>
                            <a rel="home" class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo $illusive_redux['logo_url']['url'] ?>" alt="<?php bloginfo('name'); ?>"/></a>
                        <?php else: ?>
                            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                        <?php endif; ?>
                        <?php
                        if ($illusive_redux['show_tagline']):
                            $description = get_bloginfo('description', 'display');
                            ?>
                            <p class="site-description"><?php echo $description; ?></p>
                        <?php endif; ?>
                        <a class="navbar-toggle" href="#parimery-mobilemenu-container">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                    </div>
                    <div id="navbar-primary" class="navbar collapse navbar-collapse">
                        <?php wp_nav_menu(array('theme_location' => 'primary-nav', 'menu_class' => 'nav navbar-nav', 'menu_id' => '', 'container_class' => 'parimery-menu-container')); ?>
                    </div>
                    <?php illusive_contact_nav(); ?>                  
                </div>

            </header>
            <section id="page-banner" class="site-banner">
<!--                <div class="<?php illusive_slider_layout('home_slider'); ?>">
                    //<?php
//                    if(is_front_page()){
//                      illusive_sliders();
//                    }else{
//                      illusive_page_banner(); 
//                    }
//                   
                ?>
                </div>-->
                <ul id="parallax-nav">
                    <li><a href="#intro" title="Next Section"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dot.png" alt="Link" /></a></li>
                    <li><a href="#second" title="Next Section"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dot.png" alt="Link" /></a></li>
                    <li><a href="#third" title="Next Section"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dot.png" alt="Link" /></a></li>
<!--                    <li><a href="#fifth" title="Next Section"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dot.png" alt="Link" /></a></li>-->
                </ul>

                <div id="intro">
                    <div class="container">
                        <h2 class="parallax-title">Vacation Rental Marketplace</h2>
                        <p class="parallax-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                            dummy text ever  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem </p>
                        <div class="parallax-link"><a href="#">Case Studies</a></div>
                    </div>
                </div> <!--#intro-->

                <div id="second">
                    <div class="container">
                        <h2 class="parallax-title">Custom Jewellery Builder</h2>
                        <p class="parallax-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                            dummy text ever  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem </p>
                        <div class="parallax-link"><a href="#">Case Studies</a></div>
                    </div>
                </div> <!--#second-->

                <div id="third">
                    <div class="container">
                        <h2 class="parallax-title">E-Commerce For Retailers</h2>
                        <p class="parallax-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                            dummy text ever  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem </p>
                        <div class="parallax-link"><a href="#">Case Studies</a></div>
                    </div>
                </div> <!--#third-->


            </section>