<?php

require('./src/LDAP/Exceptions/UserAlreadyExistsException.php');
require('./src/LDAP/Exceptions/LDAPConnectErrorException.php');

class LDAP{

    private $DS;
    private string $OU;
    private string $domain;

    function __construct($config){
        $this->domain = $config["domain"];
        $this->scriptPath = $config["scriptPath"];
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

    function setPassword(string $userCN, string $password){
        $newPassword = iconv("UTF-8", "UTF-16LE", '"' . $password . '"');
        $modify = [
            [
                "attrib"  => "unicodePwd",
                "modtype" => LDAP_MODIFY_BATCH_REPLACE,
                "values"  => [$newPassword]
            ]
        ];
        return (!ldap_modify_batch($this->DS, $userCN , $modify));
    }

    function formatUserLogin($userLogin){
        return "CN=" . $newPasswordDTO->getLogin() . "," . $this->OU;
    }

    function getDomain(){
        return $this->domain;
    }

    function getSctiptPath(){
        return $this->scriptPath;
    }

    function enableUser(){
        return ldap_modify($this->DS, $userCN, [
            "useraccountcontrol" => 512
        ]);
    }

    function disabledUser(){
        return ldap_modify($this->DS, $userCN, [
            "useraccountcontrol" => 2
        ]);
    }

    function addUser($userCN, $userData){
        return ldap_add($this->DS, $userCN , $userData);
    }
}