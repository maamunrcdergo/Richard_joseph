<?php
/**
 * Template Name: Front Page
 */

get_header(); ?>
<?php
get_header();
?>
      <section id="site-content">
         <?php get_template_part('templates/home', 'slider'); ?>  
         <?php get_template_part('templates/home', 'services'); ?>  
         <?php get_template_part('templates/home', 'doctors'); ?>  
         <?php get_template_part('templates/home', 'products'); ?>  
        <div class="container">
          <?php if(have_posts()):
            while(have_posts()):the_post();
            ?>
         	<div class="entry-content">
            <?php the_content();?>
          </div>
          <?php
            endwhile;
          endif;
?>
        </div> 
         <?php get_template_part('templates/home', 'testimonial'); ?>  
      </section> 
<?php
get_footer();