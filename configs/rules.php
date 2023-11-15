<?php

$addUser = [
    "fullName" => [
        "type" => "object",
        "required" => true,
        "properties" => [
            "firstName" => [
                "type" => "string",
                "values" => "[^а-яА-Я\-ёЁчЧ]",
                "required" => true
            ],
            "lastName" => [
                "type" => "string",
                "values" => "[^а-яА-Я\-ёЁчЧ]",
                "required" => false,
                "defaultValue" => ""
            ],
            "patronymic" => [
                "type" => "string",
                "values" => "[^а-яА-Я\-ёЁчЧ]",
                "required" => false,
                "defaultValue" => ""
            ]
        ]
    ],
    "login" => [
        "type" => "string",
        "values" => "[^a-zA-Z0-9\-_]",
        "required" => true
    ],
    "unit" => [
        "type" => "string",
        "values" => "[^а-яА-Я\-ёЁчЧ]",
        "required" => false,
        "defaultValue" => "Сотрудник"
    ]
];

$resetPassword = [
    "login" => [
        "type" => "string",
        "values" => "[^a-zA-Z0-9\-_]",
        "required" => true
    ],
    "password" => [
        "type" => "string",
        "values" => "[^а-яА-Яa-zA-Z0-9\-_@!#$%^&*()=+ёч]",
        "required" => true
    ],
];

return [
    "addUser" => $addUser,
    "resetPassword" => $resetPassword
];