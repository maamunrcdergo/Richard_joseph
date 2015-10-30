<?php
$product_id = get_the_ID();
 $attchment = get_post_thumbnail_id($product_id, 'full');
 $attachment_url = wp_get_attachment_url($attchment);
?>
<div class="poroduct-grid text-center col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-0 col-md-4 col-md-offset-0" itemscope itemtype="http://schema.org/Product">
<div class="thumbnail">
  <a  href="<?php the_permalink() ?>"><img itemprop="image" class="img-responsive" src="<?php echo $attachment_url; ?>" alt="Product:<?php the_title() ?>"></a>
  <div class="caption">
    <h3 itemprop="name"><a itemprop="url" href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
    <?php the_excerpt(); ?>
    <p><a itemprop="image" class="btn-custom" href="<?php the_permalink();?>">Show Details</a></p>
  </div>
</div>
</div>