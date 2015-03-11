<?php
if ( ! class_exists( 'Debug_Bar_Panel' ) ) {
	exit;
}
class BP_Utils_InfoPanel extends Debug_Bar_Panel {	
	public function init() {
		$this->title( 'BP Info' );	
	}
	public function prerender() {
		$this->set_visible( is_admin() );
	}
	public function render() {
		echo 'something';
	}
}
