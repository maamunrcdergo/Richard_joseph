<?php 
	function zboom_heading($atts,$content){
		
		$heading_att=extract(shortcode_atts(array(
			"position"=>"left"
		),$atts));
		return "<h1 align='".$position."'>".$content."</h1>";
		
	}
	add_shortcode('rock','zboom_heading');
	
	
	
	function zboom_img($atts,$content){
		$imaged = shortcode_atts(array(
			'width'=>'330px',
			'height'=>'450px',
		),$atts);
		return '<img height="'.$imaged['height'].'" width="'.$imaged['width'].'" src="'.$content.'"/>';
	}
	add_shortcode('demo_img','zboom_img');
	
	function zboomusic_block_shortcode($atts,$content){
	ob_start();
			$service_att=extract(shortcode_atts(array(
				'number'=>'3',
			),$atts));
	?>	
	<?php 
		$blockitem = new WP_Query(array(
		'post_type' => 'zoomusic_service',
		'posts_per_page' => $number
	));
	?>
	<?php while($blockitem->have_posts()): $blockitem->the_post(); ?>
		<div class="col-1-3">
			<div class="wrap-col box">
				<h2><?php the_title() ?></h2>
				<p><?php read_more(10); ?></p>
				<div class="more"><a href="<?php the_permalink(); ?>">[...]</a></div>
			</div>
		</div>
	<?php endwhile ?>
	<?php	$service_block = ob_get_clean();
	return $service_block;
	}
	add_shortcode('service_block','zboomusic_block_shortcode');
?>
