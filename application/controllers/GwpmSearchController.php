<?php
class GwpmSearchController extends GwpmMainController {

	function view() {
		$this->set("model", $this->_model->getDynamicFieldData()) ;
	}
	
	function update() {
		$_keys = getDynamicFieldKeys() ;
		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$searchObj = new GwpmSearchVO($_POST, $_keys);
		appendLog("Search Object: " . print_r($searchObj, true) ) ;
		$this->set("model", $this->_model->searchUsers($searchObj)) ;
	}

}