<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_Admin_View_Page_3' ) ) {
	return;
}

/**
 * Admin View Page 3 
 *
 * @class BP_Admin_View_Page_3 
 * @package app/views
 * @author Abid Omar
 */
class BP_Admin_View_Page_3 extends \wpplex\WP_MVC\Admin\View {
	/**
	 * Template filename
	 *
	 * @var string
	 */
	protected $template_id = 'page-3';
}
