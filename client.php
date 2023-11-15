<?php

$url = 'http://localhost/';

$params = (object)array(
    'method' => "addUser",
    'caller' => "php_test",
    'fullName' => (object)array(
      "firstName"=> "Олег"
    ),
    'login' => "php_test57",
  );
$result = file_get_contents($url, false, stream_context_create(array(
    'http' => array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query($params)
    )
)));

echo $result;