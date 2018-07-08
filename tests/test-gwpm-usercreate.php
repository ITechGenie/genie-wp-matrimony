<?php
/**
 * Class GwpmUserCreateTest
 *
 * @package Genie_Wp_Matrimony
 */

/**
 * Gwpm User Create Testing.
 */
class GwpmUserCreateTest extends WP_UnitTestCase {

	/* function test_plugin_activation() {    
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        $result = activate_plugin('../genie-wp-matrimony-plugin.php', '', TRUE, FALSE );
		$this->assertNotWPError( $result );
	} */

	/**
	 * create bulk users
	 * @TODO Write asserts to Validate user creation
	 */
	function test_create_users() {
		echo "Create Users Test " . PHP_EOL ;

		$testHelper = new GwpmTestHelper() ;

		$testHelper->setupMatrimony() ;

		$testHelper->createUsers('GWPM-MALE', 1, '1') ;
		$testHelper->createUsers('PRAK-FEMALE', 1, '2') ;

		$this->assertTrue( true );
	}
}
