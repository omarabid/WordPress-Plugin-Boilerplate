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
	protected $page_id = 'page-1';
	protected $title = 'Page 1 Title';
	protected $name = 'Page 1';
	protected $parent = false;
	protected $cap = 'manage_options';	
	protected $show = true;
}
