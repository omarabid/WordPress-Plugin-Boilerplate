<?php
/**
 * WordPress Plugin BoilerPlate
 *
 * @version {{@version}}
 * @package Main
 * @author Abid Omar
 */
/*
  Plugin Name: PluginBoilerplate
  Plugin URI: http://omarabid.com
  Description: Plugin Description.
  Author: Abid Omar
  Author URI: http://omarabid.com
  Version: {{@version}}
  Text Domain: wpbp
  License: GPLv3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'BoilerPlate' ) ) {
    /**
     * The main class and initialization point of the plugin.
     * Change the class name to XxxYxx where it relates to your
     * plugin name. Try to avoid using popular and common words
     * to avoid collusion with other plugins.
     */
    final class BoilerPlate {

        /**
         * The only instance of the class
         *
         * @var BoilerPlate
         * @since 1.0
         */
        private static $instance;

        /**
         * The Plug-in version.
         *
         * @var string
         * @since 1.0
         */
        public $version = '{{@version}}';

        /**
         * The minimal required version of WordPress for this plug-in to function correctly.
         *
         * @var string
         * @since 1.0
         */
        public $wp_version = '4.0';

        /**
         * Class name
         *
         * @var string
         * @since 1.0
         */
        public $class_name;

        /**
         * An array of defined constants names
         *
         * @var array
         * @since 1.0
         */
        public $defined_constants;

        /**
         * Create a new instance of the main class
         *
         * @since 1.0
         * @static
         * @return BoilerPlate
         */
        public static function instance() {
            $class_name = get_class();
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof $class_name ) ) {
                self::$instance = new $class_name;
                self::$instance->debugging = new \wpplex\WP_DebugBar\WP_DebugBar();
				self::$instance->options_framework = new \wpplex\WP_Options\WP_Options( 'myoptions' );
				self::$instance->app = new \wpplex\WP_MVC\WP_MVC( WPBP_DIR . '/app' );
            }

            return self::$instance;
        }

        /**
         * Construct and start the other plug-in functionality
         *
         * @since 1.0
         * @public
         */
        public function __construct() {
            // Save the class name for later use
            $this->class_name = get_class();

            //
            // 1. Plug-in requirements
            //
            if ( ! $this->check_requirements() ) {
                return;
            }

            //
            // 2. Declare constants and load dependencies
            //
            $this->define_constants();
            $this->load_dependencies();

            //
            // 3. Activation Hooks
            //
            register_activation_hook( __FILE__, array( &$this, 'activate' ) );
            register_deactivation_hook( __FILE__, array( &$this, 'deactivate' ) );	

            //
            // 4. i18n
            //
            add_action( 'init', array( &$this, 'i18n' ) );

            //
            // 5. Actions
            //
            add_action( 'plugins_loaded', array( &$this, 'start' ), 0, 100 );
        }

        /**
         * Throw error on object clone.
         *
         * Cloning instances of the class is forbidden.
         *
         * @since 1.0
         * @return void
         */
        public function __clone() {
            _doing_it_wrong( __FUNCTION__, __( 'Cloning instances of the class is forbidden.', 'wp-bp' ), '1.0' );
        }

        /**
         * Disable unserializing of the class
         *
         * Unserializing instances of the class is forbidden.
         *
         * @since 1.0
         * @return void
         */
        public function __wakeup() {
            _doing_it_wrong( __FUNCTION__, __( 'Unserializing instances of the class is forbidden.', 'wp-bp' ), '1.0' );
        }

        /**
         * Checks that the WordPress setup meets the plugin requirements
         * @global string $wp_version
         * @return boolean
         */
        private function check_requirements() {
            global $wp_version;
            if ( ! version_compare( $wp_version, $this->wp_version, '>=' ) ) {
                add_action( 'admin_notices', array( &$this, 'display_req_notice' ) );

                return false;
            }

            return true;
        }

        /**
         * Display the requirement notice
         * @static
         */
        public function display_req_notice() {
            echo '<div id="message" class="error"><p><strong>';
            echo __( 'Sorry, PluginBoilerPlate requires WordPress ' . $this->wp_version . ' or higher.
                Please upgrade your WordPress setup', 'wp-pb' );
            echo '</strong></p></div>';
        }

        /**
         * Define constants needed across the plug-in.
         */
        private function define_constants() {
            $this->define( 'WPBP_FILE', __FILE__ );
            $this->define( 'WPBP_BASENAME', plugin_basename( __FILE__ ) );
            $this->define( 'WPBP_DIR', dirname( __FILE__ ) );
            $this->define( 'WPBP_FOLDER', plugin_basename( dirname( __FILE__ ) ) );
            $this->define( 'WPBP_ABSPATH', trailingslashit( str_replace( '\\', '/', WP_PLUGIN_DIR . '/' . plugin_basename( dirname( __FILE__ ) ) ) ) );
            $this->define( 'WPBP_URLPATH', trailingslashit( WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) ) );
            $this->define( 'WPBP_ADMINPATH', get_admin_url() );	
        }

        /**
         * Define constant if not already set
         * @param  string $name
         * @param  string|bool $value
         */
        private function define( $name, $value ) {
            if ( ! defined( $name ) ) {
                define( $name, $value );
                $this->defined_constants[] = $name;
            }
        }

        /**
         * Loads PHP files that required by the plug-in
         */
        private function load_dependencies() {
            // Global
			require_once( 'vendor/autoload.php' );

            // Admin Panel
            if ( is_admin() ) {
            
            }

            // Front-End Site
            if ( ! is_admin() ) {

            }
        }

        /**
         * Called every time the plug-in is activated.
         */
        public function activate() {

        }

        /**
         * Called when the plug-in is deactivated.
         */
        public function deactivate() {

        }

        /**
         * Internationalization.
         * Loads the plugin language files
         *
         * @access public
         * @return void
         */
        public function i18n() {
            // Set filter for plugin's languages directory
            $lang_dir = WPBP_FOLDER . '/i18n/languages/';
            $lang_dir = apply_filters( 'bp_languages_directory', $lang_dir );

            // Traditional WordPress plugin locale filter
            $locale = apply_filters( 'plugin_locale', get_locale(), 'wpbp' );
            $mofile        = sprintf( '%1$s-%2$s.mo', 'wpbp', $locale );

            // Setup paths to current locale file
            $mofile_local  = $lang_dir . $mofile;
            $mofile_global = WP_LANG_DIR . '/wpbp/' . $mofile;

            if ( file_exists( $mofile_global ) ) {
                // Look in global /wp-content/languages/wpbp folder
                load_textdomain( 'wpbp', $mofile_global );
            } elseif ( file_exists( $mofile_local ) ) {
                // Look in local /wp-content/plugins/wpbp/languages/ folder
                load_textdomain( 'wpbp', $mofile_local );
            } else {
                // Load the default language files
                load_plugin_textdomain( 'wpbp', false, $lang_dir );
            }
        }

        /**
         * Starts the plug-in main functionality
         */
        public function start() {
        }

    }

}

/*
 * Creates a new instance of the BoilerPlate Class
 */
function WPBP() {
    return BoilerPlate::instance();
}

WPBP();
