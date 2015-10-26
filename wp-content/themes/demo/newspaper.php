<?php get_header(); ?>
<?php 
	/*
		Template Name:Newspaper
	*/
 ?>
<section id="content">
	<div class="wrap-content zerogrid">
		<div class="row block03">
			<div class="col-2-3">
				<?php
					$left_side_bar = get_the_category_by_id($zboomsmusic['left_catagory_selector']);
					$internation=new WP_Query(array(
						'post_type'=>'post',
						'posts_per_page'=>3,
						'category_name'=>$left_side_bar,
					));
				while($internation->have_posts()):$internation->the_post(); ?>
					<h1><?php the_title(); ?></h1>
				<?php endwhile; ?>
			</div>
			<div class="col-1-3">
				<?php
				$right_side_category= get_the_category_by_id($zboomsmusic['right_catagory_selector']);
				$national= new WP_Query(array(
					'post_type'=>'post',
					'posts_per_page'=>3,
					'category_name'=>$right_side_category,
				));
				while($national->have_posts()):$national->the_post(); ?>
					<h1><?php the_title(); ?></h1>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</section>
 <?php get_footer(); ?>