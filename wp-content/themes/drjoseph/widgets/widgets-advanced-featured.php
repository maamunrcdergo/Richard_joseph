<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Advanced_Featured_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        parent::__construct(
                'featured_advanced_widget', __('Featured Advanced Widget', ILLUSIVE_THEME), array('description' => __('A Featured Widget', ILLUSIVE_THEME),)
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
        $image_url = apply_filters('widget_image_url', $instance['image_url']);
        $sub_title = apply_filters('widget_sub_title', $instance['sub_title']);
        $wcontent = apply_filters('widget_wcontent', $instance['wcontent']);
        $more_link = apply_filters('widget_more_link', $instance['more_link']);
        $link_text = apply_filters('widget_link_text', $instance['link_text']);
        $is_video = apply_filters('widget_is_video', $instance['is_video']);
        $extra_class = apply_filters('widget_extra_class', @$instance['extra_class']);
        $show_more_link = apply_filters('widget_show_more_link', $instance['show_more_link']);


        echo $args['before_widget'];
        $is_video_class = !empty($is_video) ? 'advanced_video_widgets' : 'advanced_featured_img';
        echo '<div class="widget-inner row' . $extra_class . ' advanced_featured">';
        if (!empty($image_url)) {
            $img_alt = empty($sub_title) ? $title : $sub_title;
            echo sprintf('<figure class="widget-img %1$s col-xs-12 col-sm-12 col-md-6 pull-right text-center">', $is_video_class);
            if (!empty($is_video)) {
                $video_link = $more_link;
                echo sprintf('<a class="popup-youtube play-view" href="%3$s"><img class="img-responsive" src="%1$s" alt="%2$s" /></a></figure>', $image_url, $sub_title, $video_link);
            } else {
                echo sprintf('<img class="img-responsive" src="%1$s" alt="%2$s" /></figure>', $image_url, $sub_title);
            }
        }   

        echo '<div class="widget-content col-xs-12 col-sm-12 col-md-6 pull-left">';
          if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        if (!empty($more_link) && !empty($sub_title)) {
            echo sprintf('<h3 class="wsub-title"> <a href="%2$s" title="%1$s">%1$s</a></h3>', $sub_title, $more_link);
        } else if (!empty($sub_title)) {
            echo sprintf('<h3 class="wsub-title">%1$s</h3>', $sub_title);
        }
        if (!empty($wcontent)) {
            $wcontent = do_shortcode($wcontent);
            echo sprintf('<div class="widget-exp">%1$s</div>', $wcontent);
        }

        if (!empty($show_more_link) && !empty($link_text) && !empty($more_link)) {
            echo sprintf('<div class="widget-bottom"><a  class="more-links" href="%2$s" title="%1$s">%1$s</a></div>', $link_text, $more_link);
        }
        echo '</div>';
        echo '<hr class="divider"/>';
        echo '</div>';
        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance) {

        $title = !empty($instance['title']) ? $instance['title'] : __('', 'uiu');
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <fieldset class="theme-widgets">
            <legend>Upload Image</legend>
            <?php
            $image_url = !empty($instance['image_url']) ? $instance['image_url'] : '';
            $image_url_field_id = $this->get_field_id('image_url');
            ?>
            <div class="theme-media-box">                   
                <input type="hidden" name="<?php echo $this->get_field_name('image_url'); ?>" value="<?php echo $image_url; ?>" id="<?php echo $image_url_field_id; ?>" class="image_url"/>
                <?php if (!empty($image_url)): ?>                                   
                    <button id="<?php echo $image_url_field_id ?>-upload"  type="button" class="media-close" onclick="THEME_WIDGETS.removeMedia(this)"><span class="dashicons dashicons-no"><span class="screen-reader-text">Close media panel</span></span></button>
                <?php endif; ?>      
                <div class="mcontent">

                    <?php
                    if (!empty($image_url)) {
                        printf('<img src="%1$s" alt="Media Image" class="media-box-img"/>', $image_url);
                    }
                    ?>

                </div>
                <div class="mfooter">

                    <button id="<?php echo $image_url_field_id ?>-upload"  type="button" class="btn-media btn-media-upload <?php
                    if (!empty($image_url)) {
                        echo 'hidden';
                    }
                    ?> " onclick="THEME_WIDGETS.uploadMidea(this)">Upload</button>

                </div>
            </div>
        </fieldset>
        <?php $sub_title = !empty($instance['sub_title']) ? $instance['sub_title'] : __('', 'uiu'); ?>
        <p>            
            <label for="<?php echo $this->get_field_id('sub_title'); ?>"><?php _e('Inner Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('sub_title'); ?>" name="<?php echo $this->get_field_name('sub_title'); ?>" type="text" value="<?php echo esc_attr($sub_title); ?>">
        </p>
        <?php $wcontent = !empty($instance['wcontent']) ? $instance['wcontent'] : __('', 'uiu'); ?>
        <p>            
            <label for="<?php echo $this->get_field_id('wcontent'); ?>"><?php _e('Content:'); ?></label> 
            <?php
            $editor_id = $this->get_field_id('wcontent');
            $editor_name = $this->get_field_name('wcontent');
            //wp_editor($wcontent, $editor_id, array('textarea_name' => $editor_name, 'textarea_rows' => 5, 'teeny' => true));            
            ?>  
            <textarea class="widefat" rows="8" name="<?php echo $editor_name; ?>" id="<?php echo $editor_id; ?>"><?php echo $wcontent; ?></textarea>
        </p>
        <?php $more_link = !empty($instance['more_link']) ? $instance['more_link'] : __('', 'uiu'); ?>
        <p>            
            <label for="<?php echo $this->get_field_id('more_link'); ?>"><?php _e('Link To:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('more_link'); ?>" name="<?php echo $this->get_field_name('more_link'); ?>" type="text" value="<?php echo esc_attr($more_link); ?>">
        </p>

        <?php $is_video = !empty($instance['is_video']) ? '1' : '0'; ?>
        <p>            
            <label for="<?php echo $this->get_field_id('link_text'); ?>"><?php _e('Is Video:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('is_video'); ?>" name="<?php echo $this->get_field_name('is_video'); ?>" type="checkbox" value="1" <?php if (!empty($is_video)): ?> checked=""<?php endif; ?>></label> 

        </p>
        <?php $show_more_link = !empty($instance['show_more_link']) ? '1' : '0'; ?>
        <p>            
            <label for="<?php echo $this->get_field_id('show_more_link'); ?>"><?php _e('Show More button:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('show_more_link'); ?>" name="<?php echo $this->get_field_name('show_more_link'); ?>" type="checkbox" value="1" <?php if (!empty($show_more_link)): ?> checked=""<?php endif; ?>></label> 

        </p>
        <?php $link_text = !empty($instance['link_text']) ? $instance['link_text'] : __('', 'uiu'); ?>
        <p>            
            <label for="<?php echo $this->get_field_id('link_text'); ?>"><?php _e('Link Text:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('link_text'); ?>" name="<?php echo $this->get_field_name('link_text'); ?>" type="text" value="<?php echo esc_attr($link_text); ?>" placeholder="Read More">
        </p>
        <?php $extra_class = !empty($instance['extra_class']) ? $instance['extra_class'] : __('', 'uiu'); ?>
        <p>            
            <label for="<?php echo $this->get_field_id('link_text'); ?>"><?php _e('Extra Class:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('extra_class'); ?>" name="<?php echo $this->get_field_name('extra_class'); ?>" type="text" value="<?php echo esc_attr($extra_class); ?>" placeholder="Class Name">
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
        $instance['image_url'] = (!empty($new_instance['image_url']) ) ? strip_tags($new_instance['image_url']) : '';
        $instance['sub_title'] = (!empty($new_instance['sub_title']) ) ? strip_tags($new_instance['sub_title']) : '';
        $instance['wcontent'] = (!empty($new_instance['wcontent']) ) ? strip_tags($new_instance['wcontent'], '<p><br><br><a><ul><li><ol><strong><b>') : '';
        $instance['more_link'] = (!empty($new_instance['more_link']) ) ? strip_tags($new_instance['more_link']) : '';
        $instance['link_text'] = (!empty($new_instance['link_text']) ) ? strip_tags($new_instance['link_text']) : '';
        $instance['is_video'] = (!empty($new_instance['is_video']) ) ? '1' : '0';
        $instance['show_more_link'] = (!empty($new_instance['show_more_link']) ) ? '1' : '0';
        $instance['extra_class'] = (!empty($new_instance['extra_class']) ) ? strip_tags($new_instance['extra_class']) : '';

        return $instance;
    }

}
