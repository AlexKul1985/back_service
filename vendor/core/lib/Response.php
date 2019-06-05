<?php

namespace core\lib;

class Response {

    public function setHeaders(array $headers){
        foreach ($headers as $key => $value) {
            header($key.":".$value);
        }
    }

    public function sandJson(array $data){
        echo json_encode($data);
    }

}