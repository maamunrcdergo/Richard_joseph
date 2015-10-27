<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<!-- Required meta tags always come first -->
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">		
		<link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri());?>/imgaes/favicon.ico" type="image/png">

	<?php wp_head(); ?>	
	</head>
	<body <?php body_class(); ?> id="top">
    <header id="header"><!-- Start Header -->
		<div class="top_header"><!-- Top Header -->
			<nav class="navbar navbar-default navbar-fixed-top"><!-- Menu -->
				<div class="container"> 
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main_menu" aria-expanded="false">
                                                    <span class="sr-only">Toggle navigation</span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
						</button>
						<a class="navbar-brand os" data-animate="fadeInLeft" onclick="jQuery('html,body').animate({scrollTop:0},'slow');return false;" href=" home_url( '/' )">
							<img class="img-responsive logo pull-left" src="<?php echo DRJOSEPH_THEME_URL;?>/images/logo.png" alt="logo"/>
							<span class="main_title"><?php bloginfo('name'); ?></span>
						</a>
					</div>
					<div class="collapse navbar-collapse menu" id="main_menu">
                                            <?php 
                                                wp_nav_menu(array(
                                                    'theme_location' => 'main-menu',
                                                    'menu_class'=>'nav navbar-nav',
                                                    'fallback_cb'=>'defauli_main_menu',
                                                    'walker' => new main_menu_walker()
                                                ));
                                                
                                             ?>
					</div>
				</div>
			</nav><!-- Menu End -->
		</div><!-- Top Header End -->
		<div class="slider"><!-- Slider -->
			<div id="slider_slide" class="carousel slide" data-ride="carousel">
			  <div class="carousel-inner" role="listbox">
				<div class="item active">
				  <img src="<?php echo DRJOSEPH_THEME_URL;?>/images/slider.jpg" alt="fs_slide">
					<div class="slider_text">
						<div class="jumbotron">
							<h1>Quality vision & Eye care</h1>
							<p>
								My staff and I take pride in providing all of our patients with the best possible eye care service. 
							</p>
							<p><a class="btn" href="#" role="button">Learn more<i class="fa fa-plus text-secondary mrm"></i></a></p>
						</div>
					</div>
				</div>
				<div class="item">
                    <img src="<?php echo esc_url(get_template_directory_uri());?>/images/slider.jpg" alt="fs_slide">
                    <div class="slider_text">
						<div class="jumbotron">
							<h1>Quality vision & Eye care</h1>
							<p>
								My staff and I take pride in providing all of our patients with the best possible eye care service. 
							</p>
							<p><a class="btn" href="#" role="button">Learn more<i class="fa fa-plus text-secondary mrm"></i></a></p>
						</div>
					</div>
				</div>
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
	</header><!-- End Header -->
	<section><!-- Start Section -->
		<div class="second_section"><!-- Services section Start -->
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 os" data-animate="fadeInUp">
						<h2 class="heading_title_2">Services</h2>
						<div class="line_2"></div>
					</div>
				</div>
				<div class="row">
                                   <?php while(have_posts()): the_post();?>
					<div class="col-md-4 col-sm-4 col-xs-12 os" data-animate="fadeInUp" data-animation-delay="200">
                                            <div class="service_itme">
                                                    <a href="<?php the_permalink();?>">
                                                            <div class="icon_bg">
                                                                    <img src="<?php the_post_thumbnail();?>" />
                                                            </div>
                                                            <h4><?php the_title(); ?></h4>
                                                    </a>
                                            </div>
					</div>
                                   <?php endwhile;?>
				</div>
				<div class="service_more_item row">
					<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
						<a class="service_more_btn" href="#">View all our departments<i class="fa fa-plus mll"></i></a>
					</div>
				</div>
			</div>
		</div><!-- Services section End -->
		<div class="third_section"><!-- Meet Our Doctors section Start -->
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 os" data-animate="fadeInUp">
						<h2 class="heading_title">Meet our doctors</h2>
						<div class="line"></div>
						<p class="sub_heading">Wether you need to create a site for a medical center, spa, gym, vet shop; It also work for many other different types of businesses. If you need a business website, this theme is right for you. Check all the features and fall in love with Health Plus</p>
					</div>
				</div>
			</div>
			<div class="meet_out_team">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12 os" data-animate="fadeInLeft">
							<div class="thumbnail">
								<div class="team_member_detials">
									<div class="doctor_img">
										<img class="img-responsive wp-post-image" src="<?php echo esc_url(get_template_directory_uri());?>/images/team1.jpg" alt="team_1_img">
										<div class="social">
											<a class="icons" href="#"><i class="fa fa-facebook"></i></a>
											<a class="icons" href="#"><i class="fa fa-twitter"></i></a>
											<a class="icons" href="#"><i class="fa fa-google-plus"></i></a>
											<a class="icons" href="#"><i class="fa fa-skype"></i></a>
										</div>
									</div>
									<div class="caption">
										<h4 class="name">John Kerry</h4>
										<div class="pos">
											<ul>
												<li>M.B.B.S</li>
												<li>/</li>
												<li>F.C.P.S</li>
											</ul>
										</div>
										<p class="sort_bios">
											Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and 
											<a href="#">View Details</a>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 os" data-animate="fadeInRight">
							<div class="thumbnail">
								<div class="team_member_detials">
									<div class="doctor_img">
										<img class="img-responsive wp-post-image" src="<?php echo esc_url(get_template_directory_uri());?>/images/team2.jpg" alt="team_2_img">
										<div class="social">
											<a class="icons" href="#"><i class="fa fa-facebook"></i></a>
											<a class="icons" href="#"><i class="fa fa-twitter"></i></a>
											<a class="icons" href="#"><i class="fa fa-google-plus"></i></a>
											<a class="icons" href="#"><i class="fa fa-skype"></i></a>
										</div>
									</div>
									<div class="caption">
										<h4 class="name">John Kerry</h4>
										<div class="pos">
											<ul>
												<li>M.B.B.S</li>
												<li>/</li>
												<li>F.C.P.S</li>
											</ul>
										</div>
										<p class="sort_bios">
											Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and 
											<a href="#">View Details</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- Meet Our Doctors section End -->
		<div class="first_section"><!-- Our Products Start -->
			<div class="container">
				<div class="row">
						<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 os" data-animate="fadeInUp" data-animation-delay="500">
							<h2 class="heading_title">Our Products</h2>
							<div class="line"></div>
						</div>
				</div>
				<div class="row">
					<div id="owl-example" class="owl-carousel">
						<div class="owl-item active os" data-animate="fadeInLeft">
							<div class="thumbnail">
							  <img class="img-responsive" src="<?php echo esc_url(get_template_directory_uri());?>/images/pro_img1.jpg" alt="pro_img1">
							  <div class="caption">
								<h3><a data-toggle="modal" data-target=".pro_1" href="#">BLINK EYE DROPS</a></h3>
								<p>Lorem ipsum dolor sit amet, consecter tur adipiscing elit.</p>
								<p><a href="product_details.html">Reat More</a></p>
							  </div>
							</div>
						</div>
						<div class="owl-item os" data-animate="fadeInUp">
							<div class="thumbnail">
							  <img class="img-responsive" src="<?php echo esc_url(get_template_directory_uri());?>/images/pro_img2.jpg" alt="pro_img2">
							  <div class="caption">
								<h3><a data-toggle="modal" data-target=".pro_2" href="#">Systane Eye Drops</a></h3>
								<p>Lorem ipsum dolor sit amet, consecter tur adipiscing elit.</p>
								<p><a href="product_details.html">Reat More</a></p>
							  </div>
							</div>
						</div>
						<div class="owl-item os" data-animate="fadeInRight">
							<div class="thumbnail">
							  <img class="img-responsive" src="<?php echo esc_url(get_template_directory_uri());?>/images/pro_img3.jpg" alt="pro_img3">
							  <div class="caption">
								<h3><a data-toggle="modal" data-target=".pro_3" href="#">Eye-care</a></h3>
								<p>Lorem ipsum dolor sit amet, consecter tur adipiscing elit.</p>
								<p><a href="product_details.html">Reat More</a></p>
							  </div>
							</div>
						</div>
						<div class="owl-item">
							<div class="thumbnail">
							  <img class="img-responsive" src="<?php echo esc_url(get_template_directory_uri());?>/images/pro_img4.jpg" alt="pro_img4">
							  <div class="caption">
								<h3><a data-toggle="modal" data-target=".pro_4" href="#">Systane Gel Drops</a></h3>
								<p>Lorem ipsum dolor sit amet, consecter tur adipiscing elit.</p>
								<p><a href="product_details.html">Reat More</a></p>
							  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- Our Products End -->
		<div class="forth_section"><!-- Testimonial Start -->
			<div class="testimonial_mess">
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
							<h2 class="heading_title">Testimonial</h2>
							<div class="line"></div>
						</div>
					</div>
				</div>
				<div class="testimonial_mess_item">
					<div id="testimonial_mess_item" class="carousel slide" data-ride="carousel">
						<div class="container">
							<div class="carousel-inner" role="listbox">
								<div class="item active">
									<div class="row">
										<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 os animated flipInX" data-animate="flipInX">
											<div class="testimonial_item">
												<div class="name">Helen Marcos</div>
												<div class="pos">Secretary</div>
												<div class="desc">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore.</div>
											</div>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="row">
										<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 os animated flipInX" data-animate="flipInX">
											<div class="testimonial_item">
												<div class="name">Helen Marcos</div>
												<div class="pos">Secretary</div>
												<div class="desc">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore.</div>
											</div>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="row">
										<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 os animated flipInX" data-animate="flipInX">
											<div class="testimonial_item">
												<div class="name">Helen Marcos</div>
												<div class="pos">Secretary</div>
												<div class="desc">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore.</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						 <a class="left carousel-control" href="#testimonial_mess_item" role="button" data-slide="prev">
							<span class="fa fa-arrow-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#testimonial_mess_item" role="button" data-slide="next">
							<span class="fa fa-arrow-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
		</div><!--Testimonial End -->
	</section><!--Section End -->
	<footer><!--Start Footer-->
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-6 col-xs-12 os" data-animate="fadeInLeft">
					<div class="footer_item">
						<div class="footer_heading">
							<p>Important links</p>
						</div>
						<ul class="links_item">
							<li><a href="#">Home</a></li>
							<li><a href="#">About Us</a></li>
							<li><a href="#">Service</a></li>
							<li><a href="#">Products</a></li>
							<li><a href="#">Contact Us</a></li>
						</ul>
						</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 os" data-animate="fadeInUp">
					<div class="footer_item">
						<div class="footer_heading">
							<p>Contact Us</p>
						</div>
						<div class="footer_contact">
							<div class="contact-info">
								<ul class="list-unstyled">
									<li>
										<i class="fa fa-location-arrow"></i>
										<span>280 Guelph St., Unit 18, Georgetown, ON  L7G 4B1, Canada</span>
									</li>
									<li>
										<i class="fa fa-phone fa-fw"></i>
										<span class="phone_num"><span><strong> Tel:</strong> +(905) 873-3050</span> <span><strong>Fax:</strong> +(905) 873-2129</span>
									</li>
									<li>
										<a href="info@drjoseph.ca">
										<i class="fa fa-envelope fa-fw"></i>
										<span>info@drjoseph.ca</span>
										</a>
									</li>
									<li>
										<a href="http://www.drjoseph.ca/">
											<i class="fa fa-globe fa-fw"></i>
											<span>http://www.drjoseph.ca/</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 os" data-animate="fadeInRight">
					<div class="footer_item">
						<div class="footer_heading">
							<p>Social link</p>
						</div>
						<div class="social_icon">
							<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="last_footer">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 os" data-animate="fadeInUp">
						<p>Copyright Â© 2015 Doctor Richard Joseph. All Rights Reserved.<a href="#"> Website by Illusive Design Inc. | Web Design and Web Development.</a></p>
					</div>
				</div>
			</div>
			<div class="bottom_to_top">
				<a onclick="jQuery('html,body').animate({scrollTop:0},'slow');return false;" href="#top">
					<i class="fa fa-angle-up"></i>
				</a>
			</div>
		</div>
	</footer><!--End Footer-->
  <?php //get_drjosefh_services();?>
	<?php wp_footer(); ?>	
  </body>
</html>