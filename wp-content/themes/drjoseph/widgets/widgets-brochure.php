<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Illusive_Brochure_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        parent::__construct(
                'theme_brochure_widget', __('Theme Brochure Widget', 'bits'), array('description' => __('A Brochure Widget', 'uiu'),)
        );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance) {
        
       
        $visibility_count = apply_filters('widget_visibility_count', $instance['visibility_count']);
        //$scrollbar = apply_filters('widget_scrollbar', $instance['scrollbar']);
        echo $args['before_widget'];
        echo '<div class="event-widget">';
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        
        
        
        
        
        $brochures = get_posts(array('post_type' => 'brochure', 'posts_per_page' => $visibility_count));
        
        $brochureHtml = '<div class="content events ">';
        foreach ($brochures as $brochure) {
            
            $file_paths = get_field('brochure_file',$brochure->ID);            
            $url = $file_paths[url];
            
            
            
            $title = wp_trim_words($brochure->post_title, 10, '...');
            $pcontent = wp_trim_words($brochure->post_content, 25, '...'); 
            $brochureHtml .= '<div class="events-list">';
            
            
            $brochureHtml .= sprintf('<h3  title="%1$s" class="events-list-title">%1$s</h3>', $title);
            $brochureHtml .= sprintf('<div class="brochure-excerpt"><p class="events-list-excerpt">%1$s</p></div>', $pcontent);
            $brochureHtml .= sprintf('<div class="brochure-bottom"><a class="dwn-link" href="%1$s" >Download</a></div>', $url);
            $brochureHtml .= '</div>';
        }
        $brochureHtml .= '</div>';
        echo $brochureHtml;
        
               
        echo '</div>';
        echo $args['after_widget'];
        
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance) {  
        
        ?>
 
        <?php
        $visibility_count = !empty($instance['visibility_count']) ? $instance['visibility_count'] : 3;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('visibility_count'); ?>"><?php _e('Visibility count:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('visibility_count'); ?>" name="<?php echo $this->get_field_name('visibility_count'); ?>" type="text" value="<?php echo esc_attr($visibility_count); ?>" size="5">
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
        $instance['more_link'] = (!empty($new_instance['more_link']) ) ? strip_tags($new_instance['more_link']) : '';
        $instance['visibility_count'] = (!empty($new_instance['visibility_count']) ) ? strip_tags($new_instance['visibility_count']) : '';
        $instance['scrollbar'] = (!empty($new_instance['scrollbar']) ) ? 1 : 0;
        return $instance;
    }

}
