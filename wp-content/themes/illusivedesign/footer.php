<?php
/*
 * @package WP-@IllusiveDesign
 * @subpackage RideFlag
 * @since RideFlag 1.0
 * 2015(c) IllusiveDesign
 */
global $illusive_redux;
?>
<section id="footer-widget" class="site-footer">
    <div class="<?php illusive_layout('footer-content'); ?>">
        <?php if (!empty($illusive_redux['show_footer_nav'])): ?>
            <div class="row">
                <div class="col-xs-12 footer-menu">
                    <?php wp_nav_menu(array('theme_location' => 'footer-nav', 'menu_class' => 'nav navbar-nav', 'menu_id' => '', 'container_class' => 'footer-menu-container')); ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="footer-widget-area">
                <?php if (is_active_sidebar('footer-widget-1')) : ?>
                    <div class="col-sm-6 col-md-4 footer-widget-1" role="complementary">
                        <?php dynamic_sidebar('footer-widget-1'); ?>
                    </div><!-- .widget-area .first -->
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-widget-2')) : ?>
                    <div class="col-sm-6 col-md-4 footer-widget-2" role="complementary">
                        <?php dynamic_sidebar('footer-widget-2'); ?>
                    </div><!-- .widget-area .second -->
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-widget-3')) : ?>
                    <div class="col-sm-6 col-md-4 footer-widget-3" role="complementary">
                        <?php dynamic_sidebar('footer-widget-3'); ?>
                    </div><!-- .widget-area .third -->
                <?php endif; ?>
            </div>

        </div>
        

    </div>
</section>
<footer id="footer" class="footer-bottom">
    <div class="<?php illusive_layout('footer-content'); ?>">
        <div class="row">
            <div class="col-xs-12 copyright">
                <?php echo wpautop($illusive_redux['site_copyright']); ?>
            </div>
        </div>
    </div>
</footer>
</div>
<?php wp_footer() ?>     
<div id="introLoading" class="introLoading"></div>
</body>
</html>