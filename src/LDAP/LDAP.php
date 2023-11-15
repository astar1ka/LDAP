<?php

require('./src/LDAP/Exceptions/UserAlreadyExistsException.php');
require('./src/LDAP/Exceptions/LDAPConnectErrorException.php');

class LDAP{

    private $DS;
    private string $OU;
    private string $domain;

    function __construct($config){
        $this->domain = $config["domain"];
        $this->OU = $config["OU"];
        $this->DS = ldap_connect($config["host"]);
        ldap_set_option($this->DS, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($this->DS, LDAP_OPT_REFERRALS, 0);
        if (!ldap_bind($this->DS,$config["user"],$config["password"])) throw new LDAPConnectErrorException;
    }

    function __destruct(){
        ldap_close($this->DS);
    }

    private function findUserByLogin($login){
        return ldap_find($this->DS, "CN=" . $login. ",OU=test,DC=test,DC=udsu,DC=ru");
    }

    private function randomPassword(){
        return crypt(rand() . rand() . rand(), rand(). rand() . rand());
    }

    private function resetPassword(string $user, string $password){
        $newPassword = iconv("UTF-8", "UTF-16LE", '"' . $password . '"');
        $modify = [
            [
                "attrib"  => "unicodePwd",
                "modtype" => LDAP_MODIFY_BATCH_REPLACE,
                "values"  => [$newPassword]
            ]
        ];
        if (!ldap_modify_batch($this->DS, $user , $modify)) throw new LDAPConnectErrorException;
        return true;
    }

    function addUser($userDTO){
        $userCN = "CN=" . $userDTO->getLogin() . "," . $this->OU;
        $name = $userDTO->getFirstName();
        if ($userDTO->getPatronymic()) $givenName = $name . " " . $userDTO->getPatronymic();
        else $givenName = $name;
        if ($userDTO->getLastName()) $fullName = $userDTO->getLastName() . $fullName;
        else $fullName = $givenName;
        
        $data = [
            "cn" => $userDTO->getLogin(),
            "displayName" => $fullName,
            "givenName" => $givenName,
            "objectclass" => ["person","organizationalPerson","user"],
            "userPrincipalName" => $userDTO->getLogin() . "@" . $this->domain,
            "sAMAccountName" => $userDTO->getLogin(),
            "pwdLastSet" => 0,
            "scriptPath" => "logon.bat"
        ];
        if ($userDTO->getLastName()) $data["cn"] = $userDTO->getLastName();
        if(ldap_add($this->DS, $userCN , $data)){
            if ($this->resetPassword($userCN,$this->randomPassword() . "$%$104" . $this->randomPassword()));
                ldap_modify($this->DS, $userCN, [
                    "useraccountcontrol" => 512
                ]);
        }
        else throw new UserAlreadyExistsException;
        return [
            "userData" => [
                "login" => $userDTO->getLogin(),
                "domain" => $this->domain
            ],
        ]; 
    }

    function newPassword($newPasswordDTO){
        $userCN = "CN=" . $newPasswordDTO->getLogin() . "," . $this->OU;
        return ($this->resetPassword($userCN,$newPasswordDTO->getPassword()));
    }

    function getInfo(){
        
    }
}