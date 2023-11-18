<?php

require('./src/Controllers/UserController.php');
require('./src/Router/DTO/NewUserDTO.php');
require('./src/Router/DTO/UserDTO.php');
require('./src/Router/DTO/NewPasswordDTO.php');

function Router($request, $db, $ldap){
    $data = $request->getData();
    switch($request->method){
        case "addUser": return (new UserController($ldap))->addUser(new NewUserDTO($data));
        case "deleteUser": return (new UserController($ldap))->deleteUser(new UserDTO($data));
        case "resetPassword": return (new UserController($ldap))->resetPassword(new NewPasswordDTO($data));
        }
    return null;
}