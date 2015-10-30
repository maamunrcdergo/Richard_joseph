<?php
global $mclinic_options;
$service_ids = $mclinic_options['home_services'];
$args = array('post__in' => $service_ids);
$services = get_mclinic_services($args);
if (!empty($services)):
  ?>
  <div class="section-inner shighlighted sservices"><!-- Services section Start -->
    <div class="container">
      <?php if(!empty($mclinic_options['service_sec_title'])):?>
      <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 os" data-animate="fadeInUp">
          <h2 class="heading_title_alt"><?php echo $mclinic_options['service_sec_title'];?></h2>
          <div class="line_2"></div>
        </div>
      </div>
        <?php endif;?>
      <div class="row">
        <?php 
        $adelay = 200;
        foreach($services as $key=>$service):?>
        <div class="col-md-4 col-sm-4 col-xs-12 os" data-animate="fadeInUp" data-animation-delay="<?php echo $adelay;?>">
          <div class="service_itme">
            <a href="<?php echo $service->url;?>" title="<?php echo $service->title;?>">
              <div class="icon_bg">
                <img src="<?php echo $service->icon;?>" alt="Icon:<?php echo $service->title;?>" />
              </div>
              <h4><?php echo $service->title;?></h4>
            </a>
          </div>
        </div>
        <?php 
        $adelay +=100;
        endforeach;?>
      </div>
      <?php if(!empty($mclinic_options['service_page_id'])):?>
      <div class="service_more_item row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
          <a class="service_more_btn" href="<?php echo get_permalink($mclinic_options['service_page_id'])?>">View all our Services<i class="fa fa-plus mll"></i></a>
        </div>
      </div>
        <?php endif;?>
    </div>
  </div><!-- Services section End -->
  <?php
 endif;