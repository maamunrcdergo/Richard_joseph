<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Theme_Social_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        parent::__construct(
                'theme_social_widget', __('Theme Social Widget', 'uiu'), array('description' => __('A Social Widget', 'uiu'),)
        );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance) {
        global $illusive_redux; 
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        $services = array('facebook', 'twitter', 'google-plus', 'youtube', 'linkedin', 'pinterest', 'rss', 'tumblr', 'flickr', 'instagram', 'dribbble', 'skype', 'github', 'slideshare', 'vk');

        echo '<div class="uiu_social"><ul  class="social">';
//        $prefix = of_get_option('social_icons_prefix');
//        if(!empty($prefix)){
//             echo '<li><span class="sr">'.$prefix.'</span></li>';
//        }
        
        foreach ($services as $service) :
            $active[$service] = $illusive_redux[('social_' . $service)];  
            if (!empty($active[$service])) {
               echo '<li><a href="' . $active[$service] . '" class="social-icon ' . $service . '" title="' . __('Follow us on ', 'uiu') . $service . '"><i class="fa fa-' . $service . '"></i></a></li>';
              
            }
        endforeach;
        echo '</ul></div>';
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
        return $instance;
    }

}
