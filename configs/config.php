<?php

$debug_mode_on = true;

$db = [
    "file" => "./src/DB/logs.db"
];

$LDAP = [
    "host" => "ldaps://test.udsu.ru/",
    "user"=> "test@test.udsu.ru",
    "password"=> "P@ssw0rd",
    "OU"=> "OU=test,DC=test,DC=udsu,DC=ru",
    "domain"=> "test.udsu.ru"
];

$rules = require_once("rules.php");

$API = [
    "listRequest" => [
        "POST" => [
            "addUser",
            "deleteUser",
            "resetPassword"
        ],
        "GET" => [
            "test"
        ]
    ],
    "rules" => $rules,
];

return [
    "debug_mode_on" => $debug_mode_on,
    "db" => $db,
    "LDAP" => $LDAP,
    "API" => $API
];