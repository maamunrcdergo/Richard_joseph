<?php
global $mclinic_options;
if ($mclinic_options['show_footer_widgets'] && !empty($mclinic_options['footer_widgets_count'])) :
  ?>
  <div id="footer-widgets" class="section-inner">
    <div class="container">
      <div class="row">
        <?php
        for ($widget = 1; $widget <= $mclinic_options['footer_widgets_count']; $widget++):
          if (is_active_sidebar('footer-area-'.$widget)) :
            ?>
            <div id="footer-widget-area-<?php echo $widget;?>" class="widget-area col-md-4 col-sm-6 col-xs-12 os" role="complementary" data-animate="fadeInUp">
            <?php dynamic_sidebar('footer-area-'.$widget); ?>
            </div><!-- .widget-area -->
            <?php
          endif;
        endfor;
        ?>
      </div>
    </div>
  </div>
  <?php
endif;
