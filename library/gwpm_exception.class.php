<?php

class GwpmCommonException extends Exception {

    function __construct($message = '') {
    	echo '<b> GwpmCommonException: </b>' . $message . '<br />' ;
    	// throw new Exception($message) ;  
    	appendLog($message) ;
    }
    
}