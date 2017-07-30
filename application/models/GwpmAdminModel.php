<?php

/*
 * Created on May 6, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class GwpmAdminModel {

	function getSubscribedUsers() {
		global $wpdb;
		$resultList = array ();
		$queryString = "SELECT $wpdb->users.ID, $wpdb->users.display_name, $wpdb->users.user_email FROM $wpdb->users " .
				" WHERE $wpdb->users.ID IN ( " .
				" SELECT $wpdb->usermeta.user_id FROM $wpdb->usermeta WHERE" .
				" $wpdb->usermeta.meta_key = %s AND $wpdb->usermeta.meta_value LIKE %s )";
		$preparedSql = $wpdb->prepare($queryString,  $wpdb->prefix . 'capabilities', '%subscriber%');
		$result = $wpdb->get_results($preparedSql) ;
		foreach ($result as $obj) {
			if (isset ($obj) && $obj != null)
				array_push($resultList, $obj);
		}
		return $resultList ;
	}
	
	function getAllMatrimonyUsers() {
		global $wpdb;
		$resultList = array ();
		$queryString = "SELECT $wpdb->users.ID, $wpdb->users.display_name, $wpdb->users.user_email FROM $wpdb->users " .
				" WHERE $wpdb->users.ID IN ( " .
				" SELECT $wpdb->usermeta.user_id FROM $wpdb->usermeta WHERE" .
				" $wpdb->usermeta.meta_key = %s AND $wpdb->usermeta.meta_value LIKE %s )";
		$preparedSql = $wpdb->prepare($queryString,  $wpdb->prefix . 'capabilities', '%matrimony_user%');
		$result = $wpdb->get_results($preparedSql) ;
		foreach ($result as $obj) {
			if (isset ($obj) && $obj != null)
				array_push($resultList, $obj);
		}
		return $resultList ;
	}

	function saveDynamicFields($gwpmFieldLabels, $gwpmFieldTypes, $gwpmFieldValue, $earlierCount) {

		global $wpdb ;
		$totalFields = get_option(GWPM_DYNA_FIELD_COUNT);
		appendLog( print_r($gwpmFieldLabels, true) );
		$keys = array_keys($gwpmFieldLabels)  ;
		// $deletedObjs = explode(',', $deletedItems) ;
		$save_options = null ;
		
		if($totalFields == false )
			$totalFields = 0 ;
		appendLog( $earlierCount . " - " . $totalFields );
		
		if($earlierCount == $totalFields) {
			foreach ($keys as $mKey) {
				$save_options = null ;
				appendLog("\nK: " . $mKey . "\n" );
				$save_options['gwpm_dyna_field_label'] = $gwpmFieldLabels[$mKey] ;
				$save_options['gwpm_dyna_field_type'] = $gwpmFieldTypes[$mKey] ;
				if($gwpmFieldTypes[$mKey] == "select" ) {
					appendLog( "Select Type" );
					$gwpm_field_values = $gwpmFieldValue[$mKey] ;
					appendLog( "zKey: " . $mKey . ' - ' . $gwpm_field_values );
					$itr = 1 ;
					$save_options_values = null ;
					foreach ($gwpm_field_values as $vKey) {
						appendLog( "vKey: " . $vKey . "<br />" );
						$save_options_values[$itr] = $vKey ;
						$itr++ ;
					}
					$save_options['gwpm_dyna_field_values'] = $save_options_values ;
				} else if($gwpmFieldTypes[$mKey] == 'yes_no') {
					appendLog( "Yes/No Type" );
				} else {
					appendLog( "Text Type" );
				}
				
				$totalFields++  ;
				
				appendLog( print_r($save_options, true) );
				$result = update_option (GWPM_DYNA_KEY_PREFIX . ($totalFields), $save_options) ;
				if($result == 1)
				update_option (GWPM_DYNA_FIELD_COUNT, ($totalFields)) ;
			}
		} else {
			throw new GwpmCommonException("Invalid Request") ;
		}
	}
	
	function deleteDynamicField($valObj) {
	    appendLog('Delete request for: ' . $valObj ) ;
		if(isset($valObj) && $valObj != null) {
			if(strpos($valObj, '_')) {
				$idsAry = explode('_', $valObj) ;
				$rowId = $idsAry[0] ;
				$valueId = $idsAry[1] ;
				
				appendLog('Deleting options: ' . $rowId ) ;

				$editOption = get_option('gwpm_dyna_field_' . $rowId) ;
				$valuesAry = $editOption['gwpm_dyna_field_values'] ;
				 
				unset($valuesAry[$valueId]) ;
				 
				$editOption['gwpm_dyna_field_values'] =  $valuesAry ;
				update_option('gwpm_dyna_field_' . $rowId, $editOption) ;
				
				$resultObj['message'] = "Value for dynamic filed deleted successfully. " ; 
				$resultObj['result'] = 1 ;
			} else {
				$delResult = delete_option('gwpm_dyna_field_' . $valObj) ;
				$resultObj['message'] = "Dynamic field deleted successfully. ";
				$resultObj['result'] = 1 ;
			}
		} else {
			$resultObj['message'] = "Exception in deleting dynamic field !" ;
			$resultObj['result'] = 0 ;
		}
		echo json_encode( $resultObj ) ;
	}

	function updateDynamicField($valObj) {
		if (isset ($valObj) && $valObj != null && sizeof($valObj) > 0) {
			appendLog(print_r($valObj, true) );
			foreach ($valObj as $key => $all) {
				if (strpos($key, '_')) {
					$idsAry = explode('_', $key);
					$rowId = $idsAry[0];
					$valueId = $idsAry[1];

					$editOption = get_option('gwpm_dyna_field_' . $rowId);
					$valuesAry = $editOption['gwpm_dyna_field_values'];
					appendLog(print_r($valuesAry, true));
					$srcValue = $valuesAry[$valueId] ;
					appendLog("srcValue: " . $srcValue);
					
					$valuesAry[$valueId] = $valObj[$key] ;
					$editOption['gwpm_dyna_field_values'] = $valuesAry ;
					
					$result = update_option(GWPM_DYNA_KEY_PREFIX . ($rowId), $editOption);
					appendLog("valuesAry: " . $result);
					
					$resultObj['message'] = $valObj[$key] ;
					$resultObj['result'] = 1 ;
					
				} else {
					appendLog("vKey: " . $key . " - " . $valObj[$key] . " $$ ");
					$editOption = get_option(GWPM_DYNA_KEY_PREFIX . $key);
					appendLog("editOption: ");
					appendLog(print_r($editOption, true));
					$valuesAry = $editOption['gwpm_dyna_field_label'];
					$editOption['gwpm_dyna_field_label'] = $valObj[$key];
					appendLog("valuesAry: " . $valuesAry);
					$result = update_option(GWPM_DYNA_KEY_PREFIX . ($key), $editOption);
					appendLog("valuesAry: " . $result);
					
					$resultObj['message'] = $valObj[$key] ;
					$resultObj['result'] = 1 ;
				}
			} 
		} else {
			$resultObj['message'] = "Exception in deleting dynamic field !" ;
			$resultObj['result'] = 0 ;
		}
		echo json_encode( $resultObj ) ;
	}
	
	function migrateToDynamicFieldData() {
	    
	    global $wpdb ;
	    
	    echo "<br /><br />Starting Process <br />" ;
	    $dynaFields = get_option('gwpm_dyna_mig_opts_field') ;
	    
	    $newFieldKeys = '' ;
	    
	    $keycnt = 0;
	    foreach($dynaFields as $key => $value) {
	        if ($keycnt > 0)
	            $newFieldKeys .= "," ;
	        $newFieldKeys .= "'" . $value . "'" ;
	        $keycnt++ ;
	    }
	    
	    $usermeta_table_name = $wpdb->prefix . "usermeta";
	    
	    $queryString = "  SELECT $wpdb->usermeta.user_id, $wpdb->usermeta.meta_key, $wpdb->usermeta.meta_value " .
	               "  FROM " . $usermeta_table_name. " WHERE $wpdb->usermeta.meta_key IN ( 'gwpm_contact_no', 'gwpm_starsign',  " . 
                       "   'gwpm_zodiac',  " . 
                       "   'gwpm_sevvai_dosham', " . 
                       "   'gwpm_martial_status', " . 
                       "   'gwpm_caste', 'gwpm_religion') AND $wpdb->usermeta.user_id NOT " .
                       "    IN (SELECT distinct $wpdb->usermeta.user_id FROM " . $usermeta_table_name .
                       "   WHERE $wpdb->usermeta.meta_key IN ( " . $newFieldKeys . 
                       "   ) AND $wpdb->usermeta.meta_value <> '' AND $wpdb->usermeta.meta_value IS NOT NULL  ) " . 
                       "   ORDER BY $wpdb->usermeta.user_id ASC LIMIT " . (GWPM_MAX_DYNA_MIGRATE_USER_COUNT * 8) ;
	    
	    print_r($dynaFields) ;
	    
	    appendLog( ' New query: ' .  $queryString   ) ;
	    
	    $preparedSql = $wpdb->prepare($queryString,  $wpdb->prefix . 'usermeta' );
	    $result = $wpdb->get_results($preparedSql) ;
	    
	    if (isset ($result) && $result != null && sizeof($result) != 0 ) {
    	    $resultList = array ();
    	    
    	    $processCount = 0 ;
    	    
    	    $processedUserId = 0 ;
    	    $processedUserCount = 0 ;
    	    
    	    foreach ($result as $metaObj) {
    	        
    	        $userId = $metaObj->user_id ;
    	        
    	        if ($processedUserId != $userId ) {
    	            $resultList[$processedUserCount] = $processedUserId ;
    	            echo "Processing user $processedUserId <br />" ; 
    	            $processedUserCount++ ;
    	        }
    	        
    	        if ($processedUserCount < GWPM_MAX_DYNA_MIGRATE_USER_COUNT) {
    	            
        	        $metaOriginalKey = $metaObj->meta_key;
        	        
        	        $metaKey = $dynaFields[$metaOriginalKey] ;
        	        
        	        $metaValue = $metaObj->meta_value;
        	        // echo $processCount . ' - ' . $userId . ' - ' . $metaKey. ' - ' . $metaValue . ' - ' . $processedUserCount . '<br />';
        	        
        	        if (isset($metaValue) && $metaValue != '') {
            	        if ($metaOriginalKey == 'gwpm_martial_status' || $metaOriginalKey == 'gwpm_zodiac' || $metaOriginalKey == 'gwpm_starsign' ) {
            	            $tempVal = (int) $metaValue ; 
            	            $metaValue = $tempVal - 1 ;
            	        }
            	        
            	        $addMeta = add_user_meta($userId, $metaKey, $metaValue, true);
            	        appendLog("Added meta for user: " . $userId . ' - ' . $metaKey) ;
            	        appendLog ($addMeta);
            	        
            	        // Need to uncomment only if there is an exception - helps in updating existing unsynced data
            	        /*$hasData = get_user_meta($userId, $metaKey);
            	        appendLog($hasData) ;
            	        if (isset ($hasData) && sizeof($hasData) > 0) {
            	            $updateMeta = update_user_meta($userId, $metaKey, $metaValue);
            	            appendLog("Updated meta for user: " . $userId . ' - ' . $metaKey) ;
            	            appendLog($updateMeta) ;
            	        } else {
            	            $addMeta = add_user_meta($userId, $metaKey, $metaValue, true);
            	            appendLog("Added meta for user: " . $userId . ' - ' . $metaKey) ;
            	            appendLog ($addMeta);
            	        } */
        	        }
        	        
        	        $processedUserId = $userId ;
        	        
        	        $processCount++ ;
    	        } else {
    	            echo "Batch completed, User $processedUserId will be processed in next batch " ;
    	            break ;
    	        }
    	    }
    	    
    	    $printLog = "Done migrating current set, total records prcoessed:  $processCount , <br />" .
    	                "Last processed user: $processedUserId , <br />" .
    	                 "Total User processed:  $processedUserCount , <br />Run next batch !" ;
    	    appendLog($printLog) ;
    	    echo  $printLog ;
	    } else {
	        echo "<br /> No Users to process ! Updating flag to mark completion of migrations !" ;
	        update_option(GWPM_DYNA_FIELD_MIG_COMPLETE, $_SERVER['REQUEST_TIME'] );
	    }
	    
	    return $resultList;	    
	}
	
	function saveOAuth10aFields($gwpmOauth10aConfig) {
		
		global $wpdb ;
		
		appendLog("Updating the oAuth10aConfig: " . $gwpmOauth10aConfig);
		$result = update_option(GWPM_OAUTH_10A_CONFIG, $gwpmOauth10aConfig);
		appendLog("saveOAuth10aFields: " . $result);
		
		return $result ;
		
	}
	
	/** Generating QRCode **/
	
	function getQRinSVG($qrObject) {
		
	    $dataText   = 'PHP QR Code :)';
	    $svgTagId   = 'gwpm_user_config_id';
	    $saveToFile = true;
	    $imageWidth = 300; 
	    
		$qrInputStr = json_encode ($qrObject) ;
		appendLog('Printing QR Codes:: ' . $qrInputStr) ;
		return QRcode::svg($qrInputStr, $svgTagId, $saveToFile, QR_ECLEVEL_L, $imageWidth); 
		
	}
	
	function getQRinCanvas($qrObject) {
	    
	    $qrInputStr = json_encode ($qrObject) ;
	    appendLog('Printing QR Codes:: ' . $qrInputStr) ;
	    return QRcode::canvas($qrInputStr ) ;
	    
	}
	
	function getGwpmOption($optionKey) {
		global $wpdb ;
		return  get_option ( $optionKey); 
	}
}
