<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
   exit;
}

/**
 * @file
 *
 * The Admin Panel and related tasks are handled in this file.
 */
if (!class_exists('wp_pb_admin')) {
   class wp_pb_admin
   {
	  /**
	   * Admin Panel Pages
	   * @var array
	   */
	  static $pages = array();

	  /**
	   * Creates the admin panel
	   */
	  public function __construct()
	  {
		 //
		 // 1. Admin Menu
		 //
		 add_action('admin_menu', array(&$this, 'admin_menu'));

		 //
		 // 2. Load Scripts and Styles
		 //
		 add_action('admin_print_scripts', array(&$this, 'load_scripts'));
		 add_action('admin_print_styles', array(&$this, 'load_styles'));


		 //
		 // 3. Generate Settings and template forms
		 //
		 add_action('admin_init', array(&$this, 'settings_form'));

		 //
		 // 4. Execute any action
		 //
		 $this->action_hook();

		 //
		 // 5. Contextual help
		 //
		 add_filter('contextual_help', array(&$this, 'showhelp'));
	  }

	  /**
	   * This function inserts the plug-in menu to the WordPress menu
	   */
	  public function admin_menu()
	  {
		 // Create a top menu page
		 add_menu_page('WordPress Plugin BoilerPlate', 'Plugin', 'manage_options', 'page-id-1', array(&$this, 'menu_hook'));

		 // Create Submenus
		 self::$pages['page-1'] = add_submenu_page('page-id-1', 'WordPress Plugin BoilerPlate', 'Page 1', 'manage_options', 'page-id-1', array(&$this, 'menu_hook'));
		 self::$pages['page-2'] = add_submenu_page('page-id-1', 'WordPress Plugin BoilerPlate', 'Page 2', 'manage_options', 'page-id-2', array(&$this, 'menu_hook'));
	  }

	  /**
	   * This function routes the different admin pages
	   */
	  public function menu_hook()
	  {
		 $screen = get_current_screen();
		 switch ($screen->id) {
		 default:
		 case self::$pages['page-1']:
			require_once('pages/page1.php');
			break;
		 case self::$pages['page-2']:
			require_once('pages/page2.php');
			break;
		 }
	  }

	  /**
	   * This function load the scripts used by the Admin Panel
	   */
	  public function load_scripts()
	  {
		 $screen = get_current_screen();
		 switch ($screen->id) {
		 case self::$pages['page-1']:
			wp_enqueue_script('pb-script-1', PB_URLPATH . 'admin/files/js/script.js');
			break;
		 case self::$pages['page-2']:
			break;
		 }
	  }

	  /**
	   * This function load the styles used by the Admin Panel
	   */
	  public function load_styles()
	  {
		 $screen = get_current_screen();
		 switch ($screen->id) {
		 case self::$pages['page-1']:
			wp_enqueue_style('pb-script-1', PB_URLPATH . 'admin/files/css/style.css');
			break;
		 case self::$pages['page-2']:
			break;
		 }
	  }

	  /**
	   * This function declares the different forms, sections and fields.
	   */
	  public function settings_form()
	  {
		 register_setting('pb_settings', 'pb_settings', array(&$this, 'validate'));

		 // General Settings
		 add_settings_section('general_section', 'General Settings', 'wp_admin_forms::section_description', 'pb_general_section');
		 add_settings_field('text_field', 'Text Field', 'wp_admin_forms::textbox', 'pb_general_section', 'general_section', array('id' => 'text_field', 'text' => '', 'settings' => 'pb_settings'));
		 add_settings_field('checkbox_field', 'Checkbox Field', 'wp_admin_forms::checkbox', 'pb_general_section', 'general_section', array('id' => 'checkbox_field', 'text' => '', 'settings' => 'pb_settings'));
		 add_settings_field('textarea_field', 'Textbox Field', 'wp_admin_forms::textarea', 'pb_general_section', 'general_section', array('id' => 'textarea_field', 'settings' => 'pb_settings'));
	  }

	  /**
	   * This functions validate the submitted user input.
	   * @param array $var
	   * @return array
	   */
	  public function validate($var)
	  {
		 return $var;
	  }

	  /**
	   * Use this function to execute actions
	   */
	  public function action_hook()
	  {
		 if (!isset($_GET['action'])) {
			return;
		 }
		 switch ($_GET['action']) {

		 }
	  }


	  /**
	   * This function displays the top bar scrollable help for each page
	   */
	  public function showhelp()
	  {
		 $screen = get_current_screen();
		 switch ($screen->id) {
		 case self::$pages['page-1']:
			$screen->add_help_tab(array(
			   'id' => 'my_help_tab',
			   'title' => 'Help',
			   'content' => "Page 1 Help"));
			break;
		 case self::$pages['page-2']:
			$screen->add_help_tab(array(
			   'id' => 'my_help_tab',
			   'title' => 'Help',
			   'content' => "Page 2 Help"));
			break;
		 }
	  }
   }
}

$pb_admin = new wp_pb_admin();
