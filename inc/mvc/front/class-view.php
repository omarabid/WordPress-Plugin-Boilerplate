<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_MVC_Front_View' ) ) {
	return;
}

/**
 * Front View 
 *
 * @class BP_MVC_Front_View 
 * @package app/core
 * @author Abid Omar
 */
abstract class BP_MVC_Front_View {

}
