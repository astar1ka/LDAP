<?php

require_once('./src/Exception/APIException.php');

class LDAPConnectErrorException extends APIException {
    function __construct(){
        $this->message = "Ошибка подключения к домену";
    }
}