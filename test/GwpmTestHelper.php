<?php
class GwpmTestHelper {

	function setupMatrimony() {
	    $gwpm_setup_model = new GwpmSetupModel() ;
		$init_request[GWPM_USER_LOGIN_PREF] = '1' ;
		$gwpm_setup_model->setupGWPMDetails($init_request) ;
	}
	
	function migrateToDynaFields() {
	    
	    echo 'Starting Migration ' . PHP_EOL ;
	    
	    $totalFields = get_option(GWPM_DYNA_FIELD_COUNT);
	    
	    if ($totalFields == false)
            $totalFields = 0;
        
        $totalFields++ ;
        
        $migObjects = [] ;
        
        $migrationKeys = [] ;
        
        // Mobile
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_contact_no'] = $nextKey;
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Contact No';
        $migObject['gwpm_dyna_field_type'] = 'text';
        
        $migObjects[$nextKey] = $migObject;
        
        // Caste
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_caste'] = $nextKey; 
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Caste';
        $migObject['gwpm_dyna_field_type'] = 'text';
        
        $migObjects[$nextKey] = $migObject;
        
        // Religion
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_religion'] = $nextKey; 
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Religion';
        $migObject['gwpm_dyna_field_type'] = 'text';
        
        $migObjects[$nextKey] = $migObject;
        
        // Sevai Dosham
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_sevvai_dosham'] = $nextKey; 
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Sevai Dosham';
        $migObject['gwpm_dyna_field_type'] = 'yes_no';
        
        $migObjects[$nextKey] = $migObject;
        
        // Marital Status
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_martial_status'] = $nextKey; 
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Marital Status';
        $migObject['gwpm_dyna_field_type'] = 'select';
        $migObject['gwpm_dyna_field_values'] = getMaritalOptions() ;
        
        $migObjects[$nextKey] = $migObject;
        
        // Star Sign (Nakshatram)
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_starsign'] = $nextKey; 
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Star Sign';
        $migObject['gwpm_dyna_field_type'] = 'select';
        $migObject['gwpm_dyna_field_values'] = getStarSignOptions() ;
        
        $migObjects[$nextKey] = $migObject;
        
        // Zodiac Sign (Raasi)
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_zodiac'] = $nextKey; 
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Zodiac Sign';
        $migObject['gwpm_dyna_field_type'] = 'select';
        $migObject['gwpm_dyna_field_values'] = getZodiacOptions() ;
        
        $migObjects[$nextKey] = $migObject;
        
        foreach($migObjects as $key => $value) {
            
            appendLog("Process object: " . $key) ;
            appendLog( print_r($value, true)) ;
            
            $dynaMigOpts[$key] = $value['gwpm_dyna_field_label'] ;
            
            $result = update_option ($key, $value) ;
            appendLog("Done " . $key . ' - ' . $result ) ;
            
            echo ("Done " . $key . ' - ' . $result . PHP_EOL ) ;
            
        }
        
        echo "Completed, updateing options: " . PHP_EOL  ;
        
        update_option (GWPM_DYNA_FIELD_COUNT, ($totalFields-1)) ;
        update_option(GWPM_DYNA_FIELD_MIG_OPTS, $migrationKeys);
        
        echo "Created new fields for migration <br /><br />" . PHP_EOL  ;
        
        print_r($migrationKeys) ;
	    
	    echo '==================================' . PHP_EOL  ;
	    
	    return $migrationKeys ;
	   
	}
	
	function migrateUsersToDynaField() {
	    echo 'Triggering user migration ! '. PHP_EOL  ;
	    
	    $adminModel = new GwpmAdminModel() ;
        $dynaNewFields = $adminModel->migrateToDynamicFieldData() ;
        print_r($dynaNewFields) ;
        appendLog("New dyna field: " . PHP_EOL  ) ;
        echo ("New dyna field: " . PHP_EOL  ) ;
        appendLog( $dynaNewFields) ;
        echo "Done " . PHP_EOL ;
        return $dynaNewFields ;
	}

	function createUsers($user_key, $noOfUsers, $gender) {
	    
	    echo 'Logger location: ' . getLogDir() ;
	
		$mymodel = new GwpmProfileModel() ;
	
		$userIdList = array() ;

		for($cnt = 0; $cnt < $noOfUsers; $cnt++) {
			$user_name = $user_key . $cnt ;
			$user_email = $user_name . '@127.0.0.1' ;
			$random_password = 'passd' ;
			$user_id = username_exists( $user_name );
			if ( !$user_id and email_exists($user_email) == false ) {
				$user_id = wp_create_user( $user_name, $random_password, $user_email );
				echo __("User created: " . $user_id . '<br />', 'genie-wp-matrimony') ;
				array_push($userIdList, $user_id) ;
			} else {
				echo __('User already exists.  Password inherited.' . '<br />', 'genie-wp-matrimony');
			}

			if (!isset($gender)) {
				$gender = rand ( 1 , 2 ) ;
			}
		
			$_POST['userId'] = $user_id ;
			$_POST['first_name'] = $user_name . "fn" ;
			$_POST['last_name'] = $user_name . "ln" ;
			$_POST['user_email'] = $user_email ;
			$_POST['gwpm_gender'] =  $gender ;		
				
			$_POST['gwpm_martial_status'] =  '1' ;
			$_POST['gwpm_religion'] = 'Hindu' ;
			$_POST['gwpm_sevvai_dosham'] =  rand ( 1 , 2 ) ;
			$_POST['gwpm_starsign'] =  rand ( 1 , 26 ) ;
			$_POST['gwpm_user'] =  '1' ;
			$_POST['gwpm_caste'] =  'Mudliyar' ;
			$_POST['gwpm_zodiac'] =  rand ( 1 , 12 ) ;
			$_POST['gwpm_contact_no'] = ( rand ( 1 , 12 ) * 100000000 ) + 989898 + rand (5000 , 10000);
				
			$gwpm_education['qualification'] = "" . rand ( 1 , 4) ;
			$gwpm_education['qualification_other'] =   "" . 'Other' ;		
			$gwpm_education['specialization'] =  "" . rand ( 1 , 4) ;
			$gwpm_education['status'] =  "" . rand ( 1 , 4) ;    
		
			$_POST['gwpm_education'] =  $gwpm_education ;
		
			$dynaKeys = getDynamicFieldKeys() ;
			foreach($dynaKeys as $__keys) {
				echo "<br /> Dyna: " . $__keys ;
				$_POST[$__keys] = "" . rand ( 1 , 3) ; 
			}
		
			$abt = $this->createDateRangeArray( '1980-10-01', '1985-10-05') ;
			$newdata =  $abt[0] ;
			echo $newdata . "<br />" ;
		
			$_POST['gwpm_dob'] = $newdata;
		
		//	$profileObj = new GwpmProfileVO($_POST);
			$profileObj = new GwpmProfileVO($_POST, $dynaKeys);
			
			if (isset($_FILES["gwpm_profile_photo"]))		
			     $profileObj->gwpm_profile_photo = $_FILES["gwpm_profile_photo"] ;
			     
			$validateObj = $profileObj->validate();		
		
			if (sizeof($validateObj) == 0) {
				$mymodel->updateUser($profileObj);
				echo __('success_message', 'Profile updated successfully!!' , 'genie-wp-matrimony');
				echo ('<br />' . PHP_EOL) ;
			} else {
				echo __('Please correct the below fields: ' , 'genie-wp-matrimony');
				print_r($validateObj) ;
				echo "<br />" . PHP_EOL ;
			}
		}
		
		appendLog('User creation completed, setting capabilities, count: ' . sizeof($userIdList) ) ;
	
		if(sizeof($userIdList) > 0) {
		
			global $wpdb;
		
			$table_name = $wpdb->prefix . "usermeta";
			$column_name = $wpdb->prefix . 'user_level' ;
			$column_name_2 = $wpdb->prefix . "capabilities";
		
			appendLog( $table_name . '-' . $column_name  . ' - ' . implode(',', $userIdList) );
			foreach($userIdList as $_userId) {
			    appendLog('Updating User cabability a nd user level: ' . $_userId ) ;
			    
                update_user_meta($_userId, $column_name,  1 );
                update_user_meta($_userId, $column_name_2,  'a:1:{s:14:\"matrimony_user\";b:1;}' );
                
                echo  nl2br('Done for ' .  $_userId . ' !! \n \n <br/>'  . PHP_EOL )  ;
			    
				/* $queryString = "update $table_name set meta_value = 1 WHERE meta_key = '$column_name' AND user_id = %d " ;
				echo  nl2br($queryString . '\n \n <br/>' )  ;
				$result = $wpdb->query($wpdb->prepare($queryString, array($_userId)  ));
				//$result = $wpdb->get_results($preparedSql);	
				appendLog($result) ;	
				$queryString = "UPDATE $table_name SET meta_value =  WHERE meta_key = '$column_name_2' AND user_id = (%s)" ;
				echo nl2br( $queryString . '\n \n <br/>' )  ;
				$result = $wpdb->query($wpdb->prepare($queryString, $_userId));
				//$result = $wpdb->get_results($preparedSql);	
				appendLog($result) ;  */
			}
		}
	}

	function createDateRangeArray($strDateFrom,$strDateTo)
{
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.

    // could test validity of dates here but I'm already doing
    // that in the main script

    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+= ( 48640000 * rand (1, 6)); // add 24 hours
            array_push($aryRange,date('m/d/Y',$iDateFrom));
        }
    }
    return $aryRange;
}
	
	 

}