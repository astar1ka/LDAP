<?php

class UserController{

    private $LDAP;

    function __construct($ldap){
        $this->LDAP = $ldap;
    }

    public function addUser($newUserDTO) {
        return $this->LDAP->addUser($newUserDTO);
    }

    public function deleteUser($userDTO) {
        return $this->LDAP->deleteUser($userDTO);
    }

    public function resetPassword($newPasswordDTO) {
        return $this->LDAP->newPassword($newPasswordDTO);
    }

}