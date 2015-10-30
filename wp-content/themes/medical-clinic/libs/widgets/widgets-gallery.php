<?php
/*
 * Illusive Design.ca
 * Wordpress Theme | Contractor
 * Version: 1.2
 */

class Gallery_Popup_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        parent::__construct(
                'gallery-popups', __('Gallery Popup Widget'), array('description' => __('Gallery Popup Widget'),)
        );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        $imgWidth = apply_filters('widget_img_width', $instance['img_width']);
        $imgHight = apply_filters('widget_img_height', $instance['img_height']);
        $gallery_images = apply_filters('gallery_images', $instance['gallery_images']);
        $gallery_images = !empty($gallery_images) ? maybe_unserialize($gallery_images) : false;
        echo $args['before_widget'];

        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        if (!empty($gallery_images)) {
            $carousel = '<div class="gallery-popup-wrap">';
            $carousel .= sprintf('<div id="gallery-%s" class="popup-gallery">', $args['widget_id']);
            foreach ($gallery_images as $attachment_id) {
                $image = wp_get_attachment_image_src($attachment_id, 'full');
                
                $thumb_url = wp_get_attachment_image_src($attachment_id,array($imgWidth,$imgHight));
                $carousel .= sprintf('<div class="gallery-item"><a href="%1$s" class="thumbnail os fadeIn"><img src="%2$s" alt="gallery-image" width="%3$s" height="%4$s" alt="Gallery Image"></a></div>', $image[0], $thumb_url[0], $imgWidth, $imgHight);
            }
            $carousel .= '</div>';
            $carousel .= '</div>';
            $nav = ($carousel_nav == 'yes') ? 'true' : 'false';
            $dot = ($carousel_dot == 'yes') ? 'true' : 'false';
            $autoplay = ($carousel_autoplay == 'yes') ? 'true' : 'false';
            $item = !empty($image_display) ? $image_display : 1;
            echo $carousel;
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    if (typeof jQuery.fn.magnificPopup !== 'undefined') {
                        jQuery('.popup-gallery').magnificPopup({
                            type: 'image',
                            delegate: 'a',
                            gallery: {
                                enabled: true
                            }
                        });
                    }
                   // console.log(typeof jQuery.fn.magnificPopup);
                });
            </script>
            <?php
        }
        echo '<div class="clearfix"></div>';
        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance) {

        $title = !empty($instance['title']) ? $instance['title'] : __('');
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php $gallery_images = !empty($instance['gallery_images']) ? maybe_unserialize($instance['gallery_images']) : 0;
        ?>
        <div id="gallery-<?php echo $this->get_field_id('gallery_images'); ?>" class="gallery-carosal-wrap">    


            <div id="<?php echo $this->id ?>-gcontainer" class="cgallery">
                <?php
                if (!empty($gallery_images)) {
                    $fname = $this->get_field_name('gallery_images');
                    foreach ($gallery_images as $attachment_id) {
                        printf('<input type="hidden" id="ginput-%1$s-%2$s" name="%3$s[%2$s]" value="%2$s"/>', $this->id, $attachment_id, $fname);
                        $attachment_img = wp_get_attachment_image_src($attachment_id, 'thumbnail');

                        printf('<div id="gbox-%1$s-%2$s" class="gthumb"><span class="dashicons dashicons-no-alt gimg-remove" onclick="THEME_WIDGETS.removegalleryImage(\'%1$s-%2$s\')"></span><img src="%3$s"></div>', $this->id, $attachment_id, $attachment_img[0]);
                    }
                }
                ?>
            </div>
            <a href="#" class="button" onclick="THEME_WIDGETS.galleryImage(this, '<?php echo $this->get_field_name('gallery_images'); ?>', '<?php echo $this->id; ?>')">Select Images</a>


        </div> 
        <?php
        $img_width = !empty($instance['img_width']) ? $instance['img_width'] : '150px';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('img_width'); ?>"><?php _e('Image Width:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('img_width'); ?>" name="<?php echo $this->get_field_name('img_width'); ?>" type="text" value="<?php echo esc_attr($img_width); ?>">
        </p>
        <?php
        $img_height = !empty($instance['img_height']) ? $instance['img_height'] : '150px';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('img_width'); ?>"><?php _e('Image height:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('img_height'); ?>" name="<?php echo $this->get_field_name('img_height'); ?>" type="text" value="<?php echo esc_attr($img_height); ?>">
        </p>
        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update($new_instance, $old_instance) {
        $instance = array();

        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';

        $instance['gallery_images'] = (!empty($new_instance['gallery_images']) ) ? $new_instance['gallery_images'] : '';
        $instance['img_width'] = (!empty($new_instance['img_width']) ) ? $new_instance['img_width'] : '150px';
        $instance['img_height'] = (!empty($new_instance['img_height']) ) ? $new_instance['img_height'] : '150px';


        return $instance;
    }

}
