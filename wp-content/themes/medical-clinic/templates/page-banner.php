<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $mclinic_options;
$page_id = get_the_ID();
$banner_img_src = get_field('banner_image',$page_id);
$banner_img = empty($banner_img_src) ? sprintf('style="background-image: url(%s);"',$mclinic_options['default_page_banner']['url']):sprintf('style="background-image: url(%s);"',$banner_img_src);

?>
  <div id="banner" class="innerbanner" <?php echo $banner_img;?>><!-- Slider -->
    <div class="container">
      <div class="row">
        <div data-animation-delay="100" data-animate="fadeInUp" class="col-xs-12 fadeInUp text-center" style="animation-delay: 100ms;">

          <h2 class="page-title"><?php theme_page_title();?></h2>
          <?php if(!empty($mclinic_options['show_subtitle'])):?>
          <h4 class="page-subtitle"><?php theme_page_subtitle();?></h4>
          <?php endif;?>

        </div>
      </div>
    </div>
  </div><!--End Slider -->