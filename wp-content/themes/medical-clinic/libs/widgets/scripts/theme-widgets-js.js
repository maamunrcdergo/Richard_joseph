/**
 * Created AnupBiswas
 * User: UIU
 * Date: 12/2/2015
 * Admin Widgets used scripts
 */
var nc = jQuery.noConflict();
var THEME_WIDGETS = {
    uploadMidea: function (button) {
        var $button = nc(button);
        var button_id = '#' + $button.attr('id');
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var _custom_media = true;
        wp.media.editor.send.attachment = function (props, attachment) {
            console.log(attachment);
            if (_custom_media) {
                $button.closest('.theme-media-box').find('input.image_url').val(attachment.url);
                if ($button.closest('.theme-media-box').find('img').hasClass('media-box-img')) {
                    $button.closest('.theme-media-box').find('img').attr('src', attachment.url).slideDown();
                } else {
                    var img = nc('<img/>');
                    img.attr('src', attachment.url).attr('alt', 'Media Image').addClass('media-box-img');
                    $button.closest('.theme-media-box').find('.mcontent').html(img);

                }
                $button.closest('.theme-media-box').find('.media-close').fadeIn();
                $button.fadeOut();

            } else {
                return _orig_send_attachment.apply(button_id, [props, attachment]);
            }
        }
        wp.media.editor.open();
        return false;
    },
    removeMedia: function (button) {
        var $button = nc(button);
        $button.closest('.theme-media-box').find('.btn-media-upload').show();
        $button.closest('.theme-media-box').find('.media-box-img').slideUp();
        $button.fadeOut();
    },
    getPost: function (post_type) {
        var $post_type = nc(post_type);
        var dataTarget = $post_type.attr('data-target');
        var $data = {post_type: $post_type.val(), action: theme_widgets_settings.action, query: 'get_parent_posts'};
        nc.post(theme_widgets_settings.ajax_url, $data, function ($data) {
            nc(dataTarget).html($data.parent_pages);
        }, 'json');

    },
    galleryImage: function (button, field_name, field_id) {
        var ginputs = '#'+field_id +'-gfields';
        var gcontainer = '#'+field_id +'-gcontainer';
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var _custom_media = true;
        wp.media.editor.send.attachment = function (props, attachment) {
            var input = nc('<input type="hidden" id="ginput-' +field_id+'-'+attachment.id + '" name="' + field_name + '[' + attachment.id + ']" value="' + attachment.id + '"/>');
            input.appendTo(gcontainer)  
            var gbox = nc('<div id="gbox-' +field_id+'-'+attachment.id + '" class="gthumb"><span class="dashicons dashicons-no-alt gimg-remove" onclick="THEME_WIDGETS.removegalleryImage(\'' + field_id+'-'+attachment.id + '\')"></span><img src="' + attachment.sizes.thumbnail.url + '" id="img-' + attachment.id + '"></div>');
             gbox.appendTo(gcontainer);
            
        }
        wp.media.frames.file_frame = wp.media({
            title: 'Add Gallery Images',
            button: {
                text: 'Add to Gallery'
            },
            multiple: false
        });

        wp.media.editor.open();
        return false;
    },
    removegalleryImage: function ($att_id) {
        nc('#gbox-' + $att_id).fadeOut('slow', function () {
            nc(this).remove();
        });
        nc('#ginput-' + $att_id).remove();
    }
};