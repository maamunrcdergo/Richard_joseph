<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Theme_Contact_Widget extends WP_Widget {

  /**
   * Sets up the widgets name etc
   */
  public function __construct() {
    parent::__construct(
        'theme_contact', __('Theme Contact Widget', 'mclinic'), array('description' => __('A Contact Widget', 'mclinic'),)
    );
  }

  /**
   * Outputs the content of the widget
   *
   * @param array $args
   * @param array $instance
   */
  public function widget($args, $instance) {
    $title = apply_filters('widget_contact_title', $instance['title']);
    $address = apply_filters('widget_contact_address', $instance['address']);
    $phone = apply_filters('widget_contact_phone', $instance['phone']);
    $fax = apply_filters('widget_contact_fax', $instance['fax']);
    $email = apply_filters('widget_contact_email', $instance['email']);
    $webaddress = apply_filters('widget_contact_webaddress', $instance['webaddress']);
    $visiting_hours = apply_filters('widget_contact_visiting_hours', $instance['visiting_hours']);

    echo $args['before_widget'];
    if (!empty($instance['title'])) {
      echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
    }
    echo '<div class="contact-inner">';
    echo '<ul class="contact-info">';
    $address = trim($address);
    if (!empty($address)) {
      printf('<li class="contact-item %1$s"><i class="fa fa-%2$s"></i><span>%3$s</span></li>', 'address', 'location-arrow', $address);
    }
    $phone = trim($phone);
    if (!empty($phone)) {
      printf('<li class="contact-item %1$s"><i class="fa fa-%2$s"></i><span>%3$s</span></li>', 'phone', 'phone', $phone);
    }
    $fax = trim($fax);
    if (!empty($fax)) {
      printf('<li class="contact-item %1$s"><i class="fa fa-%2$s"></i><span>%3$s</span></li>', 'fax', 'fax', $fax);
    }
    $email = trim($email);
    if (!empty($email)) {
      printf('<li class="contact-item %1$s"><i class="fa fa-%2$s"></i><span>%3$s</span></li>', 'fax', 'envelope', $email);
    }
    $webaddress = trim($webaddress);
    if (!empty($webaddress)) {
      printf('<li class="contact-item %1$s"><i class="fa fa-%2$s"></i><span>%3$s</span></li>', 'webaddress', 'globe', $webaddress);
    }
    $visiting_hours = trim($visiting_hours);
    if (!empty($visiting_hours)) {
      $vhours_array = explode(PHP_EOL, $visiting_hours);    
      $hcontent = '';
      foreach($vhours_array as $weekday){
        $hcontent .= '<span class="vtime">'.do_shortcode($weekday).'</span>';
      }
        printf('<li class="contact-item %1$s"><h3><i class="fa fa-plane"></i>%2$s</h3><p class="day-hours">%3$s</p></li>', 'visiting_hours', __('Visiting Hours:'), $hcontent);
    }
    echo '</ul>';

    echo '</div>';
    echo $args['after_widget'];
  }

  /**
   * Outputs the options form on admin
   *
   * @param array $instance The widget options
   */
  public function form($instance) {

    $title = !empty($instance['title']) ? $instance['title'] : __('', 'mclinic');
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>

    <?php
    $address = !empty($instance['address']) ? $instance['address'] : __('', 'mclinic');
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:'); ?></label> 
      <textarea class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>"><?php echo esc_attr($address); ?></textarea>

    </p>

    <?php
    $phone = !empty($instance['phone']) ? $instance['phone'] : __('', 'mclinic');
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:'); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>">

    </p>       

    <?php
    $fax = !empty($instance['fax']) ? $instance['fax'] : __('', 'mclinic');
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:'); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo esc_attr($fax); ?>">

    </p>

    <?php
    $email = !empty($instance['email']) ? $instance['email'] : __('', 'mclinic');
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email Address:'); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($email); ?>">

    </p>

    <?php
    $webaddress = !empty($instance['webaddress']) ? $instance['webaddress'] : __('', 'mclinic');
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('webaddress'); ?>"><?php _e('Web Address:'); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id('webaddress'); ?>" name="<?php echo $this->get_field_name('webaddress'); ?>" type="text" value="<?php echo esc_attr($webaddress); ?>">

    </p>

    <?php
    $visiting_hours = !empty($instance['visiting_hours']) ? $instance['visiting_hours'] : __('', 'mclinic');
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('visiting_hours'); ?>"><?php _e('Visiting Hours:'); ?></label> 
      <textarea rows="10" class="widefat" id="<?php echo $this->get_field_id('visiting_hours'); ?>" name="<?php echo $this->get_field_name('visiting_hours'); ?>"><?php echo esc_attr($visiting_hours); ?></textarea>

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
    $instance['address'] = (!empty($new_instance['address']) ) ? strip_tags($new_instance['address']) : '';
    $instance['phone'] = (!empty($new_instance['phone']) ) ? strip_tags($new_instance['phone']) : '';
    $instance['fax'] = (!empty($new_instance['fax']) ) ? strip_tags($new_instance['fax']) : '';
    $instance['email'] = (!empty($new_instance['email']) ) ? strip_tags($new_instance['email']) : '';
    $instance['webaddress'] = (!empty($new_instance['webaddress']) ) ? strip_tags($new_instance['webaddress']) : '';
    $instance['visiting_hours'] = (!empty($new_instance['visiting_hours']) ) ? strip_tags($new_instance['visiting_hours']) : '';
    return $instance;
  }

}
