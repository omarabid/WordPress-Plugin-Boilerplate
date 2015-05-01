<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_Admin_Model_Page_3' ) ) {
	return;
}

/**
 * Admin Model 
 *
 * @class BP_Admin_Model_Page_3 
 * @package app/core
 * @author Abid Omar
 */
class BP_Admin_Model_Page_3 extends \omarabid\WP_MVC\Admin\Model {
	protected $data = array(
		'title' => 'Sample WP Generated Table',
	);	

	public function __construct() {
		$this->data['admin_url'] = admin_url( 'admin.php?page=page-id-2' );	
		$this->data['table'] = $this->generate_table();
	}

	private function generate_table() {
		require_once( 'tables/sample_table.php' );
		$myListTable = new wp_admin_table();
		$myListTable->prepare_items();
		ob_start();
		$myListTable->views();
		$myListTable->advanced_filters();
		$myListTable->display();
		$table = ob_get_clean();
		return $table;
	}
}
