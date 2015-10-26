<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UIU_AJX_LOGIN_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        parent::__construct(
                'theme_ajax_login_widget', __('Ajax Login Widget', 'bits'), array('description' => __('A Login Widget', 'uiu'),)
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
        echo '<div class="event-widget">';

        if (is_user_logged_in()) {
            if (!empty($instance['title'])) {
                echo $args['before_title'] . __('Profile Links') . $args['after_title'];
            }
            $user_ID = get_current_user_id();
            $profile_id = get_user_meta($user_ID, 'uiu_profile', TRUE);
            $profile_link = !empty($profile_id) ? get_permalink($profile_id) : get_dashboard_url($user_ID);
            ?>
            <ul class="menu user-menu">
                <li class="menu-item"><a href="<?php echo $profile_link; ?>">My Profile</a>  </li>               
                <li class="menu-item"><a href="<?php echo wp_logout_url(site_url()); ?>">Logout</a>  </li>

            </ul>
            <?php
        } else {
            if (!empty($instance['title'])) {
                echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
            }
            wp_login_form($args);
        }
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
