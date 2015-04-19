<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_Front_Controller' ) ) {
	return;
}

/**
 * Front Controller 
 *
 * @class BP_Front_Controller 
 * @package app/core
 * @author Abid Omar
 */
abstract class BP_Front_Controller {

}
