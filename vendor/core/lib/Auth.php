<?php

namespace core\lib;

class Auth {

    private static $header = [];
    
    private const KEY_SECRET="asd78s7a9872jahs>sad";
    
    private static $payload = [
        "expire_at" => 15
    ];

    
    public static function packData($payload = []){
        self::$payload = array_merge(self::$payload,$payload);
        // self::$payload['expire_at'] = self::$payload['expire_at']*3600;
        $serialize_data = base64_encode(serialize(self::$header)).".".base64_encode(serialize(self::$payload));
        return base64_encode(serialize(self::$header)).".".base64_encode(serialize(self::$payload)).".".self::sign($serialize_data);
    }

    public static function validToken($token){
        $arrToken = explode(".",$token);
        return self::sign($arrToken[0].".".$arrToken[1]) == $arrToken[2];
    }



    public static function sign($serialize_data){
        return hash_hmac('sha256',$serialize_data,self::KEY_SECRET);
    }

    public static function setExpireAt(int $time){
        self::$payload['expire_at'] = $time;
    }




}