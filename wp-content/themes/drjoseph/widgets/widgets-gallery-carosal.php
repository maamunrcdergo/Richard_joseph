<?php
/*
 * Illusive Design.ca
 * Wordpress Theme | Contractor
 * Version: 1.2
 */

class Gallery_Carousel_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        parent::__construct(
                'gallery-carousel', __('Gallery Carousel Widget'), array('description' => __('Gallery Carousel Widget'),)
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
        $gallery_images = apply_filters('gallery_images', $instance['gallery_images']); 
        $image_display = apply_filters('widget_image_display', $instance['image_display']);
        $carousel_nav = apply_filters('widget_carousel_nav', $instance['carousel_nav']);
        $carousel_dot = apply_filters('widget_carousel_dot', $instance['carousel_dot']);
        $carousel_autoplay = apply_filters('widget_carousel_autoplay', $instance['carousel_autoplay']);
        $gallery_images = !empty($gallery_images)? maybe_unserialize($gallery_images):false;
        //wpprint($args);
        echo $args['before_widget'];

        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
       
        if (!empty($gallery_images)) {
            $carousel = '<div class="gallery-carousel-wrap">';
            $carousel .= sprintf('<div id="owl-%s" class="owl-carousel">', $args['widget_id']);
            foreach ($gallery_images as $attachment_id) {
                $image = wp_get_attachment_image_src($attachment_id, 'full');             
                $carousel .= sprintf('<div class="gallery-item"><img src="%s" alt="gallery-image"></div>',$image[0]);               
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
                    jQuery("#owl-<?php echo $args['widget_id']; ?>").owlCarousel({
                        nav: <?php echo $nav; ?>,
                        navClass: ["owl-prev", "owl-next"],
                        navText: ["<i class=\"fa fa-angle-left\"></i>", "<i class=\"fa fa-angle-right\"></i>"],
                        items: <?php echo $item; ?>,
                        autoplay: <?php echo $autoplay; ?>,
                        dots: <?php echo $dot; ?>,
                        animateOut: 'fadeOut',
                        animateIn: 'fadeIn',
                        themeClass: 'protfolio-carousel',
                        responsive: {
                            0: {
                                items: 1,
                                nav: false,
                                margin:10,
                            },
                            480: {
                                items: 2,
                                nav: false,
                                margin:10,
                            },
                            768: {
                                items: <?php echo $item; ?>,
                                nav: false
                            },
                            992: {
                                items: <?php echo $item; ?>,
                                nav: true,                               
                            }
                        }
                    });
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
        <?php $gallery_images = !empty($instance['gallery_images'])? maybe_unserialize($instance['gallery_images']):0;
 
        ?>
        <div id="gallery-<?php echo $this->get_field_id('gallery_images'); ?>" class="gallery-carosal-wrap">    
            

            <div id="<?php echo $this->id ?>-gcontainer" class="cgallery">
                         <?php if(!empty($gallery_images)){
                     $fname = $this->get_field_name('gallery_images');
                     foreach($gallery_images as $attachment_id){
                        printf('<input type="hidden" id="ginput-%1$s-%2$s" name="%3$s[%2$s]" value="%2$s"/>',$this->id,$attachment_id,$fname);
                        $attachment_img = wp_get_attachment_image_src($attachment_id,'thumbnail');
                       
                        printf('<div id="gbox-%1$s-%2$s" class="gthumb"><span class="dashicons dashicons-no-alt gimg-remove" onclick="THEME_WIDGETS.removegalleryImage(\'%1$s-%2$s\')"></span><img src="%3$s"></div>',$this->id,$attachment_id,$attachment_img[0]);
                        
                     }
                    
             }?>
            </div>
            <a href="#" class="button" onclick="THEME_WIDGETS.galleryImage(this,'<?php echo $this->get_field_name('gallery_images'); ?>','<?php echo $this->id; ?>')">Select Images</a>

           
        </div> 
        <?php
        $image_display = !empty($instance['image_display']) ? $instance['image_display'] : 1;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('image_display'); ?>"><?php _e('Display #:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('image_display'); ?>" name="<?php echo $this->get_field_name('image_display'); ?>" type="text" value="<?php echo $image_display;?>">
        </p>
        <?php
        $carousel_nav = !empty($instance['carousel_nav']) ? $instance['carousel_nav'] : 'yes';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('carousel_nav'); ?>"><?php _e('Show Nav :'); ?></label> 
            <select name="<?php echo $this->get_field_name('carousel_nav'); ?>" id="<?php echo $this->get_field_id('carousel_nav'); ?>" class="widefat">
                <option value="yes" <?php selected($carousel_nav, 'yes') ?>>Yes</option>
                <option value="no" <?php selected($carousel_nav, 'no') ?>>No</option>
            </select>
        </p>
        <?php
        $carousel_dot = !empty($instance['carousel_dot']) ? $instance['carousel_dot'] : 'yes';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('carousel_dot'); ?>"><?php _e('Show Dot :'); ?></label> 
            <select name="<?php echo $this->get_field_name('carousel_dot'); ?>" id="<?php echo $this->get_field_id('carousel_dot'); ?>" class="widefat">
                <option value="yes" <?php selected($carousel_dot, 'yes') ?>>Yes</option>
                <option value="no" <?php selected($carousel_dot, 'no') ?>>No</option>
            </select>
        </p>
        <?php
        $carousel_autoplay = !empty($instance['carousel_autoplay']) ? $instance['carousel_autoplay'] : 'yes';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('carousel_autoplay'); ?>"><?php _e('Autoplay:'); ?></label> 
            <select name="<?php echo $this->get_field_name('carousel_autoplay'); ?>" id="<?php echo $this->get_field_id('carousel_autoplay'); ?>" class="widefat">
                <option value="yes" <?php selected('yes', $carousel_autoplay) ?>>Yes</option>
                <option value="no" <?php selected('no', $carousel_autoplay) ?>>No</option>
            </select>
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
        
        $instance['gallery_images'] = (!empty($new_instance['gallery_images']) ) ? maybe_serialize($new_instance['gallery_images']) : '';
        
        $instance['image_display'] = (!empty($new_instance['image_display']) ) ? intval($new_instance['image_display']) : 1;
        $instance['carousel_nav'] = (!empty($new_instance['carousel_nav']) ) ? $new_instance['carousel_nav'] : 'yes';
        $instance['carousel_dot'] = (!empty($new_instance['carousel_dot']) ) ? $new_instance['carousel_dot'] : 'yes';
        $instance['carousel_autoplay'] = (!empty($new_instance['carousel_autoplay']) ) ? $new_instance['carousel_autoplay'] : 'yes';
       
        return $instance;
    }

}
