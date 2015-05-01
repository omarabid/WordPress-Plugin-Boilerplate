<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_Admin_View_Page_2' ) ) {
	return;
}

/**
 * Admin View Page 2 
 *
 * @class BP_Admin_View_Page_2 
 * @package app/views
 * @author Abid Omar
 */
class BP_Admin_View_Page_2 extends \omarabid\WP_MVC\Admin\View {
	/**
	 * Template filename
	 *
	 * @var string
	 */
	protected $template_id = 'page-2';

	public function __construct( $data ) {
		parent::__construct( $data );
		$this->options_framework = new \omarabid\WP_Options\WP_Options( 'page2_options', $this->data['settings'] );	
	}

	public function display() {
		parent::display();	

		$this->options_framework->build_panel();
	}
}
