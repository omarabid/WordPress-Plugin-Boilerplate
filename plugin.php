<?php
/**
 * WordPress Plugin BoilerPlate
 *
 * @version 1.0.0
 * @package Main
 * @author Abid Omar
 */
/*
  Plugin Name: PluginBoilerplate
  Plugin URI: http://omarabid.com
  Description: Plugin Description.
  Author: Abid Omar
  Author URI: http://omarabid.com
  Version: 1.0.0
  Text Domain: wp-pb
  License: GPLv3
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
   exit;
}

if (!class_exists('wp_pb')) {
   /**
	* The main class and initialization point of the plugin.
	* Change the class name to wp_xxx where xxx relates to your
	* plugin name. Try to avoid using popular and common words
	* to avoid collusion with other plugins.
	*/
   class wp_pb
   {

	  /**
	   * The Plug-in version.
	   *
	   * @var string
	   */
	  public $version = "1.0";

	  /**
	   * The minimal required version of WordPress for this plug-in to function correctly.
	   *
	   * @var string
	   */
	  public $wp_version = "3.5";

	  /**
	   * Construct and start the other plug-in functionality
	   */
	  public function __construct()
	  {
		 //
		 // 1. Plug-in requirements
		 //
		 if (!$this->check_requirements()) {
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
		 register_activation_hook(__FILE__, array(&$this, 'activate'));
		 register_deactivation_hook(__FILE__, array(&$this, 'deactivate'));
		 register_uninstall_hook(__FILE__, 'wp_pb::uninstall');

		 //
		 // 4. Load Widget
		 //
		 add_action('widgets_init', array(&$this, 'register_widget'));

		 //
		 // 5. i18n
		 //
		 add_action('init', array(&$this, 'i18n'));

		 //
		 // 6. Actions
		 //
		 add_action('plugins_loaded', array(&$this, 'start'));
	  }

	  /**
	   * Checks that the WordPress setup meets the plugin requirements
	   * @global string $wp_version
	   * @return boolean
	   */
	  private function check_requirements()
	  {
		 global $wp_version;
		 if (!version_compare($wp_version, $this->wp_version, '>=')) {
			add_action('admin_notices', 'wp_pb::display_req_notice');
			return false;
		 }
		 return true;
	  }

	  /**
	   * Display the requirement notice
	   * @static
	   */
	  static function display_req_notice()
	  {
		 global $wp_pb;
		 echo '<div id="message" class="error"><p><strong>';
		 echo __('Sorry, BootstrapPress re requires WordPress ' . $wp_pb->wp_version . ' or higher.
			Please upgrade your WordPress setup', 'wp-pb');
		 echo '</strong></p></div>';
	  }

	  /**
	   * Define constants needed across the plug-in.
	   */
	  private function define_constants()
	  {
		 define('PB_BASENAME', plugin_basename(__FILE__));
		 define('PB_DIR', dirname(__FILE__));
		 define('PB_FOLDER', plugin_basename(dirname(__FILE__)));
		 define('PB_ABSPATH', trailingslashit(str_replace("\\", "/", WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__)))));
		 define('PB_URLPATH', trailingslashit(WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__))));
		 define('PB_ADMINPATH', get_admin_url());
	  }

	  /**
	   * Loads PHP files that required by the plug-in
	   */
	  private function load_dependencies()
	  {
		 // Admin Panel
		 if (is_admin()) {
			require_once('admin/forms.php');
			require_once('admin/admin.php');
		 }
		 // Front-End Site
		 if (!is_admin()) {

		 }
		 // Global
		 require_once('inc/widget.php');
	  }

	  /**
	   * Called every time the plug-in is activated.
	   */
	  public function activate()
	  {

	  }

	  /**
	   * Called when the plug-in is deactivated.
	   */
	  public function deactivate()
	  {

	  }

	  /**
	   * Called when the plug-in is uninstalled
	   */
	  static function uninstall()
	  {

	  }

	  /**
	   * Register the widgets
	   */
	  public function register_widget()
	  {
		 register_widget("wp_pb_widget");
	  }


	  /**
	   * Internationalization
	   */
	  public function i18n()
	  {
		 load_plugin_textdomain('wp-pb', false, basename(dirname(__FILE__)) . '/lang/');
	  }

	  /**
	   * Starts the plug-in main functionality
	   */
	  public function start()
	  {

	  }


   }

}

/*
 * Creates a new instance of the BoilerPlate Class
 */
global $wp_pb;
$wp_pb = new wp_pb();
