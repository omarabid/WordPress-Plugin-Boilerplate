<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_Admin_View_Page_1' ) ) {
	return;
}

/**
 * Admin View Page 1 
 *
 * @class BP_Admin_View_Page_1 
 * @package app/views
 * @author Abid Omar
 */
class BP_Admin_View_Page_1 extends BP_MVC_Admin_View {
	/**
	 * Template filename
	 *
	 * @var string
	 */
	protected $template_id = 'page-1';
}
