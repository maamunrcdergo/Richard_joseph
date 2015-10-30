<?php
get_header();
get_template_part('templates/page', 'banner');
$page_id = get_the_ID();
?>
<section id="site-content">
  <div class="container one-column">
    <div class="row">
      <div id="content-area" class="col-xs-12 column-content">
        <main id="main" class="site-main" role="main">
          <div class="entry-content row">
            
            <?php if (have_posts()): ?>            
              <?php
              while (have_posts()):the_post();
                ?>

                <?php get_template_part('templates/service', 'loop'); ?>

                <?php endwhile;
              ?>
            <?php
            else:
              get_template_part('content', 'none');
            endif;
            ?>
          </div>
        </main>
      </div>
    </div>
  </div>
</section> 
<?php
get_footer();
