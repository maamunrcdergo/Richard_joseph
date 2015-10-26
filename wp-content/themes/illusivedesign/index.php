<?php
/*
 * @package WP-@IllusiveDesign
 * @subpackage RideFlag
 * @since RideFlag 1.0
 * 2015(c) IllusiveDesign
 */
global $illusive_redux;
get_header();
?>
<section id="main" class="site-content">
    <div class="<?php illusive_layout('main-content'); ?>">
        <?php
        $dir = new DirectoryIterator(dirname(__FILE__));
foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        var_dump($fileinfo->getFilename());
    }
}
        ?>
    </div>
</section>
<?php get_footer();?>