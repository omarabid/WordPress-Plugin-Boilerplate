<?php

class Tests_Autoloader extends WP_UnitTestCase {

	public function test_get_file_path_from_class() {
		$autoloader = new BP_Autoloader();

		$class_name = 'MyClass';
		$expected_path = false;
		$path = $autoloader->get_file_path_from_class( $class_name );
		$this->assertEquals( $expected_path, $path );

		$class_name = 'BP_Ajax';
		$expected_path = 'class-ajax.php';
		$path = $autoloader->get_file_path_from_class( $class_name );
		$this->assertEquals( $expected_path, $path );

		$class_name = 'BP_Utils_Logging';
		$expected_path = 'utils/class-logging.php';
		$path = $autoloader->get_file_path_from_class( $class_name );
		$this->assertEquals( $expected_path, $path );

		$class_name = 'BP_Gateways_PayPal_Standard';
		$expected_path = 'gateways/paypal/class-standard.php';
		$path = $autoloader->get_file_path_from_class( $class_name );
		$this->assertEquals( $expected_path, $path );

		$class_name = 'WCX_Payments_Merchant_Gateways_PayPalStandard';
		$expected_path = 'payments/merchant/gateways/class-paypalstandard.php';
		$path = $autoloader->get_file_path_from_class( $class_name );
		$this->assertEquals( $expected_path, $path );
	}
}
