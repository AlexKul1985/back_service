<?php

namespace core\lib\models;
use core\lib\Model;

class Articles extends Model{
    protected $field_id = "id_article";
    protected $path = 'store_data/articles';
    public function setData($data){
        $this -> data = $data;
    }
    
}
