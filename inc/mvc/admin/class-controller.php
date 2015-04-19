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
	protected $title;
	protected $name;
	protected $parent;
	protected $cap;
	protected $show = false;

	/**
	 *
	 * @param string $page_id Page Unique Identifier
	 * @param bool|string $child False if the page is a top level menu, or the parent menu id
	 * @param string $cap
	 *
	 * @return void
	 */
	public function __construct() {	
		add_action( 'admin_menu', array( &$this, 'add_menu' ) );
	}

	public function add_menu() {
		if ( !isset( $this->page_id ) && !isset( $this->title ) && !isset( $this->name ) && !isset( $this->parent ) && !isset( $this->cap ) ) {
			return;
		}

		if ( $this->parent ) {	
			add_submenu_page( $this->parent, $this->title, $this->name, $this->cap, $this->page_id, array( &$this, 'render_page' ) );
		} else {
			add_menu_page( $this->title, $this->name, $this->cap, $this->page_id, array( &$this, 'render_page' ) );	
		}
	}

	public function render_page() {

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
