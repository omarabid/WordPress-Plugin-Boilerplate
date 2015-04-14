<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_Options' ) ) {
    return;
}

/**
 * Options Panels 
 *
 * @class BP_Options
 * @package Inc
 * @subpackage Options 
 * @author Abid Omar
 */
class BP_Options {
    public $option_name;
    public $options;

    function __construct( $option_name, $options ) {

        $this->option_name = $option_name;
        $this->options = $options;

        // Load the Options Framework Plugin
        $adapter = new \devinsays\optionsframework\Adapter();

        // Enqueue the Options Framework CSS and JS files
        add_action( 'admin_enqueue_scripts', array( $adapter, 'enqueue_admin_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $adapter, 'enqueue_admin_scripts' ) );

        // Register the Settings Form
        add_action( 'admin_init', array( &$this, 'settings_form' ) );
    }

    public function settings_form() {
        register_setting( $this->option_name, $this->option_name );
    }

    public function build_panel() {
        require_once(  'options-template.php' );
    }
}
