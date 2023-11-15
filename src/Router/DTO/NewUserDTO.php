<?php

class NewUserDTO{
    private $firstName;
    private $lastName;
    private $patronymic;
    private $login;
    private $unit;

    function __construct($data){
        $this->firstName = $data['fullName']['firstName'];
        $this->lastName = $data['fullName']['lastName'];
        $this->patronymic = $data['fullName']['patronymic'];
        $this->login = $data['login'];
        $this->unit = $data['unit'];
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