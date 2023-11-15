<?php

class UserService{

    function __construct($ldap){
        $this->ldap = $ldap;
        $this->config = $this->ldap->getConfig();
    }

    function addUser(NewUserDTO $user){

        $userCN = "CN=" . $user->getLogin() . "," . $this->config["OU"];

        if ($user->getPatronymic()) $givenName = $user->getFirstName() . " " . $user->getPatronymic();
        else $givenName = $user->getFirstName();
        if ($user->getLastName()) $displayName = $user->getLastName() . $givenName;
        else $displayName = $givenName;

        $userData = [
            "cn" => $user->getLogin(),
            "displayName" => $displayName,
            "givenName" => $givenName,
            "objectclass" => ["person","organizationalPerson","user"],
            "userPrincipalName" => $userDTO->getLogin() . "@" . $this->config["domain"],
            "sAMAccountName" => $userDTO->getLogin(),
            "pwdLastSet" => 0,
            "scriptPath" => $this->config["scriptPath"];
        ];

        if ($this->ldap->addUser($userCN, $userData)) {
            if ($this->ldap->resetPassword($userCN)) 
                if $this->ldap->enableUser($userCN)
                return [
                    "login" => $user->getLogin(),
                    "domain" => $this->config["domain"]
                ];
        };

        return null;
    }

    function setPassword(NewPasswordDTO $user){
        $userCN = "CN=" . $user->getLogin() . "," . $this->config["OU"];
        if ($this->ldap->setPassword($userCN, $user->getPassword())){
            return true;
        }
        return null;
    }

    function deleteUser(DeleteUserDTO $user){
        $userCN = "CN=" . $user->getLogin() . "," . $this->config["OU"];
        if ($this->ldap->enableUser($userCN)) return true;
        return null;
    }


    function setUserName(SetUserNameDTO $user){
        $userCN = "CN=" . $user->getLogin() . "," . $this->config["OU"];
        $userData = [];
        if ($this->ldap->setData($userCN, $userData)) return true;
        return null;
    }

    function login(LoginDTO $user){
        $userCN = "CN=" . $user->getLogin() . "," . $this->config["OU"];
        if ($this->ldap->validatePassword($userCN, $user)){
            return md5(random_bytes(25));
        }
        return null;
    }
}