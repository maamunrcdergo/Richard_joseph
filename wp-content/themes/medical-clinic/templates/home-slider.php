<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sliders = get_mclinic_slides();
if(!empty($sliders)):
  $count = count($sliders);
?>
<div id="banner" class="slider"><!-- Slider -->
			<div id="slider_slide" class="carousel slide <?php echo ($count ==1)? 'single-slide':'';?>" data-ride="carousel">
			  <div class="carousel-inner" role="listbox">
        <?php foreach($sliders as $key=>$slide):?>  
				<div class="item <?php echo ($key ==0)? 'active':'';?>">
				  <img src="<?php echo $slide->img;?>" alt="Image: <?php echo $slide->title;?>">
					<div class="slider_text">
						<div class="jumbotron">
							<h1><?php echo $slide->title;?></h1>
							<?php echo wpautop($slide->content);?>	
              <?php if(!empty($slide->link_text) && !empty($slide->link_url)){
                printf('<p><a class="btn" href="%2$s" role="button">%1$s<i class="fa fa-plus text-secondary mrm"></i></a></p>',$slide->link_text,$slide->link_url);
              }?>
							
						</div>
					</div>
				</div>
          <?php endforeach;?>
			  </div>

			  <!-- Controls -->
			   <a data-slide="prev" role="button" href="#slider_slide" class="left carousel-control">
					<span aria-hidden="true" class="fa fa-arrow-left"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a data-slide="next" role="button" href="#slider_slide" class="right carousel-control">
					<span aria-hidden="true" class="fa fa-arrow-right"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div><!--End Slider -->
    <?php endif;