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
		return getDynamicFieldData() ;
	}

	private function getSearchFields($vars) {
		$queryStrings = array ();
		$qStrs = explode('&', $vars);
		foreach ($qStrs as $qStr) {
			appendLog( $qStr );
			$pairs = explode('=', $qStr);
			$queryStrings[$pairs[0]] = $pairs[1];
		}
		return $queryStrings;
	}

	private function changeDateformat($dob)
	{
		$dob = explode(" ",$dob);
		$dob[0] = explode("/",$dob[0]);
		$dob[0] = $dob[0][1]."/".date('F', mktime(0, 0, 0, $dob[0][0], 10))."/".$dob[0][2];
		return " ".join(" ",$dob);
	}

	private function refineSearchData($resultList) {
		$allUsers = array();
		$count = 0;
		foreach($resultList as $userObj) {
			$respData = Array() ;
			$userid = $userObj->ID ;
			$respData['display_name'] = $userObj->gwpm_full_name ;
			$respData['gwpm_gender'] = $userObj->gwpm_gender ;
			// $respData['gwpm_gender'] = $userObj->gwpm_gender ;
			$respData['gwpm_id'] = $userid ;
			$respData['gwpm_dob'] = $this->changeDateformat ( $userObj->gwpm_dob );
			$respData['gwpm_martial_status'] = $userObj->gwpm_martial_status ;
			$respData['user_email'] = $userObj->user_email ;
			$respData['gwpm_profile_url'] =   wp_nonce_url('' , 'gwpm') . '&page=profile&action=view&pid=' . $userid ;
			$respData['gwpm_image_url'] = getGravatarImageSrc($userid) ;
			$allUsers[$count++] =  $respData ;
		}
		return $allUsers ;
	}

	function openSearch($searchString ) {
		global $wpdb;
		$resultList = array ();

		$searchObj = $this->getSearchFields ( $searchString ) ;

		// print_r($searchObj) ;

		$l_gender = $searchObj['gwpm_gender'] ;
		$l_age_from = $searchObj['gwpm_age_from'] ;
		$l_age_to = $searchObj['gwpm_age_to'] ;
		$l_m_status = $searchObj['gwpm_martial_status'] ;
		$l_page_no = $searchObj['gwpm_page_no'] ;

		appendLog( $l_gender . ' - ' . $l_age_from . ' - ' . $l_age_to . ' - ' . $l_m_status . ' - ' . $l_page_no) ;

		$queryString = "SELECT DISTINCT $wpdb->usermeta.user_id FROM $wpdb->usermeta ";
		$counter = 0 ;

		if (!isNull($l_gender)) {
			$queryString .= $this->appendWhereAnd("meta_value = '%s' AND meta_key = 'gwpm_gender' ORDER BY $wpdb->usermeta.user_id DESC ", $counter);
			$args[$counter] = $l_gender;
			$counter++;
		}

		if (!isNull($l_m_status)) {
			if ($counter == 0) {
				$queryString .= $this->appendWhereAnd("meta_value = '%s' AND meta_key = 'gwpm_martial_status' ORDER BY $wpdb->usermeta.user_id DESC ", $counter);
			} else {
				$queryString = " SELECT DISTINCT $wpdb->usermeta.user_id FROM $wpdb->usermeta WHERE ($wpdb->usermeta.user_id) in ( " . $queryString . " ) and meta_value = '%s' AND meta_key = 'gwpm_martial_status' ORDER BY $wpdb->usermeta.user_id DESC ";
			}
			$args[$counter] = $l_m_status;
			$counter++;
		}
			
		if (!isNull($l_age_from) && !isNull($l_age_to)) {

			if ($counter == 0) {
				$queryString .= $this->appendWhereAnd("meta_key = 'gwpm_dob' AND STR_TO_DATE(meta_value, '%s') BETWEEN ( CURDATE() - INTERVAL %d YEAR ) AND ( CURDATE() - INTERVAL %d YEAR) ORDER BY $wpdb->usermeta.user_id DESC ", $counter);
			} else {
				$queryString = " SELECT DISTINCT $wpdb->usermeta.user_id FROM $wpdb->usermeta WHERE ($wpdb->usermeta.user_id) in ( " . $queryString . " ) ";
				$queryString .= " and meta_key = 'gwpm_dob' AND STR_TO_DATE(meta_value, '%s') BETWEEN ( CURDATE() - INTERVAL %d YEAR ) AND ( CURDATE() - INTERVAL %d YEAR) ORDER BY $wpdb->usermeta.user_id DESC " ;
			}

			$args[$counter] = "%m/%d/%Y %l:%i %p";
			$counter++;
			$args[$counter] = $l_age_to;
			$counter++;
			$args[$counter] = $l_age_from;
			$counter++;
		}
			
		if ($counter > 0 ) {

			$pageNo = 1 ;
			if (isset ($l_page_no) && $l_page_no > 0) {
				$pageNo = $l_page_no ;
			}
			$responseCount = ( $pageNo * GWPM_PAGINATION_PAGE_SIZE ) - GWPM_PAGINATION_PAGE_SIZE;
			$queryString = $queryString . " LIMIT %d, " . GWPM_PAGINATION_PAGE_SIZE  ;
			$args[$counter] = $responseCount;

			appendLog('$queryString: ' . $queryString ) ;

			$preparedSql = $wpdb->prepare($queryString, $args);
			$result = $wpdb->get_results($preparedSql);
			foreach($result as $obj) {
				$tempObj = $this->getUserById( $obj->user_id );
				if (isset ($tempObj) && $tempObj != null)
				array_push($resultList, $tempObj);
			}
		}
		echo json_encode( $this->refineSearchData( $resultList ) ) ;
	}

	function searchUsers($searchObj) {
		return $searchObj ;
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
			$str = " WHERE  " . $str . "  ";
		} else {
			$str = " AND ( " . $str . " ) ";
		}
		return $str;
	}

	private function appendForQuickSearch($qString, $str, $counter) {
		if ($counter == 0) {
			$str = " SELECT DISTINCT ($wpdb->usermeta.user_id) FROM WHERE ( " . $str . " ) ";
		} else {
			$str = " AND $wpdb->usermeta.user_id in ( select $wpdb->usermeta.user_id from ($wpdb->usermeta.user_id) where " . $str . " ) ";
		}
		return $str;
	}

	private function appendQuery($str, $queryString) {
		return $queryString . $str  ;
	}

	private function getUserIds($filters, $args, $userList, $wpdb) {
		$resultList = array() ;
		$query = "SELECT DISTINCT a.user_id FROM $wpdb->usermeta a where " . $filters . ' order by  a.user_id asc' ;
		if($userList != null ) {
			if(sizeof($userList) > 0) {
				$userList = esc_sql( $userList );
				$userList = implode( ', ', $userList );
				$query .= " AND " . user_id . " IN ( {$userList} )";
			} else {
				// $query .= "AND " . user_id . " IN ( ) ";
			}
		}
		appendLog( $query );
		//  appendLog( print_r($args, true)) ;
		$preparedSql = $wpdb->prepare($query, $args);
		$result = $wpdb->get_results($preparedSql);
		$fetchedList = array() ;
		foreach($result as $obj) {
			// appendLog ( $obj->user_id );
			$tempObj = $obj->user_id ;
			if (isset ($tempObj) && $tempObj != null)
			array_push($fetchedList, $tempObj);
		}
		return $fetchedList ;
	}

}
