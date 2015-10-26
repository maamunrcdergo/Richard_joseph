<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Illusive_Blog_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        parent::__construct(
                'theme_blod_widget', __('Theme Blog Widget', 'bits'), array('description' => __('A Blog Widget', 'uiu'),)
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
        $visibility_count = apply_filters('widget_visibility_count', $instance['visibility_count']);

        echo $args['before_widget'];
        echo '<div class="blog-widget">';
        if (!empty($instance['title'])) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $blogs = get_posts(array('post_type' => 'blog', 'posts_per_page' => $visibility_count));

        $blogHtml = '<div class="content blogs">';
        foreach ($blogs as $blog) {
            $attachment_id = get_post_thumbnail_id($blog->ID);
            $featured_image = wp_get_attachment_url($attachment_id);
            
            $link = get_permalink($blog->ID);
            
            $pdate = date('d M. Y g.i A', strtotime($blog->post_date));
            $ptitle = wp_trim_words($blog->post_title, 10, '...');
            $pcontent = wp_trim_words($blog->post_content, 10, '...'); 
            $blogHtml .= '<div class="blog">';
            $blogHtml .= sprintf('<img class="blogs-list-img" src="%2$s" alt="%1$s" />', $blog->post_title, $featured_image);
            $blogHtml .= sprintf('<h4 class="blod-title"><a href="%2$s">%1$s</a></h4>', $ptitle,$link); 
            $blogHtml .= sprintf('<p class="blog-content">%1$s</p>', $pcontent);
            $blogHtml .= sprintf('<p class="publish-date">Posted %1$s</p>', $pdate);


            
            $blogHtml .= '</div>';
        }
        $blogHtml .= '</div >';
        echo $blogHtml;
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

        $instance['visibility_count'] = (!empty($new_instance['visibility_count']) ) ? strip_tags($new_instance['visibility_count']) : '';



        return $instance;
    }

}
