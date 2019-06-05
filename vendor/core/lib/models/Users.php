<?php

namespace core\lib\models;
use core\lib\Model;


class Users extends Model{
    protected $field_id = "id_user";
    protected $path = 'store_data/users';
    private $id = null;

    public function setData($data){
        $this -> data = $data;
    }

    public function getUserByEMail( $value){
        return $this -> getValueByField('email',$value);
    }

    public function isCheckPassword($password,$email){
       return   $this -> getUserByEMail($email)['password'] == $password ? 
        $this -> getUserByEMail($email)[$this -> field_id] : false;
    }
}
