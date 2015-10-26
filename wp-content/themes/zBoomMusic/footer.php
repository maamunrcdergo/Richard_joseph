<!--------------Footer--------------->


<footer>
	<div class="wrap-footer zerogrid">
		<div class="row block09">
			<?php dynamic_sidebar('footer_widget'); ?>
		</div>
		<?php global $zboomsmusic; if($zboomsmusic['button_set_2']==1): ?>
			<h1>Fev Food</h1>
		<?php endif; ?>
		<ul>
			<?php if($zboomsmusic['food_fec']['1'] ==1): ?>
				<li>Graphic Design</li>
			<?php endif;?>
			<?php if($zboomsmusic['food_fec']['2'] ==1): ?>
				<li>Web Design</li>
			<?php endif;?>
			<?php if($zboomsmusic['food_fec']['3'] ==1): ?>
				<li>software Devlopment</li>
			<?php endif;?>
			<?php if($zboomsmusic['food_fec']['4'] ==1): ?>
				<li>software Devlopment</li>
			<?php endif;?>
		</ul>
		<div class="row copyright">
			<p>
				<?php
					 global $zboomsmusic;
					echo $zboomsmusic['footer_text'];
				?>
			</p>
		</div>
	</div>
	
</footer>
<?php wp_footer(); ?>
</body>
</html>