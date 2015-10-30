<?php
get_header();
get_template_part('templates/page', 'banner');
$page_id = get_the_ID();
?>
<section id="site-content">
  <div class="container two-column">
    <div class="row">
      <div id="content-area" class="col-xs-12 col-sm-12 col-md-8 column-content">
        <main id="main" class="site-main" role="main">
          <?php if (have_posts()): ?>            
            <?php
            while (have_posts()):the_post();
             ?>
          <div class="entry-content">
            <?php the_content();?>
          </div>
          <?php
            endwhile;?>
         <?php   else:
              	   get_template_part( 'content', 'none' );
          endif;
          ?>
        </main>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 column-sidebar">
            <?php get_sidebar();?>
      </div>
    </div>
  </div>
</section> 
<?php
get_footer();
