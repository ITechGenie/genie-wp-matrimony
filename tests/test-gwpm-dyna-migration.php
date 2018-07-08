<?php
/**
 * Class GwpmDynaMigrationTest
 *
 * @package Genie_Wp_Matrimony
 */

/**
 * Gwpm Dyna Migration Testing
 */
class GwpmDynaMigrationTest extends WP_UnitTestCase {
    
    /**
	 * trigger static to dynamic field migration
	 * @TODO Add validation with - Create some dynamic fields before and after migration
	 */
	function test_gwpm_dyna_migration() {
		echo "Trigger Dyna migration  " . PHP_EOL ;

		$testHelper = new GwpmTestHelper() ;
		
		$testHelper->setupMatrimony() ;
		
		$testHelper->createUsers('GWPM-MALE', 2, '1') ;

		$obData = $testHelper->migrateToDynaFields() ; 
		
		//$obData = $testHelper->migrateUsersToDynaField() ; 

		$this->assertTrue( true );
	}
    
}