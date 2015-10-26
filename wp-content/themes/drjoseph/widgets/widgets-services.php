<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Illusive_Services_Widgets extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        parent::__construct(
                'services_widget', __('Services Widget', ILLUSIVE_THEME), array('description' => __('A Services Widget', ILLUSIVE_THEME),)
        );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance) {


//        $sub_title = apply_filters('widget_sub_title', $instance['sub_title']);
//
//        $more_link = apply_filters('widget_more_link', $instance['more_link']);
//        $illusive_icon = apply_filters('widget_illusive_icon', $instance['illusive_icon']);


        $sub_title = !empty($instance['sub_title']) ? maybe_unserialize($instance['sub_title']) : array();
        $illusive_icon = !empty($instance['illusive_icon']) ? maybe_unserialize($instance['illusive_icon']) : array();
        $more_link = !empty($instance['more_link']) ? maybe_unserialize($instance['more_link']) : array();
        $wcontent = !empty($instance['wcontent']) ? maybe_unserialize($instance['wcontent']) : array();
        $link_text = !empty($instance['link_text']) ? maybe_unserialize($instance['link_text']) : array();
        $button_link = !empty($instance['button_link']) ? maybe_unserialize($instance['button_link']) : array();
//        $instance['show_more_link'] = (!empty($new_instance['show_more_link']) ) ? '1' : '0';
        $item_count = count($sub_title);


        echo $args['before_widget'];

        echo '<div class="widget-inner col-xs-12 col-sm-6">';

        echo '<div class="widget-caption">';
        for ($i = 0; $i < $item_count; $i++):
            if (!empty($more_link[$i]) && !empty($sub_title[$i])) {

                echo sprintf('<h3 class="wsub-title"> <a href="#%2$s" title="%1$s">%1$s</a><i class="%3$s"></i></h3>', $sub_title[$i], $more_link[$i], $illusive_icon[$i]);
            } else if (!empty($sub_title[$i])) {
                echo sprintf('<h3 class="wsub-title">%1$s</h3>', $sub_title[$i]);
            }
        endfor;

        echo '</div>';
        echo '</div>';
        echo '<div class="service_tab col-xs-12 col-sm-6">';

        for ($i = 0; $i < $item_count; $i++):
            if (!empty($more_link[$i]) && !empty($sub_title[$i])) {
                echo sprintf('<div id="%1$s" class="service_tab_content">', $more_link[$i]);
                echo sprintf('<h3 class="wsub-title">%1$s</h3>', $sub_title[$i]);
                if (!empty($wcontent[$i])) {
                    $wcontent[$i] = wpautop($wcontent[$i]);
                    echo sprintf('<div class="widget-exp">%1$s</div>', $wcontent[$i]);
                }
                if (!empty($link_text[$i]) && !empty($button_link[$i])) {
                    echo sprintf('<div class="widget-bottom"><a  class="more-links" href="%2$s" title="%1$s">%1$s</a></div>', $link_text[$i], $button_link[$i]);
                }
                echo sprintf('</div>');
            }

        endfor;
        echo '</div>';
        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance) {

        $icons = array(
            'none' => 'Select Icon',
            'illusive-icon-ecommerce' => 'ecommerce',
            'illusive-icon-website' => 'website',
            'illusive-icon-support-maintenance' => 'support-maintenance',
            'illusive-icon-phone' => 'phone',
            'illusive-icon-comments' => 'comments',
            'illusive-icon-branding' => 'branding',
            'illusive-icon-start-ups' => 'start-ups',
            'illusive-icon-businesses' => 'businesses',
            'illusive-icon-agencies' => 'agencies'
        );



        $sub_title = !empty($instance['sub_title']) ? maybe_unserialize($instance['sub_title']) : array();
        $illusive_icon = !empty($instance['illusive_icon']) ? maybe_unserialize($instance['illusive_icon']) : array();
        $more_link = !empty($instance['more_link']) ? maybe_unserialize($instance['more_link']) : array();
        $wcontent = !empty($instance['wcontent']) ? maybe_unserialize($instance['wcontent']) : array();
        $link_text = !empty($instance['link_text']) ? maybe_unserialize($instance['link_text']) : array();
        $button_link = !empty($instance['button_link']) ? maybe_unserialize($instance['button_link']) : array();
//        $instance['show_more_link'] = (!empty($new_instance['show_more_link']) ) ? '1' : '0';
        $item_count = count($sub_title);
        if ($item_count == 0):
            ?>
            <div class="repeater">
                <p>            
                    <label for="<?php echo $this->get_field_id('sub_title'); ?>"><?php _e('Title:'); ?></label> 
                    <input class="widefat" id="<?php echo $this->get_field_id('sub_title'); ?>" name="<?php echo $this->get_field_name('sub_title'); ?>[]" type="text" value="">
                </p>


                <p>            
                    <label for="<?php echo $this->get_field_id('more_link'); ?>"><?php _e('Link To:'); ?></label> 
                    <input class="widefat" id="<?php echo $this->get_field_id('more_link'); ?>" name="<?php echo $this->get_field_name('more_link'); ?>[]" type="text" value="">
                </p>

                <p>
                    <label for="<?php echo $this->get_field_id('illusive_icon'); ?>"><?php _e('Icon:'); ?></label> 
                    <select  data-target="#<?php echo $this->get_field_id('post_parent'); ?>" name="<?php echo $this->get_field_name('illusive_icon'); ?>[]" id="<?php echo $this->get_field_id('illusive_icon'); ?>">
                        <?php
                        //$post_types = get_post_types( array('public'=>TRUE,'hierarchical'=>TRUE));
                        foreach ($icons as $key => $key_value) {
                            $selected = '';
                            echo sprintf('<option class="%1$s" value="%1$s" style="font-size: 16px;line-height: 20px;margin-bottom: 5px;" %3$s>%2$s</option>', $key, $key_value, $selected);
                        }
                        ?>              
                    </select>
                </p>

                <p>            
                    <label for="<?php echo $this->get_field_id('wcontent'); ?>"><?php _e('Content:'); ?></label> 
                    <textarea rows="8" class="widefat" id="<?php echo $this->get_field_id('wcontent'); ?>" name="<?php echo $this->get_field_name('wcontent'); ?>[]" ></textarea>
                </p>
                <p>            
                    <label for="<?php echo $this->get_field_id('show_more_link'); ?>"><?php _e('Show More button:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('show_more_link'); ?>" name="<?php echo $this->get_field_name('show_more_link'); ?>" type="checkbox" value="1" <?php if (!empty($show_more_link)): ?> checked=""<?php endif; ?>></label> 

                </p>
                <p>            
                    <label for="<?php echo $this->get_field_id('link_text'); ?>"><?php _e('Button Text:'); ?></label> 
                    <input class="widefat" id="<?php echo $this->get_field_id('link_text'); ?>" name="<?php echo $this->get_field_name('link_text'); ?>[]" type="text" value="" placeholder="Read More">
                </p>
                <p>            
                    <label for="<?php echo $this->get_field_id('button_link'); ?>"><?php _e('Button Link:'); ?></label> 
                    <input class="widefat" id="<?php echo $this->get_field_id('button_link'); ?>" name="<?php echo $this->get_field_name('button_link'); ?>[]" type="text" value="">
                </p>
            </div>
            <?php
        else:
            for ($i = 0; $i < $item_count; $i++):
                ?>

                <div class="repeater">

                    <p>            
                        <label for="<?php echo $this->get_field_id('sub_title'); ?>"><?php _e('Title:'); ?></label> 
                        <input class="widefat" id="<?php echo $this->get_field_id('sub_title'); ?>" name="<?php echo $this->get_field_name('sub_title'); ?>[]" type="text" value="<?php echo @$sub_title[$i]; ?>">
                    </p>


                    <p>            
                        <label for="<?php echo $this->get_field_id('more_link'); ?>"><?php _e('Link To:'); ?></label> 
                        <input class="widefat" id="<?php echo $this->get_field_id('more_link'); ?>" name="<?php echo $this->get_field_name('more_link'); ?>[]" type="text" value="<?php echo @$more_link[$i]; ?>">
                    </p>

                    <p>
                        <label for="<?php echo $this->get_field_id('illusive_icon'); ?>"><?php _e('Icon:'); ?></label> 
                        <select  data-target="#<?php echo $this->get_field_id('post_parent'); ?>" name="<?php echo $this->get_field_name('illusive_icon'); ?>[]" id="<?php echo $this->get_field_id('illusive_icon'); ?>">
                            <?php
                            //$post_types = get_post_types( array('public'=>TRUE,'hierarchical'=>TRUE));
                            foreach ($icons as $key => $key_value) {
                                $selected = ($key == @$illusive_icon[$i]) ? ' selected="selected" ' : '';
                                echo sprintf('<option class="%1$s" value="%1$s" style="font-size: 16px;line-height: 20px;margin-bottom: 5px;" %3$s>%2$s</option>', $key, $key_value, $selected);
                            }
                            ?>              
                        </select>
                    </p>

                    <p>            
                        <label for="<?php echo $this->get_field_id('wcontent'); ?>"><?php _e('Content:'); ?></label> 
                        <textarea rows="8" class="widefat" id="<?php echo $this->get_field_id('wcontent'); ?>" name="<?php echo $this->get_field_name('wcontent'); ?>[]"  ><?php echo @$wcontent[$i]; ?></textarea>
                    </p>
<!--                    <p>            
                        <label for="<?php echo $this->get_field_id('show_more_link'); ?>"><?php _e('Show More button:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('show_more_link'); ?>" name="<?php echo $this->get_field_name('show_more_link'); ?>" type="checkbox" value="1" <?php if (!empty($show_more_link)): ?> checked=""<?php endif; ?>></label> 

                    </p>-->
                    <p>            
                        <label for="<?php echo $this->get_field_id('link_text'); ?>"><?php _e('Button Text:'); ?></label> 
                        <input class="widefat" id="<?php echo $this->get_field_id('link_text'); ?>" name="<?php echo $this->get_field_name('link_text'); ?>[]" type="text" value="<?php echo @$link_text[$i]; ?>" placeholder="Read More">
                    </p>
                    <p>            
                        <label for="<?php echo $this->get_field_id('button_link'); ?>"><?php _e('Button Link:'); ?></label> 
                        <input class="widefat" id="<?php echo $this->get_field_id('button_link'); ?>" name="<?php echo $this->get_field_name('button_link'); ?>[]" type="text" value="<?php echo @$button_link[$i]; ?>">
                    </p>
                </div>
            <?php endfor; ?>

        <?php endif; ?>
        <div class="additional"></div>
        <button type="button" class="add_field_button">Add More Fields</button>





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
        $instance['sub_title'] = (!empty($new_instance['sub_title']) ) ? maybe_serialize($new_instance['sub_title']) : '';
        $instance['more_link'] = (!empty($new_instance['more_link']) ) ? maybe_serialize($new_instance['more_link']) : '';
        $instance['illusive_icon'] = (!empty($new_instance['illusive_icon']) ) ? maybe_serialize($new_instance['illusive_icon']) : '';
        $instance['wcontent'] = (!empty($new_instance['wcontent']) ) ? maybe_serialize($new_instance['wcontent'], '<p><br><br><a><ul><li><ol><strong><b>') : '';
//        $instance['show_more_link'] = (!empty($new_instance['show_more_link']) ) ? '1' : '0';
        $instance['link_text'] = (!empty($new_instance['link_text']) ) ? maybe_serialize($new_instance['link_text']) : '';
        $instance['button_link'] = (!empty($new_instance['button_link']) ) ? maybe_serialize($new_instance['button_link']) : '';
        return $instance;
    }

}
