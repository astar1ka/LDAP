<?php

class UserService{

    function __construct($ldap){
        $this->ldap = $ldap;
    }

    private function randomPassword(){
        return crypt(rand() . rand() . rand(), rand(). rand() . rand());
    }

    private function concatName($name, $patronymic = null, $lastName = null){
        $result = $name;
        if ($patronymic) $result = $result . " " . $patronymic;
        if ($lastName) $result = $lastName . " " . $result;
        return $result;
    }

    function addUser(NewUserDTO $user){

        $userCN = $this->ldap->formatUserLogin($user->getLogin());

        $userData = [
            "cn" => $userCN,
            "displayName" => $this->concatName($user->getName(), $user->getPatronymic(), $user->getLastName()),
            "givenName" => $this->concatName($user->getName(), $user->getPatronymic()),
            "objectclass" => ["person","organizationalPerson","user"],
            "userPrincipalName" => $userDTO->getLogin() . "@" . $this->ldap->getDomain(),
            "sAMAccountName" => $userDTO->getLogin(),
            "pwdLastSet" => 0,
            "scriptPath" => $this->ldap->getScriptPath();
        ];

        if ($this->ldap->addUser($userCN, $userData)) {
            if ($this->ldap->setPassword($userCN, $this->randomPassword() . "$%$104" . $this->randomPassword())) 
                if $this->ldap->enableUser($userCN);
                return [
                    "login" => $user->getLogin(),
                    "domain" => $this->ldap->getDomain()
                ];
        };

        return null;
    }

    function setPassword(NewPasswordDTO $user){
        $userCN = $this->ldap->formatUserLogin($user->getLogin());
        if ($this->ldap->setPassword($userCN, $user->getPassword())){
            return true;
        }
        return null;
    }

    function deleteUser(DeleteUserDTO $user){
        $userCN = $this->ldap->formatUserLogin($user->getLogin());
        if ($this->ldap->disableUser($userCN)) return true;
        return null;
    }


    /*function setUserName(SetUserNameDTO $user){
        $userCN = $this->ldap->formatUserLogin($user->getLogin());
        $userData = [];
        if ($this->ldap->setData($userCN, $userData)) return true;
        return null;
    }*/

    /*function login(LoginDTO $user){
        $userCN = $this->ldap->formatUserLogin($user->getLogin());
        if ($this->ldap->validatePassword($userCN, $user)){
            return md5(random_bytes(25));
        }
        return null;
    }*/
}