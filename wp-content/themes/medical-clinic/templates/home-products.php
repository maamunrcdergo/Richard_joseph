<?php
global $mclinic_options;
$product_show = $mclinic_options['featured_product_count'];
$pdargs = array('posts_per_page' => $product_show);
$products = get_mclinic_products($pdargs);
if (!empty($products)):
  ?>
  <div class="section-inner sproducts"><!-- Services section Start -->
    <div class="container">
      <?php if(!empty($mclinic_options['products_sec_title'])):?>
      <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 os" data-animate="fadeInUp">
          <h2 class="heading_title"><?php echo $mclinic_options['products_sec_title'];?></h2>
          <div class="line"></div>
        </div>
      </div>
        <?php endif;?>
      <div class="row">
        	<div id="owl-example" class="owl-carousel">
            <?php foreach($products as $key=>$product):?>
						<div class="owl-item active os" data-animate="fadeInLeft">
							<div class="thumbnail">
                <a  href="<?php echo $product->url;?>"><img class="img-responsive" src="<?php echo $product->img;?>" alt="pro_img1"></a>
							  <div class="caption">
								<h3><a  href="<?php echo $product->url;?>"><?php echo $product->title;?></a></h3>
								 <?php echo wpautop($product->excerpt);?>
                <p><a class="btn-custom" href="<?php echo $product->url;?>">Show Details</a></p>
							  </div>
							</div>
						</div>
<?php endforeach;?>
					</div>
       
      </div>

    </div>
  </div><!-- Services section End -->
  <?php
 endif;