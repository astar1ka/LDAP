<?php

require_once('./src/Exception/APIException.php');

class UnknownAPIMethodException extends APIException {
    function __construct(){
        $this->message = "Анонимный вызов запрещен";
    }
}