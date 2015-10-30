<?php
$product_id = get_the_ID();
$attchment = get_post_thumbnail_id($product_id, 'full');
$attachment_url = wp_get_attachment_url($attchment);
$icon_att_id = get_field('icon', $service->ID);
$icon_att_url = wp_get_attachment_url($icon_att_id);
?>
<div class="service-grid text-center col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-0 col-md-4 col-md-offset-0" >
  <div class="thumbnail" itemscope itemtype="http://schema.org/Service">
    <a  href="<?php the_permalink() ?>"><img itemprop="image" class="img-responsive title_main_img" src="<?php echo $attachment_url; ?>" alt="service_image"></a>
    <div class="caption">
      <img  class="service_icon" src="<?php echo $icon_att_url; ?>" alt="Service Icon" />
      <h3 class="service_title"><a  href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
      <div itemprop="description"><p><?php the_excerpt(); ?></p></div>
      <p><a itemprop="image" class="btn-custom" href="<?php the_permalink(); ?>">Read More</a></p>
    </div>
  </div>
</div>