<?php

require('./src/Controllers/UserController.php');

function Router($request, $db, $ldap){
    switch($request->method){
        case "addUser": return (new UserController($ldap))->addUser($request->getDTO());
        case "deleteUser": return (new UserController($ldap))->deleteUser($request->getDTO());
        case "resetPassword": return (new UserController($ldap))->resetPassword($request->getDTO());
        }
    return null;
}