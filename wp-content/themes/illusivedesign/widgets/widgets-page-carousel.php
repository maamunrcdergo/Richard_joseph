<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Page_Carousel_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        parent::__construct(
                'theme_pages_item_carousel_widget', __('Page Carousel  Widget', 'bits'), array('description' => __('Page Carousel  Widget', 'uiu'),)
        );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance) {

        echo $args['before_widget'];
        echo '<div class="carousel-widget-inner">';
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        $post_type = apply_filters('widget_post_type', $instance['post_type']);
        $post_parent = apply_filters('widget_post_parent', $instance['post_parent']);
        $carousel_auto_play = apply_filters('widget_carousel_auto_play', $instance['carousel_auto_play']);
        $carousel_nav = apply_filters('widget_carousel_nav', $instance['carousel_nav']);
        $carousel_pagging = apply_filters('widget_carousel_pagging', $instance['carousel_pagging']);
         $carousel_nav = empty($carousel_nav)? 'false':'true';
         $carousel_pagging = empty($carousel_pagging)? 'false':'true';
         $carousel_auto_play = empty($carousel_auto_play)? 'false':'true';
        $slider_query = array(
            'post_type' => $post_type,
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'post_parent' => $post_parent,
        );
        if ($post_type !== 'page') {
            $slider_query['orderby'] = array('meta_value_num' => 'ASC', 'ID' => 'DESC', 'title' => 'ASC');
            $slider_query['meta_key'] = 'custom_order';
        }
        $slider_query = apply_filters('theme_pages_item_carousel_query', $slider_query);
        $sliders = get_posts($slider_query);
       
        if (!empty($sliders) && sizeof($sliders) > 1) {
            
            $carousel_id = $args['widget_id'].'-carousel';
            $sliderHtml = sprintf('<div id="%s" class="owl-carousel page-slider">',$carousel_id);
            foreach ($sliders as $slide) {
                $attachment_id = get_post_thumbnail_id($slide->ID);
                $client_name = get_field('client_name',$slide->ID);
                $designition = get_field('designition',$slide->ID);
                $company_name = get_field('company_name',$slide->ID);
                $featured_image = wp_get_attachment_url($attachment_id);                
                $elink = get_field('external_link',$slide->ID);
                $link = empty($elink)? get_permalink($slide->ID):$elink;
                $sliderHtml .= '<div class="owl-item slide-item ">';               
                $sliderHtml .= '<div class="inner-row slider-inner">';                
                $sliderHtml .= '<div class="featured-image">';
                $sliderHtml .= sprintf('<img class="slider-img img-full-width img-responsive" src="%2$s" alt="%1$s" />', $slide->post_title, $featured_image);
                $sliderHtml .= '</div><!--/.featured-image-->';
                
                $sliderHtml .= '<div class="featured-content">';
                $sliderHtml .= sprintf('<h3 class="featured-title"><a href="%2$s" title="%1s$">%1$s</a></h3>', $slide->post_title, $link);
                $pcontent = wpautop($slide->post_excerpt); 
                $sliderHtml .= sprintf('<div class="excerpt">%1$s</div>',$pcontent);
                $sliderHtml .= '</div><!--/.featured-content-->';
                $sliderHtml .= sprintf('<p class="client-name">-%1$s</p>',$client_name);
                $sliderHtml .= sprintf('<p class="client-content">%1$s, %2$s</h3>',$designition,$company_name);
                $sliderHtml .= '</div><!--/.inner-row-->';               
                $sliderHtml .= '</div><!--/.slide-item-->';
            }
            $sliderHtml .= '</div>';
            $sliderHtml .= sprintf('<script type="text/javascript">jQuery(document).ready(function(){imagesLoaded("#%1$s", function () {jQuery("#%1$s").owlCarousel({nav: %2$s,navClass: ["owl-prev", "owl-next"],navText: ["<i class=\"fa fa-angle-left\"></i>", "<i class=\"fa fa-angle-right\"></i>"],items: 1,autoplay: %3$s,dots: %4$s,loop:true,});});});</script>',$carousel_id,$carousel_nav,$carousel_auto_play,$carousel_pagging);
            echo $sliderHtml;
        }
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
        <?php
        $post_type = !empty($instance['post_type']) ? $instance['post_type'] : 'page';
        $post_types = get_post_types(array('public' => TRUE, 'hierarchical' => TRUE));
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type:'); ?></label> 
            <select  data-target="#<?php echo $this->get_field_id('post_parent'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>" id="<?php echo $this->get_field_id('post_type'); ?>" onchange="THEME_WIDGETS.getPost(this)">
        <?php
        //$post_types = get_post_types( array('public'=>TRUE,'hierarchical'=>TRUE));
        foreach ($post_types as $key => $type) {
            if ($type == $post_type) {
                echo sprintf('<option value="%1$s" selected>%1$s</option>', $key, ucwords($type));
            } else {
                echo sprintf('<option value="%1$s">%1$s</option>', $key, ucwords($type));
            }
        }
        ?>              
            </select>
        </p>
                <?php
                $post_parent = !empty($instance['post_parent']) ? $instance['post_parent'] : 0;
                $post_parents = get_theme_widgets_posts($post_type);
                ?>
        <p>
            <label for="<?php echo $this->get_field_id('post_parent'); ?>"><?php _e('Post Parent:'); ?></label> 
            <select name="<?php echo $this->get_field_name('post_parent'); ?>" id="<?php echo $this->get_field_id('post_parent'); ?>">
        <?php
        foreach ($post_parents as $post) {
            if ($post->ID == $post_parent) {
                echo sprintf('<option value="%1$s" selected>%2$s</option>', $post->ID, $post->post_title);
            } else {
                echo sprintf('<option value="%1$s">%2$s</option>', $post->ID, $post->post_title);
            }
        }
        ?>
            </select>
        </p>      
        <fieldset class="theme-widgets">
            <legend>Slider Settings</legend>
        <?php $autoplay = !empty($instance['carousel_auto_play']) ? 1 : 0; ?>
            <p>
                <label for="<?php echo $this->get_field_id('carousel_auto_play'); ?>"><?php _e('Auto Play:'); ?> <input name="<?php echo $this->get_field_name('carousel_auto_play'); ?>" id="<?php echo $this->get_field_id('carousel_auto_play'); ?>" type="checkbox" value="1" <?php if ($autoplay) {
            echo 'checked=""';
        } ?>/></label> 
            </p>
            <?php $nav = !empty($instance['carousel_nav']) ? 1 : 0; ?>
            <p>
                <label for="<?php echo $this->get_field_id('carousel_nav'); ?>"><?php _e('Navigation:'); ?> <input name="<?php echo $this->get_field_name('carousel_nav'); ?>" id="<?php echo $this->get_field_id('carousel_nav'); ?>" type="checkbox" value="1" <?php if ($nav) {
                echo 'checked=""';
            } ?>/></label> 
            </p>
        <?php $pagging = !empty($instance['carousel_pagging']) ? 1 : 0; ?>
            <p>
                <label for="<?php echo $this->get_field_id('carousel_pagging'); ?>"><?php _e('Pagging:'); ?> <input name="<?php echo $this->get_field_name('carousel_pagging'); ?>" id="<?php echo $this->get_field_id('carousel_pagging'); ?>" type="checkbox" value="1" <?php if ($pagging) {
            echo 'checked=""';
        } ?>/></label> 
            </p>
        </fieldset>
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
        $instance['post_type'] = (!empty($new_instance['post_type']) ) ? strip_tags($new_instance['post_type']) : '';
        $instance['post_parent'] = (!empty($new_instance['post_parent']) ) ? strip_tags($new_instance['post_parent']) : '';
        $instance['carousel_auto_play'] = (!empty($new_instance['carousel_auto_play']) ) ? strip_tags($new_instance['carousel_auto_play']) : '';
        $instance['carousel_nav'] = (!empty($new_instance['carousel_nav']) ) ? strip_tags($new_instance['carousel_nav']) : '';
        $instance['carousel_pagging'] = (!empty($new_instance['carousel_pagging']) ) ? strip_tags($new_instance['carousel_pagging']) : '';
        return $instance;
    }

}
