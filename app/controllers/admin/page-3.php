<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_Admin_Page_3' ) ) {
	return;
}

/**
 * Admin Page 3 
 *
 * @class BP_Admin_Page_3
 * @package app/controllers/admin
 * @author Abid Omar
 */
class BP_Admin_Page_3 extends BP_MVC_Admin_Controller {
	protected $page_id = 'page-3';
	protected $child = false;
	protected $cap = 'manage_options';	
}
