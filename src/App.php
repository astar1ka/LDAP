<?php

require("./src/LDAP/LDAP.php");
require('./src/DB/DB.php');
require('./src/Logger/Logger.php');
require("./src/Request/Request.php");
require("./src/Response/Response.php");
require("./src/Router/Router.php");

class App{
    private $response;
    private $config;
    private $logger;

    function __construct($config){
        $this->response = new Response;
        $this->config = $config;
        set_exception_handler(fn(Throwable $e) => $this->exceptionsHandler($e));
        
    }

    function run($params, $headers) {
        $DB = new DB($this->config['db']);
        $this->logger = new Logger($DB);
        if ($this->logger) $this->logger->output($this->response);
        $LDAP = new LDAP($this->config['LDAP']);
        $request = new Request($params, $headers, $this->config["API"]);
        if ($this->logger) $this->logger->input($request);
        $this->response->good(Router($request, $DB, $LDAP));
        $this->logger->save();

    }

    private function exceptionsHandler(Throwable $e){
        if ($e instanceof APIException) $this->response->error($e->getMessage());
        else $this->response->error("Критическая ошибка " . $e->getMessage());
        if ($this->logger) $this->logger->save();
    }
}