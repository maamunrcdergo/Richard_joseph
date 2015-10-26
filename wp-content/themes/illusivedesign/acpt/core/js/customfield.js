/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var nc = jQuery.noConflict();
var EditFields = {
    updateInput:function(input,$post_id){
      var  $input = nc(input);
      $input.addClass('loadding');
      nc.ajax({
          method:'POST',
          url:cfAjax.ajaxurl,
          data:{
              post_id:$post_id,
              meta_key:$input.attr('name'),
              meta_value:$input.val(),
              action:'edit_featured_fields'
          },
          dataType: 'json',
          success:function(responces){             
              $input.removeClass('loadding');
          }
      });
      
    },
    updateCheck:function(checkbox,$post_id){
      var  $checkbox = nc(checkbox);
      var  $is_featured = 0;
      $checkbox.toggleClass('featured');
      if($checkbox.hasClass('featured')){
          $is_featured = 1
      }
      nc.ajax({
          method:'POST',
          url:cfAjax.ajaxurl,
          data:{
              post_id:$post_id,
              meta_key:'is_featured',
              meta_value:$is_featured,
              action:'edit_featured_fields'
          },
          dataType: 'json',
          success:function(responces){      
             
          }
      });
      
    },
}
