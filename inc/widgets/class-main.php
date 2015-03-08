<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'BP_Widgets_Main' ) ) {
	/**
	 * Widget Boilerplate
	 */
	class BP_Widgets_Main extends WP_Widget {

		/**
		 * Constructor
		 *
		 * Registers the widget details with the parent class
		 */
		function __construct() {
			// widget actual processes
			parent::__construct( $id = 'wp_pb_widget', $name = 'WP Boilerplate', $options = array( 'description' => __( 'A boilerplate widget', 'wp-pb' ) ) );
		}

		/**
		 * Creates a form in the theme widgets page
		 *
		 * @param $instance
		 */
		function form( $instance ) {
			// outputs the options form on admin
			if ( $instance ) {
				$value = esc_attr( $instance['field'] );
			} else {
				$value = __( 'Field', 'wp-pb' );
			}
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'field' ); ?>"><?php _e( 'Field', 'wp-pb' ) ?></label><br/>
				<input class="widefat" id="<?php echo $this->get_field_id( 'field' ); ?>"
				       name="<?php echo $this->get_field_name( 'field' ); ?>" type="text"
				       value="<?php echo $value; ?>"/>
			</p>
		<?php
		}

		/**
		 * Update the form on submit
		 *
		 * @param $new_instance
		 * @param $old_instance
		 *
		 * @return array
		 */
		function update( $new_instance, $old_instance ) {
			$instance          = $old_instance;
			$instance['field'] = strip_tags( $new_instance['field'] );

			return $instance;
		}

		/**
		 * Displays the widget
		 *
		 * @param $args
		 * @param $instance
		 */
		function widget( $args, $instance ) {
			// Extract the content of the widget
			extract( $args );
			$value = apply_filters( 'widget_title', $instance['field'] );

			// Before Widget
			echo $before_widget;

			// Displays the title
			if ( $value ) {
				echo $before_title . $value . $after_title;
			}

			// After Widget
			echo $after_widget;
		}

	}
}
