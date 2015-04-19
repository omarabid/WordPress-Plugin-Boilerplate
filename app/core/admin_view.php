<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_Admin_View' ) ) {
	return;
}

/**
 * Admin View 
 *
 * @class BP_Admin_View 
 * @package app/core
 * @author Abid Omar
 */
abstract class BP_Admin_View {

}
