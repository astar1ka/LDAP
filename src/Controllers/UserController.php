<?php

require('./src/Services/UserService.php');

class UserController{

    private $LDAP;

    function __construct($ldap){
        $this->UserService = new UserService($ldap);
    }

    public function addUser($newUserDTO) {
        return $this->UserService->addUser($newUserDTO);
    }

    public function deleteUser($userDTO) {
        return $this->UserService->deleteUser($userDTO);
    }

    public function resetPassword($newPasswordDTO) {
        return $this->UserService->newPassword($newPasswordDTO);
    }
}