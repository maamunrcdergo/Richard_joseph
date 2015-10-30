<?php global $mclinic_options;?>
<footer id="site-footer"><!--Start Footer-->
<?php get_sidebar('footer')?>
		<div class="last_footer">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 os" data-animate="fadeInUp">
						<?php echo wpautop($mclinic_options['site_copyright']);?>
					</div>
				</div>
			</div>
			<div class="bottom_to_top">
        <a class="backtoTop" href="#top">
					<i class="fa fa-angle-up"></i>
				</a>
			</div>
		</div>
	</footer><!--End Footer-->
    </div>     
    <?php wp_footer(); ?>	
     <?php wp_nav_menu(array('theme_location' => 'mobile-nav', 'menu_class' => 'mm-nav', 'menu_id' => '', 'container_id' => 'mobilemenu-container','container_class' => 'mm-menu mm-offcanvas')); ?>
  </body>
</html>
