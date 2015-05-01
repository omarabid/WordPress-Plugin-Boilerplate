<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_Admin_Controller_Page_1' ) ) {
	return;
}

/**
 * Admin Page 1 
 *
 * @class BP_Admin_Controller_Page_1 
 * @package app/controllers/admin
 * @author Abid Omar
 */
class BP_Admin_Controller_Page_1 extends \omarabid\WP_MVC\Admin\Controller {
	/**
	 * Admin Page Id
	 * @var string
	 */
	protected $page_id = 'page-1';

	/**
	 * Admin Page Title
	 * @var string
	 */
	protected $title = 'Page 1 Title';

	/**
	 * Admin Page Menu Title
	 * @var string
	 */
	protected $name = 'Page 1';

	/**
	 * False if a top level menu, a string otherwise
	 * @var bool|string
	 */
	protected $parent = false;

	/**
	 * Page access capability
	 * @var string
	 */
	protected $cap = 'manage_options';	

	/**
	 * Display or Hide the menu
	 * @var bool 
	 */
	protected $show = true;

	/**
	 * Specify a view to display the template
	 *
	 * @var string
	 */
	protected $view = 'BP_Admin_View_Page_1';

	/**
	 * Specify a model to load the data 
	 *
	 * @var string
	 */
	protected $model = 'BP_Admin_Model_Page_1';

	public function load_scripts() {
		wp_enqueue_script( 'page-1', WPBP_URLPATH . '/app/files/js/page-1.js', array( 'jquery' ) );
	}

	public function load_styles() {
		wp_enqueue_style( 'page-1', WPBP_URLPATH . '/app/files/css/page-1.css' );
	}

	public function contextual_help() {
		$screen = get_current_screen();

		$screen->add_help_tab( array(
			'id'      => 'my_help_tab',
			'title'   => 'Help',
			'content' => "Page 1 Help"
		) );
	}
}
