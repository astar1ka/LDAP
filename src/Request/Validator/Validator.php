<?php

class Validator {
    static function validate($data, $rules){
        $result = [];
        foreach($rules as $key=>$value) {
            if (array_key_exists($key,$data)){
                $validateValue = $data[$key];
                switch($value["type"]){
                    case "string": if (!is_string($data[$key]) || preg_match("/" . $value["values"] . "+/", $data[$key])) die("Error 2: " . $key);
                        break;
                    case "object": if (is_array($data[$key])) $validateValue = Validator::validate($data[$key], $value["properties"]); else die("Error 3: " . $value["type"]);
                        break;
                };
                $result[$key] = $validateValue;
            }
            elseif ($value["required"]) die($key);
            else $result[$key] = $value["defaultValue"];
        }
        return $result;
    }
}
