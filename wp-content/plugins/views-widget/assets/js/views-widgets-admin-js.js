/* 
 * Copyright (C) 2014 Anup
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
var nc = jQuery.noConflict();
var Views_Widget = {
    loadTexonomy: function($type, $texonomy, $terms) {
        var $post_type = nc($type).val();
        var tax_data = {action: views_widgets_settings.action, query: 'get_texonomy', post_type: $post_type};
        nc($type).prev('label').addClass('ajax-called');
        nc($terms).html('<li>Please Select Texonomy</li>');
        nc.ajax({
            url: views_widgets_settings.ajax_url,
            data: tax_data,
            method: 'POST',
            dataType: 'json',
            success: function($responce) {
                nc($type).prev('label').removeClass('ajax-called');
                nc($texonomy).html('');
                if ($responce.html != '') {
                    var new_options = nc($responce.html);
                    nc($texonomy).html(new_options);

                }
                Views_Widget.loadTerms($texonomy, $terms);
            }
        });
    },
    loadTerms: function($tex, $terms) {
        var $texonomy = nc($tex).val();

        var tax_data = {action: views_widgets_settings.action, query: 'get_terms', texonomy: $texonomy};
        nc($tex).prev('label').addClass('ajax-called');
        nc.ajax({
            url: views_widgets_settings.ajax_url,
            data: tax_data,
            method: 'POST',
            dataType: 'json',
            success: function($responce) {
                nc($tex).prev('label').removeClass('ajax-called');
                nc($terms).html('');
                if ($responce.html != '') {
                    var new_options = nc($responce.html);
                    nc($terms).html(new_options);
                }

            }
        });
    },
    uploadMedia: function($input) {       
        var mtitle = "Select Default Feature Image"
        var inputField = nc($input);       
        var mediaUploader = wp.media({
            title: mtitle,
            button: {
                text: 'Use as Default'
            },
            multiple: false,
        }).on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            nc(inputField).val(attachment.url);            
        }).open();
    },
    uiSortable:function(){
        nc('.views_widget .short-views').sortable();
    },
    uiAccordion:function(){
       nc( ".ww_accordion" ).accordion({
           heightStyle: "content"
       });
    }
};
nc(document).ready(function() {
   Views_Widget.uiSortable();
   Views_Widget.uiAccordion();
});
nc(document).ajaxSuccess(function(e, xhr, settings) {
  Views_Widget.uiSortable();
  Views_Widget.uiAccordion();
});
