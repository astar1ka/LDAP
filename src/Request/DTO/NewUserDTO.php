<?php

class NewUserDTO{
    private $firstName;
    private $lastName;
    private $patronymic;
    private $login;
    private $unit;

    function __construct($request){
        $this->firstName = $request['fullName']['firstName'];
        $this->lastName = $request['fullName']['lastName'];
        $this->patronymic = $request['fullName']['patronymic'];
        $this->login = $request['login'];
        $this->unit = $request['unit'];
    }

    function getFirstName():string{
        return $this->firstName;
    }

    function getLastName():string{
        return $this->lastName;
    }

    function getPatronymic():string{
        return $this->patronymic;
    }

    function getLogin():string{
        return $this->login;
    }

    function getUnit():string{
        return $this->unit;
    }

}