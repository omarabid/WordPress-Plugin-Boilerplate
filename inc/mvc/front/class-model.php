<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_MVC_Front_Model' ) ) {
	return;
}

/**
 * Front Model 
 *
 * @class BP_MVC_Front_Model 
 * @package app/core
 * @author Abid Omar
 */
abstract class BP_MVC_Front_Model {

}
