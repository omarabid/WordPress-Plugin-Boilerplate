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
	 * Specify a model
	 *
	 * @var string
	 */
	protected $model;

	/**
	 * Specify a view to display the template
	 *
	 * @var string
	 */
	protected $view;

	/**
	 * Current Admin Page Screen name
	 *
	 * @var string
	 */
	protected $screen_name;

	/**
	 *
	 * @param string $page_id Page Unique Identifier
	 * @param bool|string $child False if the page is a top level menu, or the parent menu id
	 * @param string $cap
	 *
	 * @return void
	 */
	public function __construct() {	
		// Add the Admin Page to the WordPress menu
		add_action( 'admin_menu', array( &$this, 'add_menu' ) );

		// Check that we are on the right screen
		add_action( 'current_screen', array( &$this, 'validate_screen' ) );
	}

	/**
	 * Add the Admin PAge to the WordPress Menu
	 *
	 * @return void
	 */
	public function add_menu() {
		if ( !isset( $this->page_id ) && !isset( $this->title ) && !isset( $this->name ) && !isset( $this->parent ) && !isset( $this->cap ) ) {
			return;
		}

		if ( $this->parent ) {	
			$this->screen_name = add_submenu_page( $this->parent, $this->title, $this->name, $this->cap, $this->page_id, array( &$this, 'render_page' ) );
		} else {
			$this->screen_name = add_menu_page( $this->title, $this->name, $this->cap, $this->page_id, array( &$this, 'render_page' ) );	
		}
	}

	/**
 * Verify that we are on the correct screen
 *
 * @return void
 */
	public function validate_screen() {
		$screen = get_current_screen();
		if ( $screen->id === $this->screen_name ) {
			// Load the Page resources
			add_action( 'admin_print_scripts', array( &$this, 'load_scripts' ) );
			add_action( 'admin_print_styles', array( &$this, 'load_styles' ) );

			// WordPress Contextual Help
			add_filter( 'contextual_help', array( &$this, 'contextual_help' ) );	
			// Load the Model File
			require_once( WPBP_DIR . '/app/models/admin/' . $this->page_id . '.php' );
			// Load the View File
			require_once( WPBP_DIR . '/app/views/admin/' . $this->page_id . '.php' );

			// Initialize the model
			$this->model = new $this->model();

			// Initialize the view
			$this->view = new $this->view( $this->model->get_data() );

			// Process GET requests
			$this->process_get();

			// Process POST requests
			$this->process_post();
		}
	}

	/**
	 * Renders the page using the controller defined View and Template Id
	 *
	 * @return void
	 */
	public function render_page() {	
		$this->view->display();
	}

	/**
	 * Process GET Requests
	 *
	 * @return void
	 */
	protected function process_get() {
		
	}

	/**
	 * Process POST Requests
	 *
	 * @return void
	 */
	protected function process_post() {
		
	}

	/**
	 * Load the Page Scripts 
	 *
	 * @return void
	 */
	public function load_scripts() {

	}

	/**
	 * Load the Page Styles 
	 *
	 * @return void
	 */
	public function load_styles() {

	}

	/**
	 * Contextual Help
	 *
	 * @return void
	 */
	public function contextual_help() {

	}
}
