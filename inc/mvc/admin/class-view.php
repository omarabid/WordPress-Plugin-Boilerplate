<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_MVC_Admin_View' ) ) {
	return;
}

/**
 * Admin View 
 *
 * @class BP_MVC_Admin_View 
 * @package app/core
 * @author Abid Omar
 */
abstract class BP_MVC_Admin_View {
	public function render( $path, $data ) {

	}
}
