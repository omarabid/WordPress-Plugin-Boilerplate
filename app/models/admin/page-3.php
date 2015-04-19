<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_Admin_Model_Page_3' ) ) {
	return;
}

/**
 * Admin Model 
 *
 * @class BP_Admin_Model_Page_3 
 * @package app/core
 * @author Abid Omar
 */
class BP_Admin_Model_Page_3 extends BP_MVC_Admin_Model {
	protected $title = 'Page 3 Title';
	protected $name = 'Page 3';
}
