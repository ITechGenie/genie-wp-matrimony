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

	function openSearch($searchObj) {
		global $wpdb;
		$resultList = array ();
		print_r($searchObj) ;
		appendLog('Inside openSearch metho in model : ' ) ;

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