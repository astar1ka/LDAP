<?php

class Logger{

    private $DB;

    function __construct($DB){
        $this->DB = $DB;
    }


    function input($request){
        /*$event = $this->DB->addEvent(
            "input",
            $request->method, 
            $request->caller,
            $request->date);
        $this->DB->addEventAttributes();*/
    }

    function output($response){
        /*$event = $this->DB->addEvent(
            "output"
        );*/
    }

    function save(){

    }

    function view($page){
        /*return $this->DB->getEvents($page);*/
    }
}