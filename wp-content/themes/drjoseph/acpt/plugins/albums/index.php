<?php
add_action('init', 'acpt_albums_init');

function acpt_albums_init() {
    $args_albums = array(
        'supports' => array('title', 'thumbnail', 'excerpt'),
        'hierarchical' => true,
    );
    $albums = acpt_post_type('album', 'albums', false, $args_albums)->icon('color');
    acpt_tax('gallery', 'galleries', $albums, true, false);
    $album_Admin = new Custom_Post_Type_Admin('album', array('gallery'));
}

/*
 * Action in Query create
 *
 */
add_action('pre_get_posts', 'albums_pre_get_posts');

function albums_pre_get_posts( $query )
{
    // project example
    if( (isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'album' ) || !empty($query->query_vars['gallery']))
    {
    	$query->set('orderby', 'meta_value_num');  
    	$query->set('meta_key', 'custom_order');  
    	$query->set('order', 'ASC'); 
            
    }   
	// always return
	return $query;

}
add_action('add_meta_boxes', 'acpt_albums_add_meta_box');
add_action('admin_enqueue_scripts', 'acpt_album_admin_scripts');

function acpt_albums_add_meta_box() {
    add_meta_box('album_add_images', __('Album Photos'), 'acpt_albums_meta_box_images_callback', 'album', 'normal', 'high');
    add_meta_box('album_add_Videos', __('Album Videos'), 'acpt_albums_meta_box_videos_callback', 'album', 'normal', 'high');
}

function acpt_album_admin_scripts() {
    $screen = get_current_screen();
    if ('album' === $screen->post_type) {
        wp_enqueue_media();
        wp_enqueue_style('album-metabox-styles', get_template_directory_uri() . '/acpt/plugins/albums/scripts/admin-album-style.css');
        wp_enqueue_script('jquery-tmpl', get_template_directory_uri() . '/acpt/plugins/albums/scripts/jquery.tmpl.min.js', array('jquery'), '1.0', true);
        wp_enqueue_script('album-metabox-js', get_template_directory_uri() . '/acpt/plugins/albums/scripts/admin-album-js.js', array('jquery', 'media-upload', 'jquery-ui-core', 'jquery-ui-sortable'), '1.0', true);
    }
}

function acpt_albums_meta_box_images_callback($post) {
// Add an nonce field so we can check for it later.
    wp_nonce_field('acpt_albums_meta_box', 'acpt_albums_meta_box_nonce');
    $album_images = get_post_meta($post->ID, 'album_images', TRUE);
    $album_images = maybe_unserialize($album_images);
    ?>
    <div id="album-images" class="album-images-container">
        <?php
        if (!empty($album_images)): foreach ($album_images as $key => $attachment):
                echo sprintf('<div class="album-img-box" id="attachment-%1$s"><input type="hidden" name="album[images][%1$s]" value="%2$s" /><img src="%2$s" alt="album-img-%1$s" /> <button onclick="cALBUMS.removeMedia(this,\'%1$s\')" type="button"><span class="dashicons dashicons-no"><span class="screen-reader-text">Close media panel</span></span></button></div>', $key, $attachment);
            endforeach;
        endif;
        ?>
    </div>
    <div class="album-images-container-bottom">
        <button class="button album-addnew" type="button" onclick="cALBUMS.uploadMedia()">Upload Images</button>
    </div>

    <?php
}

function acpt_albums_meta_box_videos_callback($post) {
    $album_videos = get_post_meta($post->ID, 'album_videos', TRUE);
    $album_videos = maybe_unserialize($album_videos);
    ?>
    <div id="album-videos" class="album-videos-container">
        <?php
        if (!empty($album_videos)): foreach ($album_videos as $key => $attachment):
                echo sprintf('<div class="album-img-box" id="attachment-%1$s"><input class="video_link" type="hidden" name="album[videos][%1$s]" value="%2$s" /><img src="%2$s" alt="album-img-%1$s" /> <button onclick="cALBUMS.removeMedia(this,\'%1$s\')" type="button"><span class="dashicons dashicons-no"><span class="screen-reader-text">Close media panel</span></span></button></div>', $key, $attachment);
            endforeach;
        endif;
        ?>
    </div>
    <div class="album-videos-container-bottom">
        <label>Youtube Url:</label><input size="50" type="text" id="youtube_url" name="youtube_url" value="" placeholder="https://www.youtube.com/watch?v=cHOdB-nDoQQ" /><button class="button" type="button" onclick="cALBUMS.addVideo()">Add</button>
    </div>

    <?php
}

function acpt_albums_save_meta_box_data($post_id) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if (!isset($_POST['acpt_albums_meta_box_nonce'])) {
        return;
    }

    // Verify that the nonce is valid.
    if (!wp_verify_nonce($_POST['acpt_albums_meta_box_nonce'], 'acpt_albums_meta_box')) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions.
    if (isset($_POST['post_type']) && 'page' == $_POST['album']) {

        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }


    // Sanitize user input.
    $album_images_data = !empty($_POST['album']['images']) ? maybe_serialize($_POST['album']['images']) : '';

    // Update the meta field in the database.
    update_post_meta($post_id, 'album_images', $album_images_data);
    // Sanitize user input.
    $album_videos_data = !empty($_POST['album']['videos']) ? maybe_serialize($_POST['album']['videos']) : '';

    // Update the meta field in the database.
    update_post_meta($post_id, 'album_videos', $album_videos_data);
}

add_action('save_post', 'acpt_albums_save_meta_box_data');
