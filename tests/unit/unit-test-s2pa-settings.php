<?php

require_once( WP_PLUGIN_DIR . '/simpletest-for-wordpress/WpSimpleTest.php' );
require_once( dirname( dirname( __DIR__ ) ) . '/classes/s2pa-settings.php' );

/**
 * Unit tests for the S2PA_Settings class
 *
 * Uses the SimpleTest For WordPress plugin
 *
 * @link http://wordpress.org/extend/plugins/simpletest-for-wordpress/
 */
if ( ! class_exists( 'UnitTestS2PA_Settings' ) ) {
	class UnitTestS2PA_Settings extends UnitTestCase {
		public function __construct() {
			$this->S2PA_Settings = S2PA_Settings::get_instance();
		}

		/*
		 * validate_settings()
		 */
		public function test_validate_settings() {
			// Valid settings
			$this->S2PA_Settings->init();
			$valid_settings = array(
				'basic'    => array(
					'field-example1' => 'valid data'
				),

				'advanced' => array(
					'field-example2' => 5
				)
			);

			$clean_settings = $this->S2PA_Settings->validate_settings( $valid_settings );

			$this->assertEqual( $valid_settings['basic']['field-example1'], $clean_settings['basic']['field-example1'] );
			$this->assertEqual( $valid_settings['advanced']['field-example2'], $clean_settings['advanced']['field-example2'] );


			// Invalid settings
			$this->S2PA_Settings->init();
			$invalid_settings = array(
				'basic'    => array(
					'field-example1' => 'invalid data'
				),

				'advanced' => array(
					'field-example2' => - 5
				)
			);

			$clean_settings = $this->S2PA_Settings->validate_settings( $invalid_settings );
			$this->assertNotEqual( $invalid_settings['basic']['field-example1'], $clean_settings['basic']['field-example1'] );
			$this->assertNotEqual( $invalid_settings['advanced']['field-example2'], $clean_settings['advanced']['field-example2'] );
		}

		/*
		 * __set()
		 */
		public function test_magic_set() {
			// Test that fields are validated
			$this->S2PA_Settings->init();
			$this->S2PA_Settings->settings = array( 'db-version' => array() );
			$this->assertEqual( $this->S2PA_Settings->settings['db-version'], Smart2Pay_API_Plugin::VERSION );

			// Test that values gets written to database
			$this->S2PA_Settings->settings = array( 'db-version' => '5' );
			$this->S2PA_Settings->init();
			$this->assertEqual( $this->S2PA_Settings->settings['db-version'], '5' );
			$this->S2PA_Settings->settings = array( 'db-version' => Smart2Pay_API_Plugin::VERSION );

			// Test that setting deep values triggers error
			$this->expectError( new PatternExpectation( '/Indirect modification of overloaded property/i' ) );
			$this->S2PA_Settings->settings['db-version'] = Smart2Pay_API_Plugin::VERSION;
		}
	} // end UnitTestS2PA_Settings
}

?>