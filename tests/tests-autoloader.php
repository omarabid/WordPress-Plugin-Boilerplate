<?php

class Tests_Autoloader extends WP_UnitTestCase {
	public function test_get_file_path_from_class() {
		$autoloader = new BP_Autoloader();

		$class_name = 'MyClass';
		$expected_path = false;
		$path = $autoloader->get_file_path_from_class( $class_name );
		$this->assertEquals( $expected_path, $path );

		$class_name = 'BP_Ajax';
		$expected_path = array( 'class-ajax.php', 'ajax/class-ajax.php' );
		$path = $autoloader->get_file_path_from_class( $class_name );
		$this->assertEquals( $expected_path, $path );

		$class_name = 'BP_Utils_Logging';
		$expected_path = array( 'utils/class-logging.php', 'utils/logging/class-logging.php' );
		$path = $autoloader->get_file_path_from_class( $class_name );
		$this->assertEquals( $expected_path, $path );

		$class_name = 'BP_Gateways_PayPal_Standard';
		$expected_path = array( 'gateways/paypal/class-standard.php', 'gateways/paypal/standard/class-standard.php' );
		$path = $autoloader->get_file_path_from_class( $class_name );
		$this->assertEquals( $expected_path, $path );

		$class_name = 'WCX_Payments_Merchant_Gateways_PayPalStandard';
		$expected_path = array( 'payments/merchant/gateways/class-paypalstandard.php', 'payments/merchant/gateways/paypalstandard/class-paypalstandard.php' );
		$path = $autoloader->get_file_path_from_class( $class_name );
		$this->assertEquals( $expected_path, $path );
	}
}
