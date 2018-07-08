<?php
/**
 * Class GwpmUserCreate
 *
 * @package Genie_Wp_Matrimony
 */

 require __DIR__ . "/../test/GwpmTestHelper.php";

/**
 * Gwpm User Create Testing.
 */
class GwpmUserCreate extends WP_UnitTestCase {

	function test_plugin_activation() {    
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$result = activate_plugin( WP_CONTENT_DIR . '/plugins/genie-wp-matrimony/genie-wp-matrimony-plugin.php', '', TRUE, FALSE );
		$this->assertNotWPError( $result );
	}

	/**
	 * create bulk users
	 */
	function test_create_users() {
		// Replace this with some actual testing code.
		echo "Create Users Test " ;

		$testHelper = new GwpmTestHelper() ;

		$testHelper->setupMatrimony() ;

		$testHelper->createUsers('GWPM-MALE', '10', '1') ;
		$testHelper->createUsers('PRAK-FEMALE', '10', '2') ;

		$this->assertTrue( true );
	}
}
