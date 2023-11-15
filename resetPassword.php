<?php

$url = 'http://localhost/';

$params = (object)array(
    'method' => "resetPassword",
    'caller' => "php_test",
    'login' => "php_test54",
    'password' => 'P@$$w0rd'
  );
$result = file_get_contents($url, false, stream_context_create(array(
    'http' => array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query($params)
    )
)));

echo $result;