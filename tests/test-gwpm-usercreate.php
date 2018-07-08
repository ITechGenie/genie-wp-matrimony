<?php
/**
 * Class GwpmUserCreate
 *
 * @package Genie_Wp_Matrimony
 */

/**
 * Gwpm User Create Testing.
 */
class GwpmUserCreate extends WP_UnitTestCase {

	/**
	 * create bulk users
	 */
	function test_create_users() {
		// Replace this with some actual testing code.
		echo "Create Users Test " ;

		$testHelper = new GwpmTestHelper() ;

		$testHelper->createUsers('GWPM-MALE', '10', '1') ;
		$testHelper->createUsers('PRAK-FEMALE', '10', '2') ;

		$this->assertTrue( true );
	}
}
