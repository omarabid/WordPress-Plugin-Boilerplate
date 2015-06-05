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
class BP_Admin_View_Page_2 extends \wpplex\WP_MVC\Admin\View {
	/**
	 * Template filename
	 *
	 * @var string
	 */
	protected $template_id = 'page-2';

	public function __construct( $data ) {
		parent::__construct( $data );
	}

	public function display() {
		parent::display();	

		WPBP()->options_framework->build_panel( $this->data['settings'] );
	}
}
