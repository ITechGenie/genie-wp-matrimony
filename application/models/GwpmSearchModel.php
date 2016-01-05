<?php

/*
 * Created on Apr 28, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class GwpmSearchModel {

	function getUserById($userId) {
		$userObj = get_userdata($userId);
		if (isset ($userObj) && isset ($userObj->ID) && !user_can($userObj->ID, 'level_10') && user_can($userObj->ID, 'matrimony_user')) {
			return $userObj;
		}
		return null;
	}

	function getDynamicFieldData() {
		return getDynamicFieldData() ; ;
	}

	function searchUsers($searchObj) {
		global $wpdb;
		$resultList = array ();
		if (!isNull($searchObj->userId)) {
			$tempObj = $this->getUserById(getStrippedUserId($searchObj->userId));
			if (isset ($tempObj) && $tempObj != null)
				array_push($resultList, $tempObj);
		} else if (true) {
			$counter = 0;
			$filterCounter= 0;
			$args = array ();
			$filter = array();
			$joins = array();
			$userLists = null ;

			if(sizeof($filter) ==0 )
			{
				$args = array ();
				$filter = "WHERE ( meta_key = 'first_name' OR meta_key='last_name' ) AND meta_value LIKE '%s'" ;
				$args[0] =  '%';
				$userLists = $this->getUserIds($filter, $args, $userLists, $wpdb) ;
				// userLists contains an array of all user ids
			}
			else{
				$userLists = $this->getUserIds(join(" ",$joins)." WHERE ".join(" AND ",$filter), $args, $userLists, $wpdb) ;
			}
			/*
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
							$userLists = $this->getUserIds($filter, $args, $userLists, $wpdb) ;
						}
					}
				}
			}*/

			// get only 100 of these
			$users = array_slice($userLists, -300, 300, true);

			appendLog( " Final List <br />" );
			if(isset($users) && $users!= null ) {
				foreach($users as $obj) {
					appendLog(  $obj );
					// then query by getUserById
					$tempObj = $this->getUserById( $obj );
					if (isset ($tempObj) && $tempObj != null)
						array_push($resultList, $tempObj);
				}
			}

		} else {
			/*
			$counter = 0;
			$args = array ();
			$queryString = "SELECT DISTINCT ($wpdb->usermeta.user_id) FROM $wpdb->usermeta ";

			if (!isNull($searchObj->username)) {
				$queryString .= $this->appendWhereAnd("meta_value LIKE '%s' AND ( meta_key = 'first_name' OR meta_key='last_name' )", $counter);
				$args[$counter] = $searchObj->username . '%';
				$counter++;
			}
			if (!isNull($searchObj->gwpm_address)) {
				$queryString .= $this->appendWhereAnd("meta_value = '%s' AND meta_key = 'gwpm_address' ", $counter);
				$args[$counter] = $searchObj->gwpm_address;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_gender)) {
				$queryString .= $this->appendWhereAnd("meta_value = '%s' AND meta_key = 'gwpm_gender' ", $counter);
				$args[$counter] = $searchObj->gwpm_gender;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_martial_status)) {
				$queryString .= $this->appendWhereAnd("meta_value = '%s' AND meta_key = 'gwpm_martial_status' ", $counter);
				$args[$counter] = $searchObj->gwpm_martial_status;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_zodiac)) {
				$queryString .= $this->appendWhereAnd("meta_value = '%s' AND meta_key = 'gwpm_zodiac' ", $counter);
				$args[$counter] = $searchObj->gwpm_zodiac;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_starsign)) {
				$queryString .= $this->appendWhereAnd("meta_value = '%s' AND meta_key = 'gwpm_starsign' ", $counter);
				$args[$counter] = $searchObj->gwpm_starsign;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_sevvai_dosham)) {
				$queryString .= $this->appendWhereAnd("meta_value = '%s' AND meta_key = 'gwpm_sevvai_dosham' ", $counter);
				$args[$counter] = $searchObj->gwpm_sevvai_dosham;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_caste)) {
				$queryString .= $this->appendWhereAnd("meta_value = '%s' AND meta_key = 'gwpm_caste' ", $counter);
				$args[$counter] = $searchObj->gwpm_caste;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_religion)) {
				$queryString .= $this->appendWhereAnd("meta_value = '%s' AND meta_key = 'gwpm_religion' ", $counter);
				$args[$counter] = $searchObj->gwpm_religion;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_age_from) && !isNull($searchObj->gwpm_age_to)) {
				$queryString .= $this->appendWhereAnd("meta_key = 'gwpm_dob' AND STR_TO_DATE(meta_value, '%s') BETWEEN CURDATE() - INTERVAL %d YEAR AND CURDATE() - INTERVAL %d YEAR ", $counter);
				$args[$counter] = "%m/%d/%Y %l:%i %p";
				$counter++;
				$args[$counter] = $searchObj->gwpm_age_to;
				$counter++;
				$args[$counter] = $searchObj->gwpm_age_from;
				$counter++;
			}
			if (!isNull($searchObj->gwpm_dob)) {
				$queryString .= $this->appendWhereAnd("meta_key = 'gwpm_dob' AND STR_TO_DATE(meta_value, '%s') < '%s' ", $counter);
				$args[$counter] = "%m/%d/%Y %l:%i %p";
				$counter++;
				$dt = new DateTime($searchObj->gwpm_dob);
				$args[$counter] = $dt->format('Y-m-d H:i:s');
				$counter++;
			}
			if (!isNull($searchObj->gwpm_has_photo)) {
				$queryString .= $this->appendWhereAnd("(meta_key = 'gwpm_profile_photo' OR meta_key = 'gwpm_gallery_img' ) " .
						" AND (meta_value IS NOT NULL and meta_value != 'a:0:{}' )", $counter);
				$counter++;
			}
			if ($counter > 0 ) {
				$preparedSql = $wpdb->prepare($queryString, $args);
				$result = $wpdb->get_results($preparedSql);
				foreach($result as $obj) {
					$tempObj = $this->getUserById( $obj->user_id );
					if (isset ($tempObj) && $tempObj != null)
						array_push($resultList, $tempObj);
				}
			}*/
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

	private function getUserIds($filters, $args, $userList, $wpdb) {
		$resultList = array() ;
		$query = "SELECT DISTINCT a.user_id FROM $wpdb->usermeta a " . $filters ;
		appendLog('-----------' );
		appendLog( print_r($userList, true) );
		if($userList != null ) {
			if(sizeof($userList) > 0) {
				$userList = esc_sql( $userList );
				$userList = implode( ', ', $userList );
				$query .= "OR " . user_id . " IN ( {$userList} )";
			} else {
				// $query .= "AND " . user_id . " IN ( ) ";
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