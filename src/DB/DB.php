<?php

class DB{

    private $db;

    function __construct($config){
        try {
            $this->db = new PDO('sqlite:' . $config["file"]);
        }
        catch(Throwable $e){
            return null;
        }
    }

    function __destruct(){
        $this->db = null;
    }

    private function addEvent($type, $caller, $date, $source){
        $this->db->query();
    }

    private function addEventAttributes($eventId, $name, $value){
        $this->db->query();
    }


}