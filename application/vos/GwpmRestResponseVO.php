<?php

/*
 * Created on May 8, 2017
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class GwpmRestResponseVO {
    
    var $data;
    var $message = "SUCSESS"; 
    
    public static function getInstance($data, $message= 'SUCSESS') {
        $instance = new self();
        $instance->data = $data ;
        $instance->message = $message;
        return $instance;
    }
}