<?php

/**
 * @package ERGOV
 * @since Ergov 1.2
 * @author: anup
 */
class Custom_Post_Type_Admin {

    public $post_type;
    public $taxonomies;

    public function __construct($post_type, $taxonomies = '') {
        $this->post_type = $post_type;
        $this->taxonomies = $taxonomies;
        $this->init();
    }

    public function init() {



        //add_filter('manage_edit-' . $this->post_type . '_columns', array($this, 'add_column'), 10, 1);
        //add_action('manage_' . $this->post_type . '_custom_column', array($this, 'custom_columns'), 10, 1);
        add_filter('manage_' . $this->post_type . '_posts_columns', array($this, 'add_column'));
        add_action('manage_' . $this->post_type . '_posts_custom_column', array($this, 'custom_columns'), 10, 2);

        // Allow filtering of posts by taxonomy in the admin view
        add_action('restrict_manage_posts', array($this, 'add_taxonomy_filters'));

        // Show post counts in the dashboard
        add_action('right_now_content_table_end', array($this, 'add_rightnow_counts'));
        add_action('dashboard_glance_items', array($this, 'add_glance_counts'));
    }


    /**
     * Add columns to post type list screen.
     *
     * @link http://wptheming.com/2010/07/column-edit-pages/
     *
     * @param array $columns Existing columns.
     *
     * @return array Amended columns.
     */
    public function add_column($columns) {
        $column_thumbnail = array(
            'thumbnail' => __('Image'));
        $columns = array_slice($columns, 0, 2, true) + $column_thumbnail + array_slice($columns, 1, null, true);
        $index = 0;
        if (!empty($this->taxonomies)) {
            foreach ($this->taxonomies as $index => $tax) {
                $column_order = array('custom_terms_' . $tax => ucfirst($tax));
                $columns = array_slice($columns, 0, 3 + $index, true) + $column_order + array_slice($columns, 1, null, true);
            }
        }
        $column_order = array(
            'custom_order' => __('Order'));
        $columns = array_slice($columns, 0, 4 + $index, true) + $column_order + array_slice($columns, 1, null, true);

        $column_order = array(
            'is_featured' => __('Featured'));
        $columns = array_slice($columns, 0, 5 + $index, true) + $column_order + array_slice($columns, 1, null, true);

        return $columns;
    }

    /**
     * Custom column callback
     *
     * @global stdClass $post Post object.
     *
     * @param string $column Column ID.
     */
    public function custom_columns($column) {

        if ($this->post_type != get_post_type()) {
            return $column;
        }
        global $post;

        switch ($column) {
            case 'thumbnail':
                // echo get_the_post_thumbnail( $post->ID, array(35, 35) );
                echo get_the_post_thumbnail(get_the_ID(), array(35, 35));
                break;
            case 'thumbnail':
                // echo get_the_post_thumbnail( $post->ID, array(35, 35) );
                echo get_the_post_thumbnail(get_the_ID(), array(35, 35));
                break;
            case 'custom_order':
                $order = get_field('custom_order');
                $post_id = get_the_ID();
                echo sprintf('<input class="cf-input cf-small" onchange="EditFields.updateInput(this,%1$s)" type="text" name="custom_order" value="%2$s" style="width:100px"/>', $post_id, $order);
                break;
            case (preg_match('/custom_terms_*/', $column) ? true : false):
                $_taxonomy = str_replace('custom_terms_', '', $column);
                $terms = get_the_terms(get_the_ID(), $_taxonomy);
                if (!empty($terms)) {
                    $out = array();
                    foreach ($terms as $c)
                        $out[] = "<a href='edit-tags.php?action=edit&taxonomy=$_taxonomy&post_type=" . $this->post_type . "&tag_ID={$c->term_id}'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
                    echo join(', ', $out);
                } else {
                    _e('Uncategorized');
                }
                break;
            case 'is_featured':
                $post_id = get_the_ID();
                $is_featured = get_field('is_featured', $post_id);                
                $featured_class = !empty($is_featured) ? 'do-featured featured' : 'do-featured not-featured';
                echo sprintf('<span onclick="EditFields.updateCheck(this,%1$s)" class="dashicons dashicons-star-filled %2$s" data-featured="%1$s" data-toggle="featured"></span>', $post_id, $featured_class);
                break;
        }
    }

    /**
     * Add taxonomy filters to the post type list page.
     *
     * Code artfully lifted from http://pippinsplugins.com/
     *
     * @global string $typenow
     */
    public function add_taxonomy_filters() {
        global $typenow;

        // Must set this to the post type you want the filter(s) displayed on
        if ($this->post_type !== $typenow || empty($this->taxonomies)) {
            return;
        }
        if (is_array($this->taxonomies)) {
            foreach ($this->taxonomies as $tax_slug) {
                echo $this->build_taxonomy_filter($tax_slug);
            }
        } else {
            echo $this->build_taxonomy_filter($this->taxonomies);
        }
    }

    /**
     * Build an individual dropdown filter.
     *
     * @param  string $tax_slug Taxonomy slug to build filter for.
     *
     * @return string Markup, or empty string if taxonomy has no terms.
     */
    protected function build_taxonomy_filter($tax_slug) {
        $terms = get_terms($tax_slug);
        if (0 == count($terms)) {
            return '';
        }

        $tax_name = $this->get_taxonomy_name_from_slug($tax_slug);
        $current_tax_slug = isset($_GET[$tax_slug]) ? $_GET[$tax_slug] : false;

        $filter = '<select name="' . esc_attr($tax_slug) . '" id="' . esc_attr($tax_slug) . '" class="postform">';
        $filter .= '<option value="0">' . esc_html($tax_name) . '</option>';
        $filter .= $this->build_term_options($terms, $current_tax_slug);
        $filter .= '</select>';

        return $filter;
    }

    /**
     * Get the friendly taxonomy name, if given a taxonomy slug.
     *
     * @param  string $tax_slug Taxonomy slug.
     *
     * @return string Friendly name of taxonomy, or empty string if not a valid taxonomy.
     */
    protected function get_taxonomy_name_from_slug($tax_slug) {
        $tax_obj = get_taxonomy($tax_slug);
        if (!$tax_obj)
            return '';
        return $tax_obj->labels->name;
    }

    /**
     * Build a series of option elements from an array.
     *
     * Also checks to see if one of the options is selected.
     *
     * @param  array  $terms            Array of term objects.
     * @param  string $current_tax_slug Slug of currently selected term.
     *
     * @return string Markup.
     */
    protected function build_term_options($terms, $current_tax_slug) {
        $options = '';

        foreach ($terms as $term) {
            $options .= sprintf(
                    '<option value="%s"%s />%s</option>', esc_attr($term->slug), selected($current_tax_slug, $term->slug, FALSE), esc_html($term->name . '(' . $term->count . ')')
            );
        }
        return $options;
    }

    /**
     * Add counts to "At a Glance" dashboard widget in WP 3.8+
     *
     * @since 0.1.0
     */
    public function add_glance_counts() {
        if (!class_exists('Dashboard_Glancer')) {
            require_once('class-dashboard_glancer.php');
        }
        $glancer = new Dashboard_Glancer;
        $glancer->add($this->post_type, array('publish', 'pending'));
    }

}

add_action('wp_ajax_edit_featured_fields', 'ajax_edit_featured_fields');
// embed the javascript file that makes the AJAX request
add_action('admin_enqueue_scripts', 'custom_featured_fields_scripts');
function ajax_edit_featured_fields(){
    $field_key = esc_html($_POST['meta_key']);
    $meta_value = esc_html($_POST['meta_value']);   
    $post_id = esc_html($_POST['post_id']);
    update_field($field_key, $meta_value, $post_id);
    exit();
}
function custom_featured_fields_scripts(){
        wp_enqueue_script('customfield', get_template_directory_uri() . '/acpt/core/js/customfield.js', array('jquery'), 1.0, TRUE);
        wp_enqueue_style('customfield-css', get_template_directory_uri() . '/acpt/core/css/customfield.css');

// declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
        wp_localize_script('customfield', 'cfAjax', array('ajaxurl' => admin_url('admin-ajax.php')));   
}