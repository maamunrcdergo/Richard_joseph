<?php get_header(); ?>
<?php 
	/*
		Template Name:contact
	*/
?>
<!--------------Content--------------->
<section id="content">
	<div class="wrap-content zerogrid">
		<div class="row block03">
			<?php if($zboomsmusic['opt-layout']==2): ?>
			<div class="col-2-3">
				<div class="wrap-col">
					<?php while(have_posts()): the_post();?>
					<article>
						<?php the_post_thumbnail();?>
						<h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
						<?php the_content(); ?>
						<div class="comment">
						</div>
					</article>
					<?php endwhile;?>
				</div>
			</div>
			<div class="col-1-3">
				<div class="wrap-col">
					<?php dynamic_sidebar('contact_sidebar') ?>
				</div>
			</div>
		<?php endif; ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>