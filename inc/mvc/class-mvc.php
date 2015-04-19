<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_MVC' ) ) {
	return;
}

/**
 * MVC Core Loader 
 *
 * @class BP_MVC 
 * @package app/core
 * @author Abid Omar
 */
class BP_MVC {

	private $admin_pages = array();
	private $front_pages = array();

	public function __construct( $app_path ) {

	}
}
