<?php

class Response{

    private $data = null;
    private $error = null;

    function __construct(){
    }

    private function send($message){
        echo(json_encode($message));
    }

    public function good($data){
        if ($data) {
            $this->data=$data;
            $this->send([
                "result" => true,
                "data" => $data
            ]);
        }
        else $this->error("Неизвестная ошибка");
    }

    public function error($message){
        $this->error = $message;
        $this->send([
            "result" => false,
            "error" => $message
        ]);
    }
}