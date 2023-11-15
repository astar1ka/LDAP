<?php

require_once('./src/Exception/APIException.php');

class UserAlreadyExistsException extends APIException {
    function __construct(){
        $this->message = "Пользователь с таким логином уже существует";
    }
}