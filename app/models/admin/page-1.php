<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_Admin_Model_Page_1' ) ) {
	return;
}

/**
 * Admin Model 
 *
 * @class BP_Admin_Model_Page_1 
 * @package app/core
 * @author Abid Omar
 */
class BP_Admin_Model_Page_1 extends \wpplex\WP_MVC\Admin\Model {
	protected $data = array(
		'title' => 'Welcome to the WordPress Boilerplate Plugin',
		'list' => array(
			array( 'key' => 'value 1' ),
			array( 'key' => 'value 2' ),
			array( 'key' => 'value 3' ),
		),
	);
}
