<?php

/*
 * Created on Apr 28, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class GwpmSearchModel {

	function getUserById($userId) {
	    appendLog('Searching user ' . $userId ) ;
		$userObj = get_userdata($userId);
		appendLog($userObj) ;
		if (isset ($userObj) && isset ($userObj->ID) ) {
			return $userObj;
		}
		return null;
	}
	
	// Assuming the controllers take care of the authentications, planning to remove this part of code
	function ___getUserById($userId) {
	    $userObj = get_userdata($userId);
	    $is_open_search = get_option( GWPM_USER_LOGIN_PREF );
	    if (!isset($is_open_search))
	        $is_open_search = 1 ;
	        if (isset ($userObj) && isset ($userObj->ID) && !user_can($userObj->ID, 'level_10') && ( $is_open_search != 1 || user_can($userObj->ID, 'matrimony_user'))) {
	            return $userObj;
	        }
	        return null;
	}
	
	function getDynamicFieldData() {
		return getDynamicFieldData() ; ;
	}
	
	function searchUsersAjax($searchObj) {
	    $inputs = explode('&', $searchObj);
	    appendLog($inputs) ;
	    $keys = array_values($inputs)  ;
	    foreach ($keys as $vkey) {
	        appendLog($vkey) ;
	        $obj = explode('=', $vkey); 
	        appendLog($obj) ;
	        $searchInput[$obj[0]] = $obj[1] ;
	    }
	    appendLog('final object: ') ;
	    $o = new GwpmSearchVO($searchInput);
	    $o->search_filter_option = 2 ;
	    appendLog($searchInput->gwpm_gender . ' - ' . $o->gwpm_gender) ;
	    $responseObj =  $this->searchFactMtd ($o) ;
	    return $responseObj;
	}
	
	function searchUsersRest ($searchInput) {
	    
	    $_keys = getDynamicFieldKeys() ;
	    $o = new GwpmSearchVO($searchInput, $_keys);
	    $responseObj =  $this->searchFactMtd ($o) ; 
	    return $responseObj;
	    
	}
	
	function searchFactMtd($searchObj) { 
	    $responseObj = array () ;
	    try {
	        appendLog($searchObj) ;
	        $result = $this->searchUsers ($searchObj) ;
	        appendLog('Response obtained: ') ; appendLog($result) ;
	        $resArray = array_values($result) ;
	        appendLog($resArray) ;
	        foreach ($resArray as $vkey) {
	            appendLog('Vley object ini array ') ; appendLog($vkey) ;
	            $inObj = $vkey->data ;
	            unset($inObj->user_pass);
	            unset($inObj->user_activation_key);
	            $profileImgName = get_user_meta($inObj->ID, "gwpm_profile_photo", true);
	            $inObj->gwpm_profile_photo =  (object)  array() ;
	            if (isset( $profileImgName ) && '' != $profileImgName)
	                $inObj->gwpm_profile_photo = $profileImgName ;
	            array_push($responseObj, $inObj);
	        }
	    } catch (Exception $e) {
	        appendLog($e ) ;
	    }
	    return $responseObj;
	}

	function searchUsers($searchObj) {
		global $wpdb;
		$resultList = array ();
		appendLog($searchObj) ;
		if (!isNull($searchObj->userId)) {
		    appendLog('Search based on user_id ') ;
			$tempObj = $this->getUserById(getStrippedUserId($searchObj->userId));
			if (isset ($tempObj) && $tempObj != null)
				array_push($resultList, $tempObj);
		} else if (true) {
			$counter = 0;
			$args = array ();
			$userLists = null ;
			$searchFilterOption = $searchObj->search_filter_option ;
			
			if ( !isset($searchFilterOption) )
			    $searchFilterOption = 1 ;
			
			if (!isNull($searchObj->username)) {
				$args = array ();
				$filter = "( meta_key = 'first_name' OR meta_key='last_name' ) AND meta_value LIKE '%s'" ;
				$args[0] = like_escape($searchObj->username) . '%';
				$userLists = $this->getUserIds($searchFilterOption, $filter, $args, $userLists, $wpdb) ;				
			}
			
			if (!isNull($searchObj->gwpm_address)) {
				$args = array ();
				$filter = "meta_key = 'gwpm_address' AND meta_value = '%s' " ;
				$args[0] = '%' . like_escape($searchObj->gwpm_address) . '%';
				$userLists = $this->getUserIds($searchFilterOption, $filter, $args, $userLists, $wpdb) ;	
			}
					
			if (!isNull($searchObj->gwpm_gender)) {
				$args = array ();
				$filter = "meta_key = 'gwpm_gender' AND meta_value = '%s' " ;
				$args[0] = $searchObj->gwpm_gender;
				$userLists = $this->getUserIds($searchFilterOption, $filter, $args, $userLists, $wpdb) ;	
			}
			
			if (!isNull($searchObj->gwpm_martial_status)) {
				$args = array ();
				$filter = "meta_key = 'gwpm_martial_status' AND meta_value = '%s' " ;
				$args[0] = $searchObj->gwpm_martial_status;
				$userLists = $this->getUserIds($searchFilterOption, $filter, $args, $userLists, $wpdb) ;
			}
			
			if (!isNull($searchObj->gwpm_zodiac)) {
				$args = array ();
				$filter = "meta_key = 'gwpm_zodiac' AND meta_value = '%s' " ;
				$args[0] = $searchObj->gwpm_zodiac;
				$userLists = $this->getUserIds($searchFilterOption, $filter, $args, $userLists, $wpdb) ;
			}
			
			if (!isNull($searchObj->gwpm_starsign)) {
				$args = array ();
				$filter = "meta_key = 'gwpm_starsign' AND meta_value = '%s' " ;
				$args[0] = $searchObj->gwpm_starsign;
				$userLists = $this->getUserIds($searchFilterOption, $filter, $args, $userLists, $wpdb) ;
			}
			
			if (!isNull($searchObj->gwpm_sevvai_dosham)) {
				$args = array ();
				$filter = "meta_key = 'gwpm_sevvai_dosham' AND meta_value = '%s' " ;
				$args[0] = $searchObj->gwpm_sevvai_dosham;
				$userLists = $this->getUserIds($searchFilterOption,  $filter, $args, $userLists, $wpdb) ;
			}
			
			if (!isNull($searchObj->gwpm_caste)) {
				$args = array ();
				$filter = "meta_key = 'gwpm_caste' AND meta_value = '%s' " ;
				$args[0] = $searchObj->gwpm_caste;
				$userLists = $this->getUserIds($searchFilterOption,  $filter, $args, $userLists, $wpdb) ;
			}
			
			if (!isNull($searchObj->gwpm_religion)) {
				$args = array ();
				$filter = "meta_key = 'gwpm_religion' AND meta_value = '%s' " ;
				$args[0] = $searchObj->gwpm_religion;
				$userLists = $this->getUserIds($searchFilterOption,  $filter, $args, $userLists, $wpdb) ;
			}
			
			if (!isNull($searchObj->gwpm_has_photo)) {
				$args = array ();
				$filter = "(meta_key = 'gwpm_profile_photo' OR meta_key = 'gwpm_gallery_img' ) " .
						" AND (meta_value IS NOT NULL and meta_value != '%s' )" ;
				$args[0] = 'a:0:{}';
				$userLists = $this->getUserIds($searchFilterOption,  $filter, $args, $userLists, $wpdb) ;
			}
			
			if (!isNull($searchObj->gwpm_age_from) && !isNull($searchObj->gwpm_age_to)) {
				$args = array ();
				$filter = "meta_key = 'gwpm_dob' AND STR_TO_DATE(meta_value, '%s') BETWEEN CURDATE() - INTERVAL %d YEAR AND CURDATE() - INTERVAL %d YEAR " ;
				$args[0] = "%m/%d/%Y %l:%i %p";
				$args[1] = $searchObj->gwpm_age_to;
				$args[2] = $searchObj->gwpm_age_from;
				$userLists = $this->getUserIds($searchFilterOption,  $filter, $args, $userLists, $wpdb) ;
			}
			
			if (!isNull($searchObj->gwpm_dob)) {
				$args = array ();
				$filter = "meta_key = 'gwpm_dob' AND STR_TO_DATE(meta_value, '%s') < '%s' " ;
				$args[0] = "%m/%d/%Y %l:%i %p";
				$dt = new DateTime($searchObj->gwpm_dob);   				
				$args[1] = $dt->format('Y-m-d H:i:s'); 
				$userLists = $this->getUserIds($searchFilterOption, $filter, $args, $userLists, $wpdb) ;
			}
			
			if(isset($searchObj->gwpm_education)) {
				$gwpm_education = $searchObj->gwpm_education ;
				if ( isset($gwpm_education['qualification']) && !isNull($gwpm_education['qualification'] )) {
					$args = array ();
					$filter = "meta_key = 'gwpm_education' AND meta_value LIKE %s" ;
					$args[0] = '%s:13:"qualification";s:1:"' . like_escape($gwpm_education['qualification']) . '"%' ;
					$userLists = $this->getUserIds($searchFilterOption, $filter, $args, $userLists, $wpdb) ;
				}
				if (  isset($gwpm_education['status']) && !isNull($gwpm_education['status'] )) {
					$args = array ();
					$filter = "meta_key = 'gwpm_education' AND meta_value LIKE %s" ;
					$args[0] = '%s:6:"status";s:1:"' . like_escape($gwpm_education['status']) . '"%' ;
					$userLists = $this->getUserIds($searchFilterOption, $filter, $args, $userLists, $wpdb) ;
				}
			}
			
			$dynaData = getDynamicFieldData() ;
			$totalDynamicFields = $dynaData['gwpm_dynamic_field_count'] ;
			if($totalDynamicFields > 0) {
				$dyna_field_item = $dynaData['dyna_field_item'] ;
				if($dyna_field_item != null && sizeof($dyna_field_item) > 0) {
					$keys = array_keys($dyna_field_item)  ;
					foreach ($keys as $vkey) {
						if (!isNull($searchObj-> $vkey)) {
							appendLog( $vkey . ' - ' . $searchObj-> $vkey . ' * ' );
							$args = array ();
							$filter = "meta_value = '%s' AND meta_key = '" . $vkey . "' " ;
							$args[0] = like_escape( $searchObj-> $vkey );
							$userLists = $this->getUserIds($searchFilterOption, $filter, $args, $userLists, $wpdb) ;	
						}
					}
				}
			}
			
			appendLog( " Final List <br />" );
			
			if(isset($userLists) && $userLists!= null ) {
				foreach($userLists as $obj) {
					appendLog(  $obj );
					$tempObj = $this->getUserById( $obj );
					if (isset ($tempObj) && $tempObj != null)
						array_push($resultList, $tempObj);
				}
			}
			
		} else {
			$counter = 0;
			$args = array ();
			$queryString = "SELECT DISTINCT ($wpdb->usermeta.user_id) FROM $wpdb->usermeta ";
			if (!isNull($searchObj->username)) {
				$queryString .= $this->appendWhereOr("meta_value LIKE '%s' AND ( meta_key = 'first_name' OR meta_key='last_name' )", $counter);
				$args[$counter] = $searchObj->username . '%';
				$counter++;
			}
			if (!isNull($searchObj->gwpm_address)) {
				$queryString .= $this->appendWhereOr("meta_value = '%s' AND meta_key = 'gwpm_address' ", $counter);
				$args[$counter] = $searchObj->gwpm_address;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_gender)) {
				$queryString .= $this->appendWhereOr("meta_value = '%s' AND meta_key = 'gwpm_gender' ", $counter);
				$args[$counter] = $searchObj->gwpm_gender;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_martial_status)) {
				$queryString .= $this->appendWhereOr("meta_value = '%s' AND meta_key = 'gwpm_martial_status' ", $counter);
				$args[$counter] = $searchObj->gwpm_martial_status;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_zodiac)) {
				$queryString .= $this->appendWhereOr("meta_value = '%s' AND meta_key = 'gwpm_zodiac' ", $counter);
				$args[$counter] = $searchObj->gwpm_zodiac;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_starsign)) {
				$queryString .= $this->appendWhereOr("meta_value = '%s' AND meta_key = 'gwpm_starsign' ", $counter);
				$args[$counter] = $searchObj->gwpm_starsign;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_sevvai_dosham)) {
				$queryString .= $this->appendWhereOr("meta_value = '%s' AND meta_key = 'gwpm_sevvai_dosham' ", $counter);
				$args[$counter] = $searchObj->gwpm_sevvai_dosham;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_caste)) {
				$queryString .= $this->appendWhereOr("meta_value = '%s' AND meta_key = 'gwpm_caste' ", $counter);
				$args[$counter] = $searchObj->gwpm_caste;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_religion)) {
				$queryString .= $this->appendWhereOr("meta_value = '%s' AND meta_key = 'gwpm_religion' ", $counter);
				$args[$counter] = $searchObj->gwpm_religion;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_age_from) && !isNull($searchObj->gwpm_age_to)) {
				$queryString .= $this->appendWhereOr("meta_key = 'gwpm_dob' AND STR_TO_DATE(meta_value, '%s') BETWEEN CURDATE() - INTERVAL %d YEAR AND CURDATE() - INTERVAL %d YEAR ", $counter);
				$args[$counter] = "%m/%d/%Y %l:%i %p"; 
				$counter++;
				$args[$counter] = $searchObj->gwpm_age_to;
				$counter++;
				$args[$counter] = $searchObj->gwpm_age_from;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_dob)) {
				$queryString .= $this->appendWhereOr("meta_key = 'gwpm_dob' AND STR_TO_DATE(meta_value, '%s') < '%s' ", $counter);
				$args[$counter] = "%m/%d/%Y %l:%i %p"; 
				$counter++;
				$dt = new DateTime($searchObj->gwpm_dob);   				
				$args[$counter] = $dt->format('Y-m-d H:i:s'); 
				$counter++;
			}
			if (!isNull($searchObj->gwpm_has_photo)) {
				$queryString .= $this->appendWhereOr("(meta_key = 'gwpm_profile_photo' OR meta_key = 'gwpm_gallery_img' ) " .
						" AND (meta_value IS NOT NULL and meta_value != 'a:0:{}' )", $counter);
				$counter++;
			}
			
			appendLog( " Final Query " . $queryString );
			
			if ($counter > 0 ) {
				$preparedSql = $wpdb->prepare($queryString, $args);
				$result = $wpdb->get_results($preparedSql);
				foreach($result as $obj) {
					$tempObj = $this->getUserById( $obj->user_id );
					if (isset ($tempObj) && $tempObj != null)
						array_push($resultList, $tempObj);
				}
			}
		}
		return $resultList;
	}

	private function appendWhereOr($str, $counter) {
		if ($counter == 0) {
			$str = " WHERE ( " . $str . " ) ";
		} else {
			$str = " OR ( " . $str . " ) ";
		}
		return $str;
	}
	
	private function appendWhereAnd($str, $counter) {
		if ($counter == 0) {
			$str = " WHERE ( " . $str . " ) ";
		} else {
			$str = " AND ( " . $str . " ) ";
		}
		return $str;
	}
	
	private function appendQuery($str, $queryString) {
		return $queryString . $str  ;
	}
	
	private function getUserIds($searchOption, $filters, $args, $userList, $wpdb) {
		$resultList = array() ;
		$query = "SELECT DISTINCT $wpdb->usermeta.user_id FROM $wpdb->usermeta WHERE " . $filters ;
		appendLog('-----------' );
		appendLog( print_r($userList, true) );
		if($userList != null ) {
			if(sizeof($userList) > 0) {
				$userList = esc_sql( $userList );
				$userList = implode( ', ', $userList );
				if ($searchOption == '1')
					$query .= " AND " . user_id . " IN ( {$userList} ) ";
				else 
					$query .= " OR " . user_id . " IN ( {$userList} ) ";
			} else {
				if ($searchOption == '1')
					$query .= " AND " . user_id . " IN ( '' ) ";
			}
		}
		appendLog( $query );
		appendLog( print_r($args, true)) ;
		$preparedSql = $wpdb->prepare($query, $args);
		$result = $wpdb->get_results($preparedSql);
		$fetchedList = array() ;
		foreach($result as $obj) {
			appendLog ( $obj->user_id );
			$tempObj = $obj->user_id ;
			if (isset ($tempObj) && $tempObj != null)
				array_push($fetchedList, $tempObj);
		}
		return $fetchedList ;
	}

}
