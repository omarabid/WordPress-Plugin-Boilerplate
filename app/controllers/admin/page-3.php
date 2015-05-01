<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_Admin_Controller_Page_3' ) ) {
	return;
}

/**
 * Admin Page 3 
 *
 * @class BP_Admin_Controller_Page_3
 * @package app/controllers/admin
 * @author Abid Omar
 */
class BP_Admin_Controller_Page_3 extends \wpplex\WP_MVC\Admin\Controller {
	/**
	 * Admin Page Id
	 * @var string
	 */
	protected $page_id = 'page-3';

	/**
	 * Admin Page Title
	 * @var string
	 */
	protected $title = 'Page 3 Title';

	/**
	 * Admin Page Menu Title
	 * @var string
	 */
	protected $name = 'Page 3';

	/**
	 * False if a top level menu, a string otherwise
	 * @var bool|string
	 */
	protected $parent = 'page-1';

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
	protected $view = 'BP_Admin_View_Page_3';

	/**
	 * Specify a model to load the data 
	 *
	 * @var string
	 */
	protected $model = 'BP_Admin_Model_Page_3';
}
