<?php
/**
 * The sidebar containing the main widget area
 */

if (is_active_sidebar( 'sidebar-right' )  ) : ?>
	<div id="sidebar-left" class="secondary">
		<?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
			<div id="right-widgets-area" class="widget-area sidebar-widgets" role="complementary">
				<?php dynamic_sidebar( 'sidebar-right' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>

	</div><!-- .secondary -->

<?php endif; ?>
