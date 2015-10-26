<?php
class QuoteWidget extends WP_Widget {

	function __construct() {
        parent::__construct(
            'quote_form_widget', // Base ID
            'Quote Form Widget', // Name
            array( 'description' => __( 'Quote form widget'), ) // Args
        );
       }

	function widget( $args, $instance ) {
		extract( $args );
                $title = apply_filters( 'widget_title', $instance['title'] );
                $form_action = apply_filters( 'widget_form_action', $instance['form_action'] );
                
                 
                $output ='';
                $output .= $before_widget;
                $title=trim($title);
                $title=empty( $title ) ? 'Get a <span class="ccolor">Quote</span>':$title ;               
                $output .= $before_title . html_entity_decode($title) . $after_title;                 
                $output .= do_shortcode('[quote-shortform action="'.$form_action.'"]');
                $output .= $after_widget;
                echo $output ;
	}

	function update( $new_instance, $old_instance ) {
		$instance = array();
                $instance['title'] = ( !empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
                $instance['form_action'] = ( !empty( $new_instance['form_action'] ) ) ? strip_tags( $new_instance['form_action'] ) : '';
                return $instance;
	}

	function form( $instance ) {
             $title = empty($instance[ 'title' ])? __( 'New title' ):$instance[ 'title' ];
             $form_action = empty($instance[ 'form_action' ])? get_site_url():$instance[ 'form_action' ];
             $action_method = empty($instance[ 'action_method' ])? 'GET':$instance[ 'action_method' ];
              $quote_list_items= empty($instance[ 'quote_list_items' ])? 'Item1,Item2,Item3':$instance[ 'quote_list_items' ];
	    
                
                ?>
                <p>
                <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
                </p>
                <p>
                <label for="<?php echo $this->get_field_name( 'form_action' ); ?>"><?php _e( 'Form action:' ); ?>(Page Url)</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'form_action' ); ?>" name="<?php echo $this->get_field_name( 'form_action' ); ?>" type="text" value="<?php echo esc_attr( $form_action ); ?>" />
                </p>                 
                <?php
	}
}

function theme_quote_custom_widgets() {
	register_widget( 'QuoteWidget' );
}

add_action( 'widgets_init', 'theme_quote_custom_widgets' );