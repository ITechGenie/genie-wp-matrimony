<?php
class GwpmActivityController extends GwpmMainController {

	function addActivityLog() {
		$this->_model->addActivityLog("login", "sample");
	}
	
	function view() {
	    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
		if(isset($_GET['pid'])) $pid = $_GET['pid'] ;
		else $pid = null ;
		$this->set('model', $this->_model->getUserActivity($pid));
	}

}