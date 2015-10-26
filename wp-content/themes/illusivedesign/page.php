<?php
/*
 * @package WP-@IllusiveDesign
 * @subpackage IllusiveDesign
 * @since IllusiveDesign 1.0
 * 2015(c) IllusiveDesign
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
<?php get_footer();?>