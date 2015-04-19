<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_MVC_Admin_Controller' ) ) {
	return;
}

/**
 * Admin Controller 
 *
 * @class BP_MVC_Admin_Controller 
 * @package app/core
 * @author Abid Omar
 */
abstract class BP_MVC_Admin_Controller {

	public $view;
	protected $page_id;
	protected $child;
	protected $cap;

	/**
	 *
	 * @param string $page_id Page Unique Identifier
	 * @param bool|string $child False if the page is a top level menu, or the parent menu id
	 * @param string $cap
	 *
	 * @return void
	 */
	public function __construct() {	
	}

	public function process_get() {

	}

	public function process_post() {

	}

	public function load_scripts() {

	}

	public function load_styles() {

	}
}
