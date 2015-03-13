<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {	
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_Utils_Debugging' ) ) {	
	return;
}

/**
 * Class for Debugging and Displaying various 
 * information about the plugin. 
 *
 * @package     Utils 
*/
class BP_Utils_Debugging {
	public function __construct() {
		// Add an info Tab to the Debug Bar
		add_filter( 'debug_bar_panels', array( &$this, 'debug_bar_info_panel' ) );
	}

	public function debug_bar_info_panel( $panels ) {
		if ( ! class_exists( 'BP_Utils_Debugbar_Info' ) ) {
			return;
		}

		$panel = new BP_Utils_Debugbar_Info();		
		$panels[] = $panel;

		return $panels;
	}
}
