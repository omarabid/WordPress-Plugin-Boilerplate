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
	/**
	 * Template filename
	 *
	 * @var string
	 */
	protected $template_id;

	/**
	 * Templating Engine
	 *
	 * @var object 
	 */
	protected $engine;

	/**
	 * Templating File Loader
	 *
	 * @var object
	 */
	protected $loader;

	/**
	 * Initialized template object
	 * 
	 * @var object
	 */
	protected $template;

	/**
	 *
	 * @param string $template_id
	 * @return void
	 */
	public function __construct( $template_id ) {
		$this->template_id = $template_id . '.tpl';
		$this->loader = new Twig_Loader_Filesystem( WPBP_DIR . '/app/templates/admin' );
		$this->engine = new Twig_Environment( $this->loader );
		$this->template = $this->engine->loadTemplate( $this->template_id );
	}

	/**
	 *
	 * @return void
	 */
	public function display() {
		echo $this->template->render(array());
	}	
}
