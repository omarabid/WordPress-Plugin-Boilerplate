<?php
namespace devinsays\optionsframework;

class Adapter {
	function __construct() {
		require_once( 'src/includes/class-options-framework.php' );
		require_once( 'src/includes/class-options-interface.php' );
		require_once( 'src/includes/class-options-media-uploader.php' );
		require_once( 'src/includes/class-options-sanitization.php' );
	}

	public function enqueue_admin_styles() {
		wp_enqueue_style( 'optionsframework', plugin_dir_url( __FILE__ ) . 'src/css/optionsframework.css', array() );
		wp_enqueue_style( 'wp-color-picker' );
	}

	public function enqueue_admin_scripts() {	
		wp_enqueue_script( 'options-custom', plugin_dir_url( __FILE__ ) . 'src/js/options-custom.js', array( 'jquery','wp-color-picker' ) );
        if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
        }
		wp_register_script( 'of-media-uploader', plugin_dir_url( __FILE__ ) .'src/js/media-uploader.js', array( 'jquery' ) );
		wp_enqueue_script( 'of-media-uploader' );
		wp_localize_script( 'of-media-uploader', 'optionsframework_l10n', array(
			'upload' => __( 'Upload', 'options-framework' ),
			'remove' => __( 'Remove', 'options-framework' )
		) );
	}
}
