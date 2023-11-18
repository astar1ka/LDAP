<?php

require("./src/Request/DTO/AddUserRequestDTO.php");
require("./src/Request/DTO/ResetPasswordRequestDTO.php");
require("./src/Request/Exceptions/UnknownAPIMethodException.php");
require("./src/Request/Validator/Validator.php");

class Request{

    private $data = [];
    public $method;
    public $caller;
    public $date;

    function __construct($request, $headers, $API)
    {
        $apiMethod = $headers["REQUEST_METHOD"];
        if (array_key_exists("caller",$request)) $this->caller = $request["caller"];
        else throw new UnknownAPIMethodException;
        if (
            array_key_exists("method",$request) && 
            in_array($request["method"],$API["listRequest"][$apiMethod]))
        {
            $this->method = $request["method"];
            $this->requestParse(Validator::validate($request, $API["rules"][$this->method]));
            $this->date = date("d-m-Y H:i:s");
        }
        else throw new UnknownAPIMethodException;
    }

    private function requestParse($request){
        foreach($request as $key=>$value) 
        {
            $this->data[$key] = $value;
        }
    }

    function getData(){
        return $this->data;
    }
}