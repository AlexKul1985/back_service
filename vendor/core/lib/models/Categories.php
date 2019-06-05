<?php

namespace core\lib\models;
use core\lib\Model;


class Categories extends Model{
    protected $field_id = "id_category";
    protected $path = 'store_data/categories';

    public function setData($data){
        $this -> data = $data;
    }
}
