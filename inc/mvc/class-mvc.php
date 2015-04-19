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

	private $app_path;
	private $admin_pages = array();
	private $front_pages = array();

	public function __construct( $app_path ) {
		$this->app_path = $app_path;
		$this->router = require_once( $app_path . '/router.php' );

		// Admin Pages
		$this->load_admin_pages();
		// Front Pages	
		$this->load_front_pages();
	}

	private function load_admin_pages() {
		foreach( $this->router['admin'] as $file=>$class ) {	
			require_once( $this->app_path . '/controllers/admin/' . $file . '.php' );
			new $class();	
		}	
	}

	private function load_front_pages() {

	}
}
