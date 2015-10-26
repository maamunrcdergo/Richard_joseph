<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UIU_Events_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        parent::__construct(
                'theme_events_widget', __('Theme Events Widget', 'bits'), array('description' => __('A Events Widget', 'uiu'),)
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
        $more_link = apply_filters('widget_more_link', $instance['more_link']);
        $visibility_count = apply_filters('widget_visibility_count', $instance['visibility_count']);
        $scrollbar = apply_filters('widget_scrollbar', $instance['scrollbar']);
        echo $args['before_widget'];
        echo '<div class="event-widget">';
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        
        $events_per_page = empty($scrollbar) ? $visibility_count:20;
        $events = get_posts(array('post_type' => 'event', 'posts_per_page' => $events_per_page));
        $hasScroll = !empty($scrollbar) ? 'hasScroll':'';
        $eventHtml = '<div class="content events '.$hasScroll.'">';
        foreach ($events as $event) {
            $attachment_id = get_post_thumbnail_id($event->ID);
            $featured_image = wp_get_attachment_url($attachment_id);
            //$featured_image = get_the_post_thumbnail($event->ID,array(64,64),array('class'=>'events-list-img'));
            $featured_image = empty($attachment_id)  ? get_stylesheet_directory_uri().'/images/default-event.png': $featured_image;   
            $link = get_permalink($event->ID);
            $title = wp_trim_words($event->post_title, 10, '...');
            $event_start_date = get_field('event_start_date_time',$event->ID);           
            $event_s_d = date('M d, Y', strtotime($event_start_date));
            $event_s_d_2 = date('Y-m-d', strtotime($event_start_date));
            $event_s_d_1 = date_create($event_s_d_2);
            $event_end_date = get_field('event_end_date_time',$event->ID);
            $event_e_d = date('M d, Y', strtotime($event_end_date));
            $event_e_d_2 = date('Y-m-d', strtotime($event_end_date));
            $event_e_d_1 = date_create($event_e_d_2);
            $event_date_diff = date_diff($event_e_d_1, $event_s_d_1);
            $event_date_diff_for =$event_date_diff->format("%R%a");
            $pcontent = wp_trim_words($event->post_content, 8, '...'); 
            $eventHtml .= '<div class="events-list">';
            $eventHtml .= sprintf('<img class="events-list-img" src="%2$s" alt="%1$s" />', $event->post_title, $featured_image);
            if($event_date_diff_for == "+0"){
                 $eventHtml .= sprintf('<p class="events-date">%1$s</p>', $event_s_d);
            }else{
                $eventHtml .= sprintf('<p class="events-date">%1$s - %2$s</p>', $event_s_d, $event_e_d);
            }
            $eventHtml .= sprintf('<a href="%2$s" title="%1$s" class="events-list-title">%1$s</a>', $title, $link);
            $eventHtml .= sprintf('<p class="events-list-excerpt">%1$s</p>', $pcontent);
            $eventHtml .= sprintf('<a class="link-box" href="%2$s" title="%1$s" class="events-list-title"></a>', $title, $link);
            $eventHtml .= '</div>';
        }
        $eventHtml .= '</div>';
        echo $eventHtml;
        if(!empty($more_link)){
             echo wp_sprintf('<div class="event-wfooter more-links"><a class="readmore" href="%s" title="More Events">More Events</a></div>',$more_link);
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
        $more_link = !empty($instance['more_link']) ? $instance['more_link'] :  get_post_type_archive_link( 'event' );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('more_link'); ?>"><?php _e('More Link:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('more_link'); ?>" name="<?php echo $this->get_field_name('more_link'); ?>" type="text" value="<?php echo esc_attr($more_link); ?>">
        </p>
        <?php
        $visibility_count = !empty($instance['visibility_count']) ? $instance['visibility_count'] : 3;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('visibility_count'); ?>"><?php _e('Visibility count:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('visibility_count'); ?>" name="<?php echo $this->get_field_name('visibility_count'); ?>" type="text" value="<?php echo esc_attr($visibility_count); ?>" size="5">
        </p>
        <?php        
        $scrollbar = !empty($instance['scrollbar']) ? 1 : 0;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('scrollbar'); ?>"><input class="widefat" id="<?php echo $this->get_field_id('scrollbar'); ?>" name="<?php echo $this->get_field_name('scrollbar'); ?>" type="checkbox" value="1" <?php if (!empty($scrollbar)): ?> checked=""<?php endif; ?>> <?php _e(' Show Custom Scrollbar'); ?> </label> 
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
