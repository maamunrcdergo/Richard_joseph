<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Illusive_Social_Share_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        parent::__construct(
                'theme_social_share_widget', __('Theme Social Share Widget', 'illusivedesign'), array('description' => __('A Blog Widget', 'illusivedesign'),)
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

        echo $args['before_widget'];
        echo '<div class="share-widget">';

        

        $shareHtml = '<div class="content share-list">';
        
            
           
            
            
             
            $shareHtml .= '<div class="share">';
            
            
            $shareHtml .= sprintf('<span class="st_fblike_hcount" displayText="Facebook Like"></span>');
            $shareHtml .= sprintf('<span class="st_plusone_hcount" displayText="Google +1"></span>');


            
            $shareHtml .= '</div>';
        $shareHtml .= '</div >';
        $shareHtml .= sprintf('<script type="text/javascript">stLight.options({publisher: "8ab77e9e-0b44-4147-a830-b9cd8f2c0568", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>');
        echo $shareHtml;
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
