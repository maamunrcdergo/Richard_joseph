<?php get_header(); ?>
<?php 
	/*
		Template Name:Test
	*/
 ?>
<section id="content">
	<div class="wrap-content zerogrid">
		<h1>Our Fevrate Food:<?php echo get_post_meta(get_the_ID(),office,true) ?></h1>
	</div>
</section>
 <?php get_footer(); ?>
