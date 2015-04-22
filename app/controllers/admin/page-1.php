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
class BP_Admin_Controller_Page_1 extends BP_MVC_Admin_Controller {
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
	 * Template id
	 * @var string
	 */
	protected $template = 'page-1';


	/**
	 * Specify a view to display the template
	 *
	 * @var string
	 */
	protected $view = 'BP_Admin_View_Page_1';
}
