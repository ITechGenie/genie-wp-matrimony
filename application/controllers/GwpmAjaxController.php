<?php
/*
 * Created on May 3, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class GwpmAjaxController {
	function processRequest($controlObj){
		$model = $controlObj["model"] ;
		switch ($model) {
			case "gallery_delete":
				$this->delete_gallery_photo($controlObj);
				break;
			case "dynafield_delete":
				$this->dynafield_delete($controlObj) ;
				break;
			default:
				appendLog ( "Invalid Ajax request." );
		}
	}

	function delete_gallery_photo($controlObj) {
		$galleryModel = new GwpmGalleryModel();
		$galleryModel->delete($controlObj["userId"], $controlObj["val"]) ;
	}

	function dynafield_delete($controlObj) {
		$adminModel = new GwpmAdminModel() ;
		$adminModel-> deleteDynamicField($controlObj["val"]) ;
	}

	function openSearch($controlObj) {
		$searchModel = new GwpmSearchModel() ;		
		$searchModel->openSearch($controlObj) ;
		print_r($controlObj) ;
	}

	function processOpenRequest($controlObj){
		$model = $controlObj["model"] ;
		if ($model == "open_search" ) {
			$val = $controlObj["val"] ;
			$searchVal = $this->get_query_string_values ($controlObj["val"]) ;
			$this->openSearch($searchVal);
		}
	}

	function get_query_string_values($vars) {
		$queryStrings = array ();
		$qStrs = explode('&', $vars);
		foreach ($qStrs as $qStr) {
			appendLog( $qStr );
			$pairs = explode('=', $qStr);
			$queryStrings[$pairs[0]] = $pairs[1];
		}
		return $queryStrings;
	}

}
