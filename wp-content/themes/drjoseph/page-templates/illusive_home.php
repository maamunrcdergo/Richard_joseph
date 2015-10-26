<?php
/*
 * @package WP-@IllusiveDesign
 * @subpackage RideFlag
 * @since RideFlag 1.0
 * 2015(c) IllusiveDesign
 */
/*
 * Template Name: Illusive Home
 */
global $illusive_redux;

get_header();
?>
<section id="main" class="site-content">
    <div class="<?php illusive_layout('main-content'); ?>">
        <?php
        if (have_posts()):
            while (have_posts()):the_post();
                get_template_part('content', 'page');
            endwhile;
        endif;
        ?>
    </div>
</section>
<?php if (is_active_sidebar('home-content-1-widgets')) : ?>
    <section id="Content-1-widgets" class="site-content-widgets-1">

        <div class="<?php illusive_layout('container-home-widgets'); ?>">
            <div class="row">
                <h2 class="section-title">
                    <?php echo $illusive_redux['title1']; ?>
                </h2>
                <?php dynamic_sidebar('home-content-1-widgets'); ?>
            </div>
        </div>  
    </section>
<?php endif; ?>

<?php if (is_active_sidebar('home-content-2-widgets')) : ?>
    <section id="Content-2-widgets" class="site-content-widgets-2">
        <div class="<?php illusive_layout('container-home-widgets'); ?>">
            <div class="row">
                <h2 class="section-title">
                    <?php echo $illusive_redux['title2']; ?>
                </h2>
                <?php dynamic_sidebar('home-content-2-widgets'); ?>
            </div>
        </div>
    </section>   
<?php endif; ?>
<?php if (is_active_sidebar('home-content-3-widgets')) : ?>
    <section id="Content-3-widgets" class="site-content-widgets-3">
        <div class="<?php illusive_layout('container-home-widgets'); ?>">
            <div class="row">
                <h2 class="section-title">
                    <?php echo $illusive_redux['title3']; ?>
                </h2>
                <?php dynamic_sidebar('home-content-3-widgets'); ?>
            </div>
        </div>
    </section>   
<?php endif; ?>

<?php if (is_active_sidebar('home-content-4-widgets')) : ?>
    <section id="Content-4-widgets" class="site-content-widgets-4">
        <div class="<?php illusive_layout('container-home-widgets'); ?>">
            <div class="row">
                <h2 class="section-title">
                    <?php echo $illusive_redux['title4']; ?>
                </h2>
                <?php dynamic_sidebar('home-content-4-widgets'); ?>
            </div>
        </div>
    </section>   
<?php endif; ?>
<?php if (is_active_sidebar('home-content-5-widgets')) : ?>
    <section id="Content-5-widgets" class="site-content-widgets-5">
        <div class="<?php illusive_layout('container-home-widgets'); ?>">
            <div class="row">
                
                <?php dynamic_sidebar('home-content-5-widgets'); ?>
            </div>
        </div>
    </section>   
<?php endif; ?>
<?php if (is_active_sidebar('home-subscribe')) : ?>
    <section id="Content-subscribe-widgets" class="site-content-widgets-subscribe">
        <div class="<?php illusive_layout('container-widgets-subscribe'); ?>">
            <div class="row">
                
                <?php dynamic_sidebar('home-subscribe'); ?>
            </div>
        </div>
    </section>   
<?php endif; ?>


<?php get_footer() ?>