<?php

class ResetPasswordRequestDTO{
    private $login;
    private $password;

    function __construct($data){
        $this->login = $data['login'];
        $this->password = $data['password'];
    }

    function getLogin():string{
        return $this->login;
    }

    function getPassword():string{
        return $this->password;
    }
}