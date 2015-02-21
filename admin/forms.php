<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @file
 *
 * This class draws the form fields HTML Code. It's a collection of static
 * functions that can be used without initiation. They were wrapped in a class
 * for encapsulation.
 */
if ( ! class_exists( 'wp_admin_forms' ) ) {
	class wp_admin_forms {
		/**
		 * Renders Section description
		 */
		static function section_description() {
			echo '';
		}

		/**
		 * Renders a TextBox
		 *
		 * @param array $args
		 */
		static function textbox( $args ) {
			// Defaults init.
			$default = array( 'id' => '', 'text' => '', 'value' => '', 'settings' => '' );
			$args    = array_merge( $default, $args );

			// Current Status
			$settings = get_option( $args['settings'] );
			if ( isset( $settings[ $args['id'] ] ) ) {
				$args['value'] = $settings[ $args['id'] ];
			}

			// Display the control
			echo '<input name="' . $args['settings'] . '[' . $args['id'] . ']" id="' . $args['id'] . '" value="' . $args['value'] . '" > ' . $args['text'];
		}

		/**
		 * Renders a TextArea
		 *
		 * @param $args
		 */
		static function textarea( $args ) {
			// Defaults init.
			$default = array( 'id' => '', 'text' => '', 'value' => '', 'settings' => '' );
			$args    = array_merge( $default, $args );

			// Current Status
			$settings = get_option( $args['settings'] );
			if ( isset( $settings[ $args['id'] ] ) ) {
				$args['value'] = $settings[ $args['id'] ];
			}

			// Display the control
			echo '<textarea name="' . $args['settings'] . '[' . $args['id'] . ']" id="' . $args['id'] . '">' . $args['value'] . '</textarea> ' . $args['text'];
		}

		/**
		 * Renders a Checkbox
		 *
		 * @param $args
		 */
		static function checkbox( $args ) {
			// Defaults init.
			$default = array( 'id' => '', 'text' => '', 'checked' => '', 'settings' => '' );
			$args    = array_merge( $default, $args );

			// Current Status
			$settings = get_option( $args['settings'] );
			if ( isset( $settings[ $args['id'] ] ) ) {
				$args['checked'] = 'checked';
			}

			// Display the control
			echo '<input name="' . $args['settings'] . '[' . $args['id'] . ']" id="' . $args['id'] . '" ' . $args['checked'] . ' type="checkbox" > ' . $args['text'];
		}

		/**
		 * Renders a Button
		 *
		 * @param $args
		 */
		static function button( $args ) {
			// Defaults init.
			$default = array( 'id' => '', 'text' => '', 'value' => '', 'class' => 'button-primary' );
			$args    = array_merge( $default, $args );

			// Set the button query
			$params       = array_merge( $_GET, array( 'action' => $args['id'] ) );
			$query_string = http_build_query( $params );
			$url          = 'admin.php?' . $query_string;

			// Display the control
			echo '<a href="' . $url . '" class="' . $args['class'] . '">' . $args['value'] . '</a> ' . $args['text'];
		}

		/**
		 * Generate a Form
		 *
		 * @param $form_id
		 * @param array $sections
		 * @param string $form_class
		 * @param bool $return
		 *
		 * @return string $html
		 */
		static function generate_form( $form_id, $sections = array(), $form_class = '', $return = true ) {
			// Determine the page Path
			if ( isset( $_SERVER['REQUEST_URI'] ) ) {
				$url = $_SERVER['REQUEST_URI'];
			} else {
				$url = admin_url();
			}

			// Generate the Form
			$html = '<form action="options.php" method="post" class="' . $form_class . '">';
			$html .= self::get_form_output( $form_id, $sections );
			$html .= '<input type="hidden" name="_wp_http_referer" value="' . $url . '"/>';
			$html .= '<p class="submit">';
			$html .= '<input name="Submit" type="submit" class="button-primary" value="Save Changes"/>';
			$html .= '</p>';
			$html .= '</form>';

			// Return or Print the form
			if ( ! $return ) {
				echo $html;
			}
			return $html;
		}

		/**
		 * Get the output of the WordPress settings functions
		 *
		 * @param string $form_id
		 * @param array $sections
		 *
		 * @return string $output
		 */
		static function get_form_output( $form_id, $sections = array() ) {
			ob_start();
			settings_fields( $form_id );
			foreach ( $sections as $section ) {
				do_settings_sections( $section );
			}
			$output = ob_get_contents();
			ob_end_clean();

			return $output;
		}
	}
}
