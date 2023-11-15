<?php
//Подключаем модули

require('./src/App.php');

error_reporting(0);
$config = require_once("./configs/config.php");
if ($config["debug_mode_on"]) error_reporting(-1);

$app = new App($config);
if (count($_REQUEST) != 0) {
    $app->run($_REQUEST, $_SERVER);
} 
else
echo("It's run!");