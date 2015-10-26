<?php
add_shortcode('quote-form', 'custom_quote_form_callback');
add_shortcode('quote-shortform', 'custom_quote_shortform_callback');
add_shortcode('quote-miniform', 'custom_quote_miniform_callback');
add_action('init', 'quote_action_javascript');
add_action('wp_ajax_quote_form_submit', 'quote_form_submit_callback');
add_action('wp_ajax_nopriv_quote_form_submit', 'quote_form_submit_callback');

add_action('wp_ajax_quote_shortform_submit', 'ajax_quote_shortform_submit_callback');
add_action('wp_ajax_nopriv_quote_shortform_submit', 'ajax_quote_shortform_submit_callback');

//add_action('wp_footer','load_quote_modal');

function custom_quote_form_callback() {
    if (!empty($_POST['action']) && $_POST['action'] == 'quote_form_submit') {
        $message = quote_form_submit_callback($_POST);
    }
    if (!empty($_POST['action']) && $_POST['action'] == 'quote_miniform') {
        $message = quote_form_imin_submit_callback($_POST);
    }
    $quote_options = get_option('quote_options');

    $quote_options = maybe_unserialize($quote_options);

    if (!empty($quote_options)) {
        extract($quote_options);
    }
    $caption_item1 = rand(10, 20);

    $caption_item2 = rand(10, 20);

    $pwishlist_options = @explode(PHP_EOL, $opt_pwishlist);

    $opt_budget_options = @explode(PHP_EOL, $opt_budget);

    $opt_timeline_options = @explode(PHP_EOL, $opt_timeline);

    $opt_hear_about_options = @explode(PHP_EOL, $opt_hear_about);

    $insurance_type_selected = @$_GET['product_list'];
    ?>

    <div class="qute-form-full">  
        <p id="quote-message" class="qf-items woo-sc-box <?php echo @$message['type']; ?> small full" <?php if (empty($message)) echo 'style="display:none"'; ?>><?php echo @$message['msg']; ?></p>         
        <?php
        global $post;
        $full_name = @$_POST['full_name'];
        if (!empty($full_name)) {
            $full_name_spt = explode(' ', $full_name);
            $first_name = current($full_name_spt);
            $last_name = end($full_name_spt);
        }
        $email_address = @$_POST['email_address'];
        $telephone_number = @$_POST['telephone_number'];
        $additional_comments = @$_POST['additional_comments'];
        ?>
        <form action="<?php echo get_permalink($post->ID); ?>" method="post" enctype="multipart/form-data" id="free-quote">

            <input type="hidden" name="action" value="quote_form_submit">   

            <fieldset class="forms">

                <h2>Your details</h2>
                <p class="qf-items"><label for="first_name">First Name  </label><input  type="text" class="qf-form-control qf-text" name="first_name" value="<?php echo @$first_name; ?>"></p>

                <p class="qf-items"><label for="last_name">Last Name   </label><input  type="text" class="qf-form-control qf-text" name="last_name" value="<?php echo @$last_name; ?>"></p>

                <p class="qf-items"><label for="email_address">Email Address   </label><input  required="" type="email" class="qf-form-control qf-text requiredField" name="email_address" value="<?php echo @$email_address; ?>"></p>

                <p class="qf-items"><label for="">Phone   </label><input type="text" class="qf-form-control qf-text" name="telephone_number" value="<?php echo @$telephone_number; ?>"></p>

                <p class="qf-items"><label for="Company">Company  </label><input type="text"  class="qf-form-control qf-text" name="company"></p>

                <p class="qf-items"><label for="city">City  </label><input type="text"  class="qf-form-control qf-text" name="city"></p>

                <p class="qf-items"><label for="website_url">Website URL  </label><input type="url"  class="qf-form-control qf-text" name="website_url"></p>

                <p class="qf-items"><label for="pwishlist">Project wishlist</label>

                    <span class="check-inline">

                        <?php
                        foreach ($pwishlist_options as $index => $wishlist) {

                            if ($index == 0)
                                echo '<span><input checked="" type="checkbox" class="qf-form-control qf-check" name="pwishlist[]" value="' . $wishlist . '"><b>' . $wishlist . '</b></span>';

                            else {

                                echo '<span><input  type="checkbox" class="qf-form-control qf-check" name="pwishlist[]" value="' . $wishlist . '"><b>' . $wishlist . '</b></span>';
                            }
                        }
                        ?>                  

                    </span>

                </p>

                <p class="qf-items"><label for="budget">Budget </label>

                    <select class="qf-form-control qf-select" name="budget" id="budget">

                        <option value="0" >Please Select</option>

                        <?php
                        foreach ($opt_budget_options as $type_options) {

                            if (!empty($opt_budget_options) && $opt_budget_options == trim($type_options))
                                echo '<option selected="" value="' . trim($type_options) . '">' . trim($type_options) . '</optiopn>';
                            else
                                echo '<option value="' . trim($type_options) . '">' . trim($type_options) . '</optiopn>';
                        }
                        ?>

                    </select>  

                </p>

                <p class="qf-items"><label for="timeline">Timeline</label>

                    <select class="qf-form-control qf-select" name="timeline" id="timeline">

                        <option value="0" >Please Select</option>

                        <?php
                        // setlocale(LC_MONETARY, 'en_US');

                        foreach ($opt_timeline_options as $type_options) {

                            $amount = trim($type_options);

                            echo '<option value="' . $amount . '">' . $amount . '</optiopn>';
                        }
                        ?>

                    </select>  

                </p>                

                <p class="qf-items"><label for="hear_about">How did you hear about us?   </label>

                    <select class="qf-form-control qf-select" name="hear_about" id="hear_about">

                        <option value="0" >Please Select</option>

                        <?php
                        // setlocale(LC_MONETARY, 'en_US');

                        foreach ($opt_hear_about_options as $province) {

                            $province = explode(':', $province);

                            $province[1] = empty($province[1]) ? $province[0] : $province[1];

                            echo '<option value="' . $province[0] . '">' . $province[1] . '</optiopn>';
                        }
                        ?>

                    </select>  

                </p>

                <p class="qf-items"><label for="upload_file">Upload request for proposal  </label><input type="file" name="upload_file" /></p>

                <p class="qf-items"><label for="your_customers">Who are your customers?  </label><textarea class="qf-form-control qf-area" name="your_customers"></textarea></p>

                <p class="qf-items"><label for="additional_comments">Additional comments  </label><textarea class="qf-form-control qf-area" name="additional_comments"><?php echo @$additional_comments; ?></textarea></p>



                <p class="qf-items"><label for="secquerty_code">Type Result  [ <?php echo $caption_item1 . ' &plus; ' . $caption_item2 . ' &equals; '; ?>]</label><input type="text" class="qf-form-control qf-text requiredField" name="secquerty_code" maxlength="4" required=""><input type="hidden" name="secquerty_result" value="<?php echo intval($caption_item1 + $caption_item2) ?>"></p>

                <p class="qf-items qsubmit"><input type="submit" value="Request a Quote" id="submit" name="submit" class="qf-form-control qf-submit"><input type="reset" value="Clear" id="reset" name="reset" class="qf-form-control qf-submit" ><span id="qf-ajax-loader"></span></p>
            </fieldset>   



        </form>

        <style type="text/css">

            #sidebar .widget_quote_form_widget{

                display: none;

            }

        </style> 

    </div>

    <?php
}

function quote_action_javascript() {

    if (is_admin()) {
        
    } else {

        wp_enqueue_style('datepicker', get_stylesheet_directory_uri() . '/quote/scripts/datepicker.css');

        wp_enqueue_style('qfstyle', get_stylesheet_directory_uri() . '/quote/scripts/qfstyle.css');
        wp_enqueue_script('modal', get_stylesheet_directory_uri() . '/quote/scripts/modal.js', array('jquery'), '1', true);
        wp_enqueue_script('quote-js', get_stylesheet_directory_uri() . '/quote/scripts/quote-js.js', array('jquery', 'jquery-ui-datepicker', 'modal'), '1', true);

        wp_localize_script('quote-js', 'QouteAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'loader_url' => get_stylesheet_directory_uri() . '/quote/images/loader.gif'));
    }
}

function quote_form_submit_callback($post_Data) {

    $quote_options = get_option('quote_options');
    $quote_options = maybe_unserialize($quote_options);



    $pwishlist = !empty($post_Data['pwishlist']) ? @implode(', ', $post_Data['pwishlist']) : 'Others';

    $budget = esc_attr($post_Data['budget']);

    $timeline = esc_attr($post_Data['timeline']);

    $hear_about = esc_attr($post_Data['hear_about']);

    $first_name = esc_attr($post_Data['first_name']);

    $last_name = esc_attr($post_Data['last_name']);

    $email_address = esc_attr($post_Data['email_address']);

    $your_customers = esc_attr($post_Data['your_customers']);

    $additional_comments = esc_attr($post_Data['additional_comments']);

    $company = esc_attr($post_Data['company']);

    $city = esc_attr($post_Data['city']);

    $website_url = esc_attr($post_Data['website_url']);

    $telephone_number = esc_attr($post_Data['telephone_number']);

    $secquerty_code = esc_attr($post_Data['secquerty_code']);

    $secquerty_result = esc_attr($post_Data['secquerty_result']);

    $address .='<address>City:' . $city;

    $address .='</address>';
    $attachment = '';
    if (!function_exists('wp_handle_upload'))
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    if (!empty($_FILES['upload_file'])) {
        $file = $_FILES['upload_file'];
        $upload = wp_handle_upload($file, array('test_form' => false));
        if (!empty($upload['url'])) {
            $upload['name'] = $file['name'];
            $attachment = !empty($upload['url']) ? $upload : '';
        }
    }
    $attachment_url = @$attachment['url'];
    if (intval($secquerty_code) != $secquerty_result) {
        return array('type' => 'error', 'msg' => "Invalid Security Code");
    } else {



        $search_term = array(
            '%%FIRSTNAME%%',
            '%%LASTNAME%%',
            '%%EMAILADDRESS%%',
            '%%PHONE%%',
            '%%COMPANY%%',
            '%%CITY%%',
            '%%WEBSITEURL%%',
            '%%PROJECTWISHLIST%%',
            '%%BUDGET%%',
            '%%TIMELINE%%',
            '%%HOWDIDYOUHEARABOUTUS%%',
            '%%WHOAREYOURCUSTOMERS%%',
            '%%ADDITIONALCOMMENTS%%',
            '%%ATTACHMENT%%',
        );

        $replace_value = array(
            $first_name,
            $last_name,
            $email_address,
            $telephone_number,
            $company,
            $city,
            $website_url,
            $pwishlist,
            $budget,
            $timeline,
            $hear_about,
            $your_customers,
            $additional_comments,
            $attachment_url
        );

        $mail_content = str_replace($search_term, $replace_value, $quote_options['message_template']);

        $mail_to = trim($quote_options['mail_to']);
        $mail_subject = $quote_options['mail_subject'];


        //$mail_cc = $quote_options['mail_cc'];
        // To send HTML mail, the Content-type header must be set

        $headers = 'MIME-Version: 1.0' . "\r\n";

        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";



        // Additional headers
        //$headers .= 'To: $mail_to <'.$mail_to.'>' . "\r\n";

        $headers .= 'From: ' . get_bloginfo('name') . ' <' . get_bloginfo('admin_email') . '>' . '\r\n';

        //if(!empty($mail_cc))
        //$headers .= 'Cc: '.$mail_cc.'\r\n';
        // $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";



        $mail_content = wpautop($mail_content);
        add_filter('wp_mail_content_type', 'quote_set_html_content_type');

        if (!empty($attachment)) {
            $mail_send = wp_mail($mail_to, $mail_subject, $mail_content, $headers, $attachment['file']);
        } else {
            $mail_send = wp_mail($mail_to, $mail_subject, $mail_content, $headers);
        }



        if ($mail_send) {
            return array('type' => 'success', 'msg' => "Thank you for your interest in Illusive Design! A project manager will be in touch with you soon.");
        } else {
            return array('type' => 'error', 'msg' => "Sorry, Your Mail could not be Sent.");
        }
    }
    return array('type' => 'error', 'msg' => "Sorry, Your Mail could not be Sent.");
}

function quote_set_html_content_type() {

    return 'text/html';
}

function custom_quote_shortform_callback($attrs) {

    $quote_options = get_option('quote_options');

    $quote_options = maybe_unserialize($quote_options);

    if (!empty($quote_options)) {
        extract($quote_options);
    }
    $caption_item3 = rand(10, 20);
    $caption_item4 = rand(5, 20);

    $pwishlist_options = @explode(PHP_EOL, $opt_pwishlist);
    $full_form_url = empty($attrs['action']) ? get_permalink($page_id) : $attrs['action'];
    $form = '<div class="qute-form-short">';
    $form .= '<form action="' . $full_form_url . '" method="post" enctype="multipart/form-data" class="quote-form-short">';
    $form .= '<input type="hidden" name="full_form_action" id="full_form_action" value="0" />';
    $form .= '<input type="hidden" name="action" value="quote_shortform_submit" />';
    $form .= '<p class="qf-items form-group">';
    $form .= '<label for="full_name">Full Name</label>';
    $form .= '<input  type="text" class="qf-form-control qf-text" name="full_name"  required="required">';
    $form .= '</p>';
    $form .= '<p class="qf-items form-group">';
    $form .= '<label for="email_address">Email Address</label>';
    $form .= '<input  type="text" class="qf-form-control qf-text" name="email_address"  required="required"/>';
    $form .= '</p>';
    $form .= '<p class="qf-items form-group">';
    $form .= '<label for="pwishlist">Message</label>';
    $form .= '<textarea name="additional_comments" required="required">';
    $form .= '</textarea>';
    $form .= '</p>';
    $form .='<p class="qf-items form-group">';
    $form .= '<label for="secquerty_code">Type Result  [ ' . $caption_item3 . ' &plus; ' . $caption_item4 . ' &equals; ]</label>';
    $form .= '<input type="text" class="qf-form-control qf-text requiredField" name="secquerty_code" maxlength="4" required="">';
    $form .= '<input type="hidden" name="secquerty_result" value="' . intval($caption_item3 + $caption_item4) . '">';
    $form .= '</p>';
    $form .= '<p class="qf-items form-group form-submit-wrap">';
    $form .= '<input type="submit" class="button custom small" name="submit" id="btn-form-submit" value="Submit">';
    //$form .= '<input type="submit" class="button custom small" name="submit_full" id="btn-form-submit-more" value="Details Submit">';
    $form .= '</p>';
    $form .= '</form>';
    $form .= '</div>';
    return $form;
}

function ajax_quote_shortform_submit_callback() {
    $result = array(
        'type' => 'error',
        'error_type' => ''
    );
    $secquerty_code = intval($_POST['secquerty_code']);
    $secquerty_result = intval($_POST['secquerty_result']);

    if ($secquerty_code != $secquerty_result) {
        $result['type'] = 'error';
        $result['error_type'] = 'secquerty';
        echo json_encode($result);
    } else {
        $result = quote_shortform_submit($_POST);
        if ($result['type'] == 'error') {
            $caption_item3 = rand(10, 20);
            $caption_item4 = rand(5, 20);
            $result['secquerty'] = array(
                'result' => intval($caption_item3 + $caption_item4),
                'label' => 'Type Result  [ ' . $caption_item3 . ' + ' . $caption_item4 . ' = ]',
            );
        }
        echo json_encode($result);
    }
    die();
}

function quote_shortform_submit($post_Data) {
    $quote_options = get_option('quote_options');
    $quote_options = maybe_unserialize($quote_options);

    $full_name = esc_attr($post_Data['full_name']);
    $email_address = esc_attr($post_Data['email_address']);
    $additional_comments = esc_attr($post_Data['additional_comments']);
    $mail_content = "Name : " . $full_name . '< br/>';
    $mail_content = "Email : " . $email_address . '< br/>';
    $mail_content .= wpautop($additional_comments);

    $mail_to = trim($quote_options['mail_to']);
    $mail_subject = 'Quick ' . $quote_options['mail_subject'];
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: ' . get_bloginfo('name') . ' <' . get_bloginfo('admin_email') . '>' . '\r\n';
    $mail_send = wp_mail($mail_to, $mail_subject, $mail_content, $headers);
    if ($mail_send) {
        return array('type' => 'success', 'msg' => "Thank you for your interest in Illusive Design! A project manager will be in touch with you soon.");
    } else {
        return array('type' => 'error', 'msg' => "Sorry, Your Mail could not be Sent.");
    }
}

function custom_quote_miniform_callback($attrs, $content) {
    $quote_options = get_option('quote_options');
    $quote_options = maybe_unserialize($quote_options);
    $page_id = $quote_options['page_id'];
    $full_form_url = empty($attrs['action']) ? get_permalink($page_id) : $attrs['action'];
    $html = '';

    $html .= '<div id="quote_miniform">';
    $html .= '<form class="quote_miniform" action="' . $full_form_url . '" method="post">';
    $html .= '<input type="hidden" name="action" value="quote_miniform"/>';
    $html .= wp_nonce_field('quote_miniform_nonce', 'miniform_nonce_field', TRUE, FALSE);
    $html .= '<p><label for="full_name">Name:</label> <input type="text" class="miniform-field" name="full_name" required=""> </p>';
    $html .= '<p><label for="email_address">Email: </label> <input type="email" class="miniform-field" name="email_address" required=""> </p>';
    $html .= '<p><label for="telephone_number">Phone: </label> <input type="text" class="miniform-field" name="telephone_number" required=""> </p>';
    $html .= '<p><input type="submit" value="Next" name="quote_miniform_submit" /></p>';
    $html .= '</form>';
    $html .= '</div>';
    return $html;
}

function quote_form_imin_submit_callback($post) {
    $full_name = @$post['full_name'];
   
    $email_address = @$post['email_address'];
    $telephone_number = @$post['telephone_number'];
    $quote_options = get_option('quote_options');
    $quote_options = maybe_unserialize($quote_options);
    $mail_to = trim($quote_options['mail_to']);
    $mail_subject = 'Get A Quote Minimum Request';
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: ' . get_bloginfo('name') . ' <' . get_bloginfo('admin_email') . '>' . '\r\n';
    $message = sprintf("Requested by %s, Email:%s, Phone:%s", $full_name,$email_address, $telephone_number);
    wp_mail($mail_to, $mail_subject, $message, $headers);
    return '';
}
