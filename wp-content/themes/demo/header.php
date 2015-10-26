<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="<?php bloginfo('charset') ?>">
	<meta name="description" content="<?php bloginfo('description');?>"
	<meta name="author" content="mamun">
	
    <!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- CSS
  ================================================== -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="all"/>
	
	<!--[if lt IE 8]>
       <div style=' clear: both; text-align:center; position: relative;'>
         <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
           <img src="http://storage.ie6countdown.com/assets/100/<?php echo esc_url(get_template_directory_uri()); ?>/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
      </div>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="js/html5.js"></script>
		<script src="js/css3-mediaqueries.js"></script>
	<![endif]-->
	
	<link href='<?php echo esc_url(get_template_directory_uri()); ?>/<?php echo esc_url(get_template_directory_uri()); ?>/images/favicon.ico' rel='icon' type='image/x-icon'/>
	<style type="text/css">
		<?php global $zboomsmusic; echo $zboomsmusic['custom_css']; ?>
		<?php $zboomsmusic; echo $zboomsmusic['customize_color']; ?>
		body{
			color:<?php echo $zboomsmusic['color_property'];?> !important;
			background-color:<?php echo $zboomsmusic['custom_backgrond']['background-color'];?> !important;
			background-image:url(<?php echo $zboomsmusic['custom_backgrond']['background-image'];?>) !important;
			background-repeat:<?php echo $zboomsmusic['custom_backgrond']['background-repeat'];?> !important;
			background-size:<?php echo $zboomsmusic['custom_backgrond']['background-size'];?> !important;
			background-attachment:<?php echo $zboomsmusic['custom_backgrond']['background-attachment'];?> !important;
			background-position:<?php echo $zboomsmusic['custom_backgrond']['background-position'];?> !important;
		}
		.wrap-nav{
			border-style:<?php echo $zboomsmusic['border_style']['border-style'];?>;
			border-width:<?php echo $zboomsmusic['border_style']['border-top'];?>;
			border-color:<?php echo $zboomsmusic['border_style']['border-color'];?>;
		}
		a{color:<?php echo $zboomsmusic['link_color']; ?>!important}
		header .wrap-header
		{
			width:<?php echo $zboomsmusic['header_dimensions']['width']; ?>!important;
			height:<?php echo $zboomsmusic['header_dimensions']['height']; ?>!important;
		}
	</style>
	<?php wp_head();?>
</head>
<body <?php body_class(); ?>
<!--------------Header--------------->
<header>
	<div class="wrap-header zerogrid">
		<!--logo show hide option -->
			<?php if($zboomsmusic['button_set']==1): ?>
				<div id="logo"><a href="<?php bloginfo('home'); ?>"><img src="<?php global $zboomsmusic; echo $zboomsmusic['logo_uploaded']['url'];  ?>"/></a>
				</div>
			<?php endif; ?>
		<!--logo show hide option end -->
		<!-- <?php get_search_form();?> -->
		<?php if($zboomsmusic['search_button']==1): ?>

		<div id="search">
		<form mathod="GET" action="<?php esc_url(bloginfo('home'));?>">
			<div class="button-search"></div>
			<input name="s" type="text" value="Search..." onfocus="if (this.value == &#39;Search...&#39;) {this.value = &#39;&#39;;}" onblur="if (this.value == &#39;&#39;) {this.value = &#39;Search...&#39;;}">
		</form>
		</div>
		<?php endif; ?>
	</div>
</header>
<nav>
	<div class="wrap-nav zerogrid">
		<div class="menu">
			<?php wp_nav_menu(array(
				'them_location'=>'main-menu'
			)) ?>
		</div>
	</div>
</nav>

