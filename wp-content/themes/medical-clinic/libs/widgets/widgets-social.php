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
                'theme_social_widget', __('Theme Social Widget', 'mclinic'), array('description' => __('A Social Widget', 'mclinic'),)
        );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance) {
        global $mclinic_options;
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        $services = array('facebook', 'twitter', 'google-plus', 'youtube', 'linkedin', 'pinterest', 'rss', 'tumblr', 'flickr', 'instagram', 'dribbble', 'skype', 'github', 'slideshare', 'vk');

        echo '<div class="theme_social"><ul  class="social">';
        $prefix = $mclinic_options['social_icons_prefix'];
        if(!empty($prefix)){
             echo '<li class="inner-dsc"><span class="sr">'.$prefix.'</span></li>';
        }
        
        foreach ($services as $service) :
            $active[$service] = $mclinic_options['social_'.$service];       
            if (!empty($active[$service])) {
               echo '<li><a href="' . $active[$service] . '" target="_BLANK" class="social-icon ' . $service . '" title="' . __('Follow us on ', 'mclinic') . $service . '"><i class="fa fa-' . $service . '"></i></a></li>';
              
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
       
        $title = !empty($instance['title']) ? $instance['title'] : __('', 'mclinic');
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
