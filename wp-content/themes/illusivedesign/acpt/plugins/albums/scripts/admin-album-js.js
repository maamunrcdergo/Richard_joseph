/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var nc = jQuery.noConflict();
var cALBUMS = {
    loadEvent: function () {

    },
    imgMarkup: "<div class=\"album-img-box\" id=\"attachment-${ id }\">" +
            "<input type=\"hidden\" name=\"album[images][${ id }]\" value=\"${ url }\" />" +
            "<img src=\"${ url }\" alt=\"${ title }\" /> " +
            "<button onclick=\"cALBUMS.removeMedia(this,'${ id }')\" type=\"button\"><span class=\"dashicons dashicons-no\"><span class=\"screen-reader-text\">Close media panel</span></span></button>" +
            "</div>",
    videoMarkup: "<div class=\"album-img-box\" id=\"attachment-${ id }\">" +
            "<input class=\"video_link\" type=\"hidden\" name=\"album[videos][${ id }]\" value=\"${ url }\" />" +
            "<img src=\"${ url }\" alt=\"video-${ id }\" /> " +
            "<button onclick=\"cALBUMS.removeMedia(this,'${ id }')\" type=\"button\"><span class=\"dashicons dashicons-no\"><span class=\"screen-reader-text\">Close media panel</span></span></button>" +
            "</div>",
    uploadMedia: function () {
        var mtitle = "Upload Album Images"

        var mediaUploader = wp.media({
            title: mtitle,
            multiple: true,
            button: {
                text: 'Use as Album Image'
            },
            library: {
                type: 'image'
            },
        }).on('select', function () {
            var selection = mediaUploader.state().get('selection');
            nc.template("mediaTemplate", cALBUMS.imgMarkup);
            selection.map(function (attachment) {
                attachment = attachment.toJSON();
                nc.tmpl('mediaTemplate', attachment).appendTo("#album-images");
            });

        }).open();
    },
    addVideo:function(){
      var video_field = nc('#youtube_url'); 
      var vurl =  video_field.val();
      if(vurl ==''){
          alert('PLease add ayoutube video url');
      }else{
          var img_url = nc.jYoutube(vurl,'big');
          var videoData = {url:img_url,id:cALBUMS.getVideoId(vurl)}
           nc.template("videoTemplate", cALBUMS.videoMarkup);
           nc.tmpl('videoTemplate', videoData).appendTo("#album-videos");
           video_field.val('').focus();
      }
      
    },
    removeMedia: function (button, attachment_id) {
        nc('#attachment-' + attachment_id).fadeOut('slow', function () {
            nc(this).remove();
        });
    },
    getVideoId:function($url){
          var results = $url.match("[\\?&]v=([^&#]*)");
           var vid = (results === null) ? url : results[1];
           return vid;
    }
}
nc(document).ready(function () {
    cALBUMS.loadEvent();
});

(function ($) {
    $.extend({
        jYoutube: function (url, size) {
            if (url === null) {
                return "";
            }

            size = (size === null) ? "big" : size;
            var vid;
            var results;

            results = url.match("[\\?&]v=([^&#]*)");

            vid = (results === null) ? url : results[1];

            if (size == "small") {
                return "http://img.youtube.com/vi/" + vid + "/2.jpg";
            } else {
                return "http://img.youtube.com/vi/" + vid + "/0.jpg";
            }
        }
    })
})(jQuery); 