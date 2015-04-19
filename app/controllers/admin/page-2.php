<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_Admin_Controller_Page_2' ) ) {
	return;
}

/**
 * Admin Page 2 
 *
 * @class BP_Admin_Controller_Page_2 
 * @package app/controllers/admin
 * @author Abid Omar
 */
class BP_Admin_Controller_Page_2 extends BP_MVC_Admin_Controller {
	protected $page_id = 'page-2';
	protected $title = 'Page 2 Title';
	protected $name = 'Page 2';
	protected $parent = 'page-1';
	protected $cap = 'manage_options';	
protected $show = true;
}
