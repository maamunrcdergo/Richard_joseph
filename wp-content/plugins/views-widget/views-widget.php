<?php
/*
Plugin Name: Views Post Widgets
Plugin URI: http://wordpress.org/plugins/views-post-widget/
Description: A widget use multi post/entry listing from different content
Author: Anup Biswas
Version: 1.0
Author URI: http://anupbiswas.info/
*/

define('VIEWS_ASSETS_URI',  plugin_dir_url(__FILE__).'/assets/');
add_action('widgets_init', 'views_widgets_init');

function views_widgets_init(){
     register_widget('Views_Post_Widget');
}
class Views_Post_Widget extends WP_Widget {

    function __construct() {
        // Instantiate the parent object	
        parent::__construct(false, 'Views Post List', array('description' => __('A widget use multi post/entry listing from different content', 'views'),));

        add_action('admin_enqueue_scripts', array($this, 'scripts'));
        add_action('wp_ajax_views_post_widgets', array($this, 'ajax_callback'));
    }

    function Views_Post_Widget() {
        WP_Widget::__construct();
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $post_type = apply_filters('widget_post_type', $instance['post_type']);
        $taxonomies = apply_filters('widget_taxonomies', $instance['taxonomies']);
        $terms = apply_filters('widget_termse', $instance['terms']);
        $views = apply_filters('widget_views', $instance['views']);
        $layout = apply_filters('widget_layout', $instance['layout']);
        $post_count = apply_filters('widget_post_count', $instance['post_count']);
        $post_order_by = apply_filters('widget_post_order_by', $instance['post_order_by']);
        $post_order_by_meta = apply_filters('widget_post_order_by_meta', $instance['post_order_by_meta']);
        $post_order = apply_filters('widget_post_order', $instance['post_order']);
        $fixed_height = apply_filters('widget_fixed_height', $instance['fixed_height']);
        $default_feature_image = apply_filters('widget_default_feature_image', $instance['default_feature_image']);
        $link_view_all = apply_filters('widget_link_view_all', $instance['link_view_all']);
        $link_view_pos = apply_filters('widget_link_view_pos', $instance['link_view_pos']);
        $feature_col_count = apply_filters('widget_feature_col_count', @$instance['feature_col_count']);

        $post_arg = array(
            'post_type' => $post_type,
            'posts_per_page' => $post_count,
            'post_count' => $post_count,
        );
        if ($post_order_by == 'meta_value' && $post_order_by_meta != '') {
            $post_arg['orderby'] = 'meta_value';
            $post_arg['meta_key'] = $post_order_by_meta;
        } else {
            $post_arg['orderby'] = $post_order_by;
        }

        if (!empty($taxonomies) && !empty($terms)) {
            $post_arg['tax_query'] = array(
                array(
                    'taxonomy' => $taxonomies,
                    'field' => 'term_id',
                    'terms' => $terms,
                )
            );
            $post_arg['tax_query']['relation'] = 'OR';
        }
        $options = array(
            'views' => $views,
            'layout' => $layout,
            'fixed_height' => $fixed_height,
            'img_default' => $default_feature_image,
            'fcol_count' => empty($feature_col_count) ? 3 : $feature_col_count,
        );
        //wpprint($settings);
        echo $before_widget;
        if (!empty($title)) {
            echo $before_title;
            echo $title;
            if ($link_view_pos == 'top' && !empty($link_view_all)) {
                echo '<a title="View All" class="link view-more wview-more-top" href="' . $link_view_all . '">View All</a>';
            }
            echo $after_title;
        }
        views_post_list($post_arg, $options);
        if ($link_view_pos == 'bottom' && !empty($link_view_all)) {
            echo '<a title="View All" class="link view-more wview-more-bottom" href="' . $link_view_all . '">View more</a>';
            echo '<div class="clearfix"></div>';
        }

        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        // Save widget options
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['post_type'] = $new_instance['post_type'];
        $instance['taxonomies'] = $new_instance['taxonomies'];
        $instance['terms'] = $new_instance['terms'];
        $instance['views'] = $new_instance['views'];
        $instance['layout'] = $new_instance['layout'];
        $instance['post_count'] = $new_instance['post_count'];
        $instance['post_order_by'] = $new_instance['post_order_by'];
        $instance['post_order_by_meta'] = $new_instance['post_order_by_meta'];
        $instance['post_order'] = $new_instance['post_order'];
        $instance['fixed_height'] = $new_instance['fixed_height'];
        $instance['default_feature_image'] = $new_instance['default_feature_image'];
        $instance['link_view_all'] = $new_instance['link_view_all'];
        $instance['link_view_pos'] = $new_instance['link_view_pos'];
        $instance['feature_col_count'] = $new_instance['feature_col_count'];

        return $instance;
    }

    function form($instance) {

        $type_arg = array(
            'public' => TRUE,
            'publicly_queryable' => TRUE,
            'exclude_from_search' => FALSE,
            '_builtin' => FALSE
        );
        $post_types = get_post_types($type_arg, 'objects', 'or');
        //fields Variables
        $title = @$instance['title'];
        $content_type = empty($instance['post_type']) ? 'posts' : $instance['post_type'];
        $taxonomies = $this->getTaxonomies($content_type);
        $tax = empty($instance['taxonomies']) ? 'category' : $instance['taxonomies'];
        $terms_items = $this->getTerms($tax);
        $terms = empty($instance['terms']) ? array(0) : $instance['terms'];


        $views_items = array(
            'title' => array('id_suffixe' => '_title', 'label' => 'Title'),
            'date' => array('id_suffixe' => '_date', 'label' => 'Date'),
            'excerpt' => array('id_suffixe' => '_excerpt', 'label' => 'excerpt'),
            'content' => array('id_suffixe' => '_content', 'label' => 'content'),
            'feature_image' => array('id_suffixe' => '_feature_image', 'label' => 'Feature image'),
            'readmore' => array('id_suffixe' => '_readmore', 'label' => 'readmore'),
        );
        $default_views = array('title', 'date', 'excerpt', 'feature_image');
        $views = empty($instance['views']) ? $default_views : $instance['views'];
        $layout = empty($instance['views']) ? 'row_base' : $instance['layout'];

        $post_count = empty($instance['post_count']) ? 5 : intval($instance['post_count']);
        $post_order_by = empty($instance['post_order_by']) ? 'date' : $instance['post_order_by'];
        $post_order_by_meta = empty($instance['post_order_by_meta']) ? '' : $instance['post_order_by_meta'];
        $post_order = empty($instance['post_order']) ? 'DESC' : $instance['post_order'];
        $fixed_height = empty($instance['fixed_height']) ? 0 : intval($instance['fixed_height']);

        $default_feature_image = empty($instance['default_feature_image']) ? '' : $instance['default_feature_image'];
        $link_view_all = empty($instance['link_view_all']) ? '' : $instance['link_view_all'];
        $link_view_pos = empty($instance['link_view_pos']) ? 'bottom' : $instance['link_view_pos'];
        $feature_col_count = empty($instance['feature_col_count']) ? 3 : $instance['feature_col_count'];
        ?>
        <div class="views views_widget">
            <div class="ww_accordion">
                <h3 title="wwc_title">Basic</h3>
                <div class="wwc_content">
                    <p class="form-items"><label for="<?php echo $this->get_field_name('title'); ?>">Title:</label><input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" /></p>
                </div>
                <h3 title="wwc_title">Content</h3>
                <div class="wwc_content">
                    <p class="form-items"><label for="<?php echo $this->get_field_name('post_type'); ?>">Type:</label>
                        <select  name="<?php echo $this->get_field_name('post_type'); ?>" onchange="Views_Widget.loadTexonomy(this, '#<?php echo $this->get_field_id('taxonomies'); ?>', '#<?php echo $this->get_field_id('terms_list_container'); ?>')" class="widefat">
                            <option value="0">--Select--</option>;
                            <?php
                            foreach ($post_types as $type => $data) {
                                if ($type === $content_type) {
                                    echo ' <option selected="" value="' . $type . '">' . $data->labels->name . '</option>';
                                } else {
                                    echo ' <option  value="' . $type . '">' . $data->labels->name . '</option>';
                                }
                            }
                            ?>                       
                        </select>                    
                    </p>
                    <p class="form-items"><label for="<?php echo $this->get_field_name('taxonomies'); ?>">Taxonomies:</label>
                        <select name="<?php echo $this->get_field_name('taxonomies'); ?>" onchange="Views_Widget.loadTerms(this, '#<?php echo $this->get_field_id('terms_list_container'); ?>')" class="widefat" id="<?php echo $this->get_field_id('taxonomies'); ?>">
                            <?php
                            foreach ($taxonomies as $tax_slug => $labels) {
                                if ($tax_slug === $tax) {
                                    echo ' <option selected="" value="' . $tax_slug . '">' . $labels . '</option>';
                                } else {
                                    echo ' <option  value="' . $tax_slug . '">' . $labels . '</option>';
                                }
                            }
                            ?>  
                        </select>                    
                    </p>
                    <p class="form-items"><label for="<?php echo $this->get_field_name('terms'); ?>">Terms:</label>
                    <ul class="terms-list" id="<?php echo $this->get_field_id('terms_list_container'); ?>">
                        <?php if (!empty($terms_items)): foreach ($terms_items as $term_id => $label): ?>
                                <li><label for="<?php echo $this->get_field_id('terms') . '_' . $term_id; ?>"><input type="checkbox" name="<?php echo $this->get_field_name('terms'); ?>[]" value="<?php echo $term_id; ?>" <?php
                                        if (in_array($term_id, $terms)) {
                                            echo 'checked="checked"';
                                        };
                                        ?> id="<?php echo $this->get_field_id('terms') . '_' . $term_id; ?>"/><?php echo $label; ?></label></li>
                                    <?php
                                endforeach;
                            endif;
                            ?> 
                    </ul>
                    </p>
                </div>
                <h3 title="wwc_title">Views</h3>
                <div class="wwc_content">
                    <?php $views_items = $this->sortValues($views, $views_items);
                    ?>
                    <ul class="short-views form-items">
                        <?php foreach ($views_items as $key => $item): ?>
                            <li><label for="<?php echo $this->get_field_id('views') . $item['id_suffixe']; ?>"><input type="checkbox" name="<?php echo $this->get_field_name('views'); ?>[]"  value="<?php echo $key; ?>" <?php
                                    if (in_array($key, $views)) {
                                        echo 'checked="checked"';
                                    }
                                    ?> /><?php echo $item['label']; ?></label></li>
                            <?php endforeach; ?>
                    </ul>
                </div>
                <h3 title="wwc_title">Layout</h3>
                <div class="wwc_content">
                    <ul class="layout-views form-items">
                        <li><label for="<?php echo $this->get_field_id('layout'); ?>_col_base"><input type="radio" name="<?php echo $this->get_field_name('layout'); ?>" value="col_base" id="<?php echo $this->get_field_id('layout'); ?>_col_base" <?php checked('col_base', $layout); ?>/>Column Base</label></li>
                        <li><label for="<?php echo $this->get_field_id('layout'); ?>_row_base"><input type="radio" name="<?php echo $this->get_field_name('layout'); ?>" value="row_base" id="<?php echo $this->get_field_id('layout'); ?>_row_base" <?php checked('row_base', $layout); ?>/>Row Base</label></li>

                    </ul>
                </div>
                <h3 title="wwc_title">Counts</h3>
                <div class="wwc_content">
                    <ul class="form-items">
                        <li><label for="<?php echo $this->get_field_id('post_count'); ?>">Number of items show:</label><input type="text" name="<?php echo $this->get_field_name('post_count'); ?>" value="<?php echo $post_count; ?>" id="<?php echo $this->get_field_id('post_count'); ?>" size="10"/></li>
                        <li>
                            <label for="<?php echo $this->get_field_id('post_order_by'); ?>">Items Order by:</label>
                            <select name="<?php echo $this->get_field_name('post_order_by'); ?>" id="<?php echo $this->get_field_id('post_order_by'); ?>">
                                <option value="ID" <?php if ('ID' === $post_order_by): ?>selected="" <?php endif; ?>>ID</option>
                                <option value="title" <?php if ('title' === $post_order_by): ?>selected="" <?php endif; ?>>Title</option>
                                <option value="name" <?php if ('name' === $post_order_by): ?>selected="" <?php endif; ?>>Name</option>
                                <option value="date" <?php if ('date' === $post_order_by): ?>selected="" <?php endif; ?>>Date</option>
                                <option value="comment_count" <?php if ('comment_count' === $post_order_by): ?>selected="" <?php endif; ?>>Comment Count</option>
                                <option value="rand" <?php if ('rand' === $post_order_by): ?>selected="" <?php endif; ?>>Random</option>
                                <option value="menu_order" <?php if ('menu_order' === $post_order_by): ?>selected="" <?php endif; ?>>Menu order(only for page)</option>
                                <option value="meta_value" <?php if ('meta_value' === $post_order_by): ?>selected="" <?php endif; ?>>Meta value(add meta key)</option>                                
                            </select>                        
                        </li>                        
                        <li><label for="<?php echo $this->get_field_id('post_order_by_meta'); ?>">Meta Key:</label><input type="text" name="<?php echo $this->get_field_name('post_order_by_meta'); ?>" value="<?php echo $post_order_by_meta; ?>" id="<?php echo $this->get_field_id('post_count'); ?>" size="10"/></li>
                        <li>
                            <label for="<?php echo $this->get_field_id('post_order_by'); ?>">Order:</label>
                            <select name="<?php echo $this->get_field_name('post_order'); ?>" id="<?php echo $this->get_field_id('post_order'); ?>">
                                <option value="ASC" <?php if ('ASC' === $post_order): ?>selected="" <?php endif; ?>>ASC</option>
                                <option value="DESC" <?php if ('title' === $post_order): ?>selected="" <?php endif; ?>>DESC</option>                                                         
                            </select>                        
                        </li>
                        <li><label for="<?php echo $this->get_field_id('fixed_height'); ?>">Fixed Height(px):</label><input type="text" name="<?php echo $this->get_field_name('fixed_height'); ?>" value="<?php echo $fixed_height; ?>" id="<?php echo $this->get_field_id('fixed_height'); ?>" placeholder="250" size="10"/></li>
                    </ul>
                </div>
                <h3 title="wwc_title">Addtional Options</h3>
                <div class="wwc_content">
                    <ul class="form-items">                        
                        <li><label for="<?php echo $this->get_field_id('default_feature_image'); ?>">Default Feature Image:</label><input type="button" onclick="Views_Widget.uploadMedia('#<?php echo $this->get_field_id('default_feature_image'); ?>')" value="Upload" class="button button-secondary button-small"/><br /><input type="text" name="<?php echo $this->get_field_name('default_feature_image'); ?>" value="<?php echo $default_feature_image; ?>" id="<?php echo $this->get_field_id('default_feature_image'); ?>" placeholder="http://example.com/upload/default.png" size="35"></li>
                        <li><label for="<?php echo $this->get_field_id('link_view_all'); ?>">Link view all:</label><input type="text" name="<?php echo $this->get_field_name('link_view_all'); ?>" value="<?php echo $link_view_all; ?>" id="<?php echo $this->get_field_id('link_view_all'); ?>" placeholder="http://example.com/post-all" size="35"></li>
                        <li><label for="<?php echo $this->get_field_id('link_view_pos'); ?>">Link view possession:</label>
                            <select name="<?php echo $this->get_field_name('link_view_pos'); ?>" id="<?php echo $this->get_field_id('link_view_pos'); ?>">
                                <option value="top" <?php
                                if ($link_view_pos == 'top') {
                                    echo 'selected=""';
                                }
                                ?> >Top</option>
                                <option value="bottom" <?php
                                if ($link_view_pos == 'bottom') {
                                    echo 'selected=""';
                                }
                                ?>>Bottom</option>
                            </select>

                        </li>
                        <li><label for="<?php echo $this->get_field_id('feature_col_count'); ?>">Feature Column Count:</label><input type="text" name="<?php echo $this->get_field_name('feature_col_count'); ?>" value="<?php echo $feature_col_count; ?>" id="<?php echo $this->get_field_id('feature_col_count'); ?>" size="10"></li>
                    </ul>
                </div>
            </div>


        </div>
        <?php
    }

    function scripts() {

        $screen = get_current_screen();
        if ('widgets' === $screen->base) {
            wp_enqueue_media();
            wp_enqueue_style('jquery-ui', VIEWS_ASSETS_URI . 'css/jquery-ui.min.css');
            wp_enqueue_style('views-widgets-admin-styles', VIEWS_ASSETS_URI . 'css/widgets-admin-styles.css');

            wp_enqueue_script('views-widgets-admin-js', VIEWS_ASSETS_URI . 'js/views-widgets-admin-js.js', array('jquery', 'media-upload', 'jquery-ui-core', 'jquery-ui-sortable', 'jquery-ui-accordion'), '1.0', true);
            wp_localize_script('views-widgets-admin-js', 'views_widgets_settings', array('ajax_url' => admin_url('admin-ajax.php'), 'action' => 'views_post_widgets'));
        }
    }

    function getTaxonomies($post_type) {
        $taxonomy = get_object_taxonomies($post_type, 'objects');

        $tax_array = array();
        foreach ($taxonomy as $tax => $data) {
            $tax_array[$tax] = @$data->labels->name;
        }

        return $tax_array;
    }

    function loadTaxonomies($post_type, $selected = '') {
        $tax_options = '';
        $taxonomies = $this->getTaxonomies($post_type);
        $count = 1;
        foreach ($taxonomies as $tax_slug => $labels) {
            if ($count === 1) {
                $tax_options .= ' <option selected="" value="' . $tax_slug . '">' . $labels . '</option>';
            } else {
                $tax_options .= ' <option  value="' . $tax_slug . '">' . $labels . '</option>';
            }
            $count++;
        }
        return $tax_options;
    }

    function loadTerms($taxonomy, $selected = '') {
        $term_options = '';
        $terms_items = $this->getTerms($taxonomy);
        if (!empty($terms_items) && !is_wp_error($terms_items)):
            foreach ($terms_items as $term_id => $label):
                $term_options .= '<li><label for="' . $this->get_field_id('terms') . '_' . $term_id . '">';
                $term_options .= '<input type="checkbox" name="' . $this->get_field_name('terms') . '[]" value="' . $term_id . '"';
                $term_options .= ' id="' . $this->get_field_id('terms') . '_' . $term_id . '"/>' . $label . '</label></li>';
            endforeach;
        else:
            $term_options = '<li> No Term Found</li>';
        endif;
        return $term_options;
    }

    function getTerms($taxonomies = '') {
        $terms = array();
        $categories = get_terms($taxonomies, 'orderby=count&hide_empty=0');
        if (!empty($categories) && !is_wp_error($categories)):
            foreach ($categories as $cat) {
                $terms[$cat->term_id] = $cat->name;
            }
        endif;
        return $terms;
    }

    function ajax_callback() {
        $return = '';
        switch ($_POST['query']) {
            case 'get_texonomy':
                $get_texonomy = $this->loadTaxonomies($_POST['post_type']);
                $return = array('field' => 'texonomy', 'html' => $get_texonomy);
                break;
            case 'get_terms':
                $get_terms = $this->loadTerms($_POST['texonomy']);
                $return = array('field' => 'terms', 'html' => $get_terms);
                break;
        }//switch
        echo json_encode($return);
        exit();
    }

    function sortValues($values, $defaults) {
        $result = array();
        if (!empty($values) && !empty($values)) {
            foreach ($values as $val) {
                $result[$val] = $defaults[$val];
                unset($defaults[$val]);
            }
            $defaults = wp_parse_args($defaults, $result);
        }
        return $defaults;
    }

}

function views_post_list($args = '', $options = array(), $output = TRUE) {
    $default_arguments = array(
        'post_type' => 'post',
    );
    $option_default = array(
        'wrap' => 'div',
        'item' => 'li',
        'wrap_class' => 'views-lists',
        'wrap_attr' => '',
        'item_class' => 'list-item',
        'item_attr' => '',
        'layout' => 'col_base',
        'show_paging' => false,
        'prefix' => '',
        'suffix' => '',
        'views' => array('title'),
        'img_default' => '',
        'fixed_height' => FALSE,
    );
    $current_news = 0;
    if (is_singular()) {
        global $post;
        //$default_arguments['post__not_in'] = array($post->ID);
        $current_news = $post->ID;
    }
    $item_query = wp_parse_args($args, $default_arguments);

    $settings = wp_parse_args($options, $option_default);
    $query_posts = get_posts($item_query);
    if (!empty($settings['fixed_height'])) {
        $settings['wrap_class'] .= ' fixed_height';
        $settings['wrap_attr'] .= ' style="height:' . $settings['fixed_height'] . 'px"';
    }
    $lists = '';
    if (!empty($query_posts)):
        $lists .= $settings['prefix'];
        $lists .= '<' . $settings['wrap'] . ' class="' . $settings['wrap_class'] . '" ' . $settings['wrap_attr'] . '>';
        $lists .= '<ul class="article-listing view-'.implode(' view-', $settings['views']).'">';
        
        foreach($query_posts as $post):           
            $current_class = ($post->ID == $current_news)? 'current-item':'';
            $lists .= '<' . $settings['item'] . ' class="' . $settings['item_class'] . ' '.$current_class.'" ' . $settings['item_attr'] . '>';
            if ($settings['layout'] === 'col_base') {
                $lists .= views_col_base_list($post, $settings);
            } else {
                $lists .= views_row_base_list($post, $settings);
            }
            $lists .= '</' . $settings['item'] . '>';
        endforeach;
        $lists .= '</ul>';
        $lists .= '</' . $settings['wrap'] . '>';

        $lists .= '<div class="clearfix"></div>';
        $lists .= $settings['suffix'];
    else:

    endif;
    if ($output) {
        echo $lists;
    } else {
        return $lists;
    }
}

function views_col_base_list($post, $options) {

    $fcol = intval($options['fcol_count']);
    $cncol = 12 - $fcol;
    $views = $options['views'];
    $block = '';
    $block .= '<div class="item-content col-base row">';
    $block .= '<figure class="thumb col-xs-12 col-sm-' . $fcol . '">';
    if (has_post_thumbnail($post->ID)) {
        $block .= get_the_post_thumbnail($post->ID, 'thumbnail');
    } else if (!empty($options['img_default'])) {
        $block .= '<img  src="' . $options['img_default'] . '" alt="Thumbnail:' . $post->post_title . '" />';
    }

    $block .= '</figure>';
    $block .= '<div class="item-inner col-xs-12 col-sm-' . $cncol . '">';
    $block .= '<h4 class="item-title"><a href="' . get_permalink($post->ID) . '" title="' . $post->post_title . '">' . $post->post_title . '</a></h4>';
    if (in_array('date', $views)) {
        $block .= '<div class="item-meta">';
        $block .= '<span class="meta-date">' . date('D, M j, Y, g:i a', strtotime($post->post_date)) . '</span>';
        $block .= '</div>';
    }

    $block .= '<div class="item-excerpt">';
    $content = empty($post->post_excerpt) ? esc_attr($post->post_content) : $post->post_excerpt;
    $content = substr($content, 0, 100) . '...';
    $block .= wpautop($content);
    $block .= '</div>';
    $block .= '</div>';
    $block .= '</div>';
    return $block;
}

function views_row_base_list($post, $options) {

    $fcol = intval($options['fcol_count']);
    $cncol = 12 - $fcol;
    $layout = $options['layout'];
    $views = $options['views'];
    $block = '';
    $block .= sprintf('<div class="item-content %s">', $layout);

    foreach ($views as $key) {
        switch ($key):
            case 'title':
                $block .= views_pwview_title($post, $options);
                break;
            case 'date':
                $block .= views_pwview_date($post, $options);
                break;
            case 'excerpt':
                $block .= views_pwview_excerpt($post, $options);
                break;
            case 'feature_image':
                $block .= views_pwview_feature_image($post, $options);
                break;
        endswitch;
    }

    $block .= '</div>';
    return $block;
}

function views_pwview_title($post, $option = '') {
    $title = $post->post_title;
    $link = get_permalink($post->ID);
    $title_html = sprintf('<h4><a href="%2$s" title="%1$s">%1$s</a></h4>', $title, $link);
    return apply_filters('views_post_widgets_view_title', $title_html, $post);
}

function views_pwview_excerpt($post, $option = '') {
    $content = strip_tags($post->post_content);
    $excerpt = empty($post->post_excerpt) ? wp_trim_words($content, 10, '...') : wp_trim_words($post->post_excerpt, 10, '...');
    $excerpt_html = sprintf('<div class="entry-excerpt">%s</div>', wpautop($excerpt));
    return apply_filters('views_post_widgets_view_excerpt', $excerpt_html, $post);
}

function views_pwview_content($post, $option = '') {
    $content = strip_tags($post->post_content);
    $excerpt_html = sprintf('<div class="entry-content">%s</div>', $content);
    return apply_filters('views_post_widgets_view_excerpt', $excerpt_html, $post);
}

function views_pwview_date($post, $option = '') {
//    print_r($post);
    
    $date_forma = get_option('date_format', 'D, M j, Y, g:i a');
    $entry_date = date($date_forma, strtotime($post->post_date));  
   
    
    $date_html = sprintf('<span class="entry-date">%s</span>', $entry_date);
    return apply_filters('views_post_widgets_view_date', $date_html, $post);
}

function views_pwview_feature_image($post, $options = '') {
    $feature_image ='';
    
    if (has_post_thumbnail($post->ID)) {
        $feature_image = get_the_post_thumbnail($post->ID, 'thumbnail');
    } else if (!empty($options['img_default'])) {
        $feature_image = sprintf('<img  src="%2$s" alt="Thumbnail:%1$s" class="attachment-thumbnail wp-post-image"/>', $post->post_title, $options['img_default']);
    }
    return apply_filters('views_post_widgets_view_feature_image', $feature_image, $post);
}