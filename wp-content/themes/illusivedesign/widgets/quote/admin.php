<?php
require_once ( get_stylesheet_directory() . '/quote/shortcode.php' );
require_once ( get_stylesheet_directory() . '/quote/widgets.php' );
add_action( 'admin_menu', 'quote_admin_menu' );

/** Step 1. */
function quote_admin_menu() {
	add_submenu_page('options-general.php','Quote form setting', 'Quote form', 'manage_options', 'quote-form-setting', 'quote_form_setting_callback' );
}
function quote_form_setting_callback(){
    if(!empty($_POST['action']) && $_POST['action'] == 'quote-form-setting-submit'){
        $post_Data = stripslashes_deep($_POST['quote_options']);
        $options_serialize = maybe_serialize($post_Data); //maybe_unserialize( $original )
        
        $is_updated= update_option('quote_options',$options_serialize);
        if($is_updated){
           $message['type'] ='updated';
           $message['msg'] ='Settings saved.';
        }else{
           $message['type'] ='error';
           $message['msg'] ='Sorry no changed found.';
        }
    }
    $quote_options = get_option('quote_options');
    $quote_options = maybe_unserialize($quote_options);   
    if(!empty($quote_options)) {extract( $quote_options);}
   $mail_to = (empty($mail_to)) ? get_bloginfo('admin_email'):$mail_to;
   $message_template_default = "";
   $message_template = (empty($message_template)) ? $message_template_default:$message_template;
   ?>
<div class="wrap">
<div class="icon32" id="icon-options-general"><br></div><h2>Quote form setting</h2>
<div class="<?php echo @$message['type']?> settings-error" id="setting-error-settings_updated" <?php if(empty($message)):?> style="display: none" <?php endif;?>> 
    <p><strong><?php echo @$message['msg']?></strong></p>
 </div>
<form action="<?php echo admin_url('options-general.php?page=quote-form-setting');?>" method="post" enctype="multipart/form-data">   
    <input type="hidden" name="action" value="quote-form-setting-submit">
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row"><label for="opt_pwishlist">Select a page </label></th>
                        <td>
                            <select name="quote_options[page_id]">
                                <option value="0">--Select--</option>
                                <?php $pages = get_pages();
                                    foreach($pages as $page){
                                        $selected = ($page->ID == $page_id)? ' selected="true" ' : '' ;
                                         echo '<option value="'.$page->ID.'" '.$selected.'>'.$page->post_title.'</option>';
                                    }
                                ?>
                                
                    </select><br><i>where [quote-form] is placed. </i></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="opt_pwishlist">Project wishlist</label></th>
                <td><textarea class="regular-text" rows="5" cols="125" name="quote_options[opt_pwishlist]" id="opt_pwishlist" ><?php echo @$opt_pwishlist;?></textarea><br><i>Add item with new line</i></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="opt_budget">Budget</label></th>
                <td><textarea class="regular-text" rows="5" cols="125" name="quote_options[opt_budget]" id="opt_budget" ><?php echo @$opt_budget;?></textarea><br><i>Add item with new line</i></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="opt_timeline">Timeline  </label></th>
                <td><textarea class="regular-text" rows="5" cols="125" name="quote_options[opt_timeline]" id="opt_timeline"><?php echo  @$opt_timeline;?></textarea><br><i>Add item with new line</i></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="opt_hear_about">How did you hear about us?   </label></th>
                <td><textarea class="regular-text" rows="5" cols="125" name="quote_options[opt_hear_about]" id="opt_hear_about"><?php echo  @$opt_hear_about;?></textarea><br><i>Add item with new line</i></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="coverage_amount">Mail To </label></th>
                <td><input class="regular-text" type="email" name="quote_options[mail_to]" id="mail_to" value="<?php echo @$mail_to; ?>"/></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="mail_subject">Mail Subject</label></th>
                <td><input class="regular-text" type="text" name="quote_options[mail_subject]" id="mail_subject" value="<?php echo @$mail_subject; ?>"/></td>
            </tr>
            <tr valign="top" style="display: none">
                <th scope="row"><label for="mail_cc">Send a copy to</label></th>
                <td><input class="regular-text" type="text" name="quote_options[mail_cc]" id="mail_cc" value="<?php echo @$mail_cc; ?>"/></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="coverage_amount">Message template  </label></th>
                <td><textarea class="regular-text" rows="15" cols="125" name="quote_options[message_template]" id="coverage_amount"><?php echo  @$message_template;?></textarea>
                    <p>Shortcode :: <i>'%%FIRSTNAME%%', '%%LASTNAME%%', '%%EMAILADDRESS%%', '%%PHONE%%', '%%COMPANY%%', '%%CITY%%', '%%WEBSITEURL%%', '%%PROJECTWISHLIST%%', '%%BUDGET%%', '%%TIMELINE%%', '%%HOWDIDYOUHEARABOUTUS%%', '%%WHOAREYOURCUSTOMERS%%', '%%ADDITIONALCOMMENTS%%' </i></p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">&nbsp;</th>
                <td><input type="submit" class="button button-primary" value="Save settings"></td>
            </tr>
        </tbody>
    </table>
</form>
</div>
<?php
  
}
