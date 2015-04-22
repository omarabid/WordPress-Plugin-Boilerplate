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

	/**
	 * Admin Page Id
	 * @var string
	 */
	protected $page_id;

	/**
	 * Admin Page Title
	 * @var string
	 */
	protected $title;

	/**
	 * Admin Page Menu Title
	 * @var string
	 */
	protected $name;

	/**
	 * False if a top level menu, a string otherwise
	 * @var bool|string
	 */
	protected $parent;

	/**
	 * Page access capability
	 * @var string
	 */
	protected $cap;	

	/**
	 * Display or Hide the menu
	 * @var bool 
	 */
	protected $show;

	/**
	 * Template id
	 * @var string
	 */
	protected $template;


	/**
	 * Specify a view to display the template
	 *
	 * @var string
	 */
	protected $view;

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

	/**
	 * Renders the page using the controller defined View and Template Id
	 *
	 * @return void
	 */
	public function render_page() {
		// Load the View File
		require_once( WPBP_DIR . '/app/views/admin/' . $this->page_id . '.php' );
		$view = new $this->view( $this->template );
		$view->display();
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
