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
$options = array();

// Test data
	$test_array = array(
		'one' => __( 'One', 'theme-textdomain' ),
		'two' => __( 'Two', 'theme-textdomain' ),
		'three' => __( 'Three', 'theme-textdomain' ),
		'four' => __( 'Four', 'theme-textdomain' ),
		'five' => __( 'Five', 'theme-textdomain' )
	);
	// Multicheck Array
	$multicheck_array = array(
		'one' => __( 'French Toast', 'theme-textdomain' ),
		'two' => __( 'Pancake', 'theme-textdomain' ),
		'three' => __( 'Omelette', 'theme-textdomain' ),
		'four' => __( 'Crepe', 'theme-textdomain' ),
		'five' => __( 'Waffle', 'theme-textdomain' )
	);
	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);
	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );
	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}
	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';
	$options = array();
	$options[] = array(
		'name' => __( 'Basic Settings', 'theme-textdomain' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __( 'Input Text Mini', 'theme-textdomain' ),
		'desc' => __( 'A mini text input field.', 'theme-textdomain' ),
		'id' => 'example_text_mini',
		'std' => 'Default',
		'class' => 'mini',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( 'Input Text', 'theme-textdomain' ),
		'desc' => __( 'A text input field.', 'theme-textdomain' ),
		'id' => 'example_text',
		'std' => 'Default Value',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( 'Input with Placeholder', 'theme-textdomain' ),
		'desc' => __( 'A text input field with an HTML5 placeholder.', 'theme-textdomain' ),
		'id' => 'example_placeholder',
		'placeholder' => 'Placeholder',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( 'Textarea', 'theme-textdomain' ),
		'desc' => __( 'Textarea description.', 'theme-textdomain' ),
		'id' => 'example_textarea',
		'std' => 'Default Text',
		'type' => 'textarea'
	);
	$options[] = array(
		'name' => __( 'Input Select Small', 'theme-textdomain' ),
		'desc' => __( 'Small Select Box.', 'theme-textdomain' ),
		'id' => 'example_select',
		'std' => 'three',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $test_array
	);
	$options[] = array(
		'name' => __( 'Input Select Wide', 'theme-textdomain' ),
		'desc' => __( 'A wider select box.', 'theme-textdomain' ),
		'id' => 'example_select_wide',
		'std' => 'two',
		'type' => 'select',
		'options' => $test_array
	);
	if ( $options_categories ) {
		$options[] = array(
			'name' => __( 'Select a Category', 'theme-textdomain' ),
			'desc' => __( 'Passed an array of categories with cat_ID and cat_name', 'theme-textdomain' ),
			'id' => 'example_select_categories',
			'type' => 'select',
			'options' => $options_categories
		);
	}
	if ( $options_tags ) {
		$options[] = array(
			'name' => __( 'Select a Tag', 'options_check' ),
			'desc' => __( 'Passed an array of tags with term_id and term_name', 'options_check' ),
			'id' => 'example_select_tags',
			'type' => 'select',
			'options' => $options_tags
		);
	}
	$options[] = array(
		'name' => __( 'Select a Page', 'theme-textdomain' ),
		'desc' => __( 'Passed an pages with ID and post_title', 'theme-textdomain' ),
		'id' => 'example_select_pages',
		'type' => 'select',
		'options' => $options_pages
	);
	$options[] = array(
		'name' => __( 'Input Radio (one)', 'theme-textdomain' ),
		'desc' => __( 'Radio select with default options "one".', 'theme-textdomain' ),
		'id' => 'example_radio',
		'std' => 'one',
		'type' => 'radio',
		'options' => $test_array
	);
	$options[] = array(
		'name' => __( 'Example Info', 'theme-textdomain' ),
		'desc' => __( 'This is just some example information you can put in the panel.', 'theme-textdomain' ),
		'type' => 'info'
	);
	$options[] = array(
		'name' => __( 'Input Checkbox', 'theme-textdomain' ),
		'desc' => __( 'Example checkbox, defaults to true.', 'theme-textdomain' ),
		'id' => 'example_checkbox',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => __( 'Advanced Settings', 'theme-textdomain' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __( 'Check to Show a Hidden Text Input', 'theme-textdomain' ),
		'desc' => __( 'Click here and see what happens.', 'theme-textdomain' ),
		'id' => 'example_showhidden',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => __( 'Hidden Text Input', 'theme-textdomain' ),
		'desc' => __( 'This option is hidden unless activated by a checkbox click.', 'theme-textdomain' ),
		'id' => 'example_text_hidden',
		'std' => 'Hello',
		'class' => 'hidden',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( 'Uploader Test', 'theme-textdomain' ),
		'desc' => __( 'This creates a full size uploader that previews the image.', 'theme-textdomain' ),
		'id' => 'example_uploader',
		'type' => 'upload'
	);
	$options[] = array(
		'name' => "Example Image Selector",
		'desc' => "Images for layout.",
		'id' => "example_images",
		'std' => "2c-l-fixed",
		'type' => "images",
		'options' => array(
			'1col-fixed' => $imagepath . '1col.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png'
		)
	);
	$options[] = array(
		'name' =>  __( 'Example Background', 'theme-textdomain' ),
		'desc' => __( 'Change the background CSS.', 'theme-textdomain' ),
		'id' => 'example_background',
		'std' => $background_defaults,
		'type' => 'background'
	);
	$options[] = array(
		'name' => __( 'Multicheck', 'theme-textdomain' ),
		'desc' => __( 'Multicheck description.', 'theme-textdomain' ),
		'id' => 'example_multicheck',
		'std' => $multicheck_defaults, // These items get checked by default
		'type' => 'multicheck',
		'options' => $multicheck_array
	);
	$options[] = array(
		'name' => __( 'Colorpicker', 'theme-textdomain' ),
		'desc' => __( 'No color selected by default.', 'theme-textdomain' ),
		'id' => 'example_colorpicker',
		'std' => '',
		'type' => 'color'
	);
	$options[] = array( 'name' => __( 'Typography', 'theme-textdomain' ),
		'desc' => __( 'Example typography.', 'theme-textdomain' ),
		'id' => "example_typography",
		'std' => $typography_defaults,
		'type' => 'typography'
	);
	$options[] = array(
		'name' => __( 'Custom Typography', 'theme-textdomain' ),
		'desc' => __( 'Custom typography options.', 'theme-textdomain' ),
		'id' => "custom_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options
	);
	$options[] = array(
		'name' => __( 'Text Editor', 'theme-textdomain' ),
		'type' => 'heading'
	);
	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */
	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress,wplink' )
	);
	$options[] = array(
		'name' => __( 'Default Text Editor', 'theme-textdomain' ),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'theme-textdomain' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);
            $class_name = get_class();
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof $class_name ) ) {
                self::$instance = new $class_name;

                self::$instance->autoloader = new BP_Autoloader();
                self::$instance->debugging = new BP_Utils_Debugging();
                self::$instance->logging = new BP_Utils_Logging();	
				self::$instance->options = new BP_Options( 'myoptions', $options );
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
            // 4. Load Widgets
            //
            add_action( 'widgets_init', array( &$this, 'register_widget' ) );

            //
            // 5. i18n
            //
            add_action( 'init', array( &$this, 'i18n' ) );

            //
            // 6. Actions
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
            require_once( 'inc/class-autoloader.php' );	
			require_once( 'vendor/autoload.php' );

            // Admin Panel
            if ( is_admin() ) {
                require_once( 'admin/forms.php' );
                require_once( 'admin/notifications.php' );
                require_once( 'admin/tables.php' );
                require_once( 'admin/admin.php' );
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
         * Called when the plug-in is uninstalled
         */
        static function uninstall() {

        }

        /**
         * Register the widgets
         */
        public function register_widget() {
            register_widget( 'BP_Widgets_Main' );
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
