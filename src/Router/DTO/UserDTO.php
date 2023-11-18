<?php

class UserDTO{
    private $login;

    function __construct($data){
        $this->login = $data['login'];
    }

    function getLogin():string{
        return $this->login;
    }
}