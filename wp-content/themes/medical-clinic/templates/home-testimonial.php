<?php
global $mclinic_options;
$testimonial_show = $mclinic_options['testimonial_count'];
$tsargs = array('posts_per_page' => $testimonial_show);
$testimonials = get_mclinic_testimonials($tsargs);
if (!empty($testimonials)):
  ?>
  <div class="section-inner stestimonials"><!-- Services section Start -->
    <div class="container">
      <?php if (!empty($mclinic_options['testimonial_sec_title'])): ?>
        <div class="row">
          <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 os" data-animate="fadeInUp">
            <h2 class="heading_title"><?php echo $mclinic_options['testimonial_sec_title']; ?></h2>
            <div class="line"></div>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <div class="testimonial_mess_item">
      <div id="testimonial_mess_item" class="carousel slide" data-ride="carousel">
        <div class="container">
          <div class="carousel-inner" role="listbox">
              <?php foreach ($testimonials as $key => $testimonial): ?>
            <div class="item <?php echo ($key ==0)? 'active':'';?>">
              <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 os animated flipInX" data-animate="flipInX">
                  <div class="testimonial_item">
                    <div class="name"><?php echo $testimonial->author;?></div>
                    <div class="pos"><?php echo $testimonial->designation;?></div>
                    <div class="desc">
                      <?php echo wpautop($testimonial->content);?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <a class="left carousel-control" href="#testimonial_mess_item" role="button" data-slide="prev">
          <span class="fa fa-arrow-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#testimonial_mess_item" role="button" data-slide="next">
          <span class="fa fa-arrow-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>

  </div><!-- Services section End -->
  <?php

 endif;