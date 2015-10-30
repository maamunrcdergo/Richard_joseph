<?php
global $mclinic_options;
$doctor_ids = $mclinic_options['home_doctors'];
$drargs = array('post__in' => $doctor_ids);
$doctors = get_mclinic_doctors($drargs);
if (!empty($doctors)):
  ?>
  <div class="section-inner sdoctors"><!-- Services section Start -->
    <div class="container">
      <?php if(!empty($mclinic_options['doctors_sec_title'])):?>
				<div class="row">
					<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 os" data-animate="fadeInUp">
						<h2 class="heading_title">Meet our doctors</h2>
						<div class="line"></div>
						<p class="sub_heading">Wether you need to create a site for a medical center, spa, gym, vet shop; It also work for many other different types of businesses. If you need a business website, this theme is right for you. Check all the features and fall in love with Health Plus</p>
					</div>
				</div>
        <?php endif;?>
      <div class="row meet_out_team">
        <?php 
        $adelay = 200;
        foreach($doctors as $key=>$doctor): ?>
						<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-0 os" data-animate="fadeInLeft" data-animation-delay="<?php echo $adelay;?>">
							<div class="thumbnail">
								<div class="team_member_detials">
									<div class="doctor_img">
										<img class="img-responsive wp-post-image" src="<?php echo $doctor->img;?>" alt="team_1_img">
										<div class="social">
											<a class="icons" href="#"><i class="fa fa-facebook"></i></a>
											<a class="icons" href="#"><i class="fa fa-twitter"></i></a>
											<a class="icons" href="#"><i class="fa fa-google-plus"></i></a>
											<a class="icons" href="#"><i class="fa fa-skype"></i></a>
										</div>
									</div>
									<div class="caption">
                    <h4 class="name"><a href="<?php echo $doctor->link;?>"><?php echo $doctor->name;?></a></h4>
										<div class="pos">
											<?php echo $doctor->degree;?>
										</div>
										<p class="sort_bios">
											 <?php echo esc_attr($doctor->short_bio);?>
											<a href="<?php echo $doctor->link;?>">View Details</a>
										</p>
									</div>
								</div>
							</div>
						</div>
        <?php 
        $adelay +=100;
        endforeach;?>
      </div>
      <?php if(!empty($mclinic_options['doctor_page_id'])):?>
      <div class="sec-bottom row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
          <a class="service_more_btn" href="<?php echo get_permalink($mclinic_options['service_page_id'])?>">View all our Services<i class="fa fa-plus mll"></i></a>
        </div>
      </div>
        <?php endif;?>
    </div>
  </div><!-- Services section End -->
  <?php
 endif;