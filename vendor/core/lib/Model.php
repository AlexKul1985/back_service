<?php

namespace core\lib;


abstract class Model{
    protected $table_name = "";

    public $data = [];
    protected $field_id = "id";
    private $lastID = "";

    abstract public function setData(array $data);

    public function saveData(int $ai = 0, $data = []){
        
        if(!empty($this -> data) && empty($data)){
            $this -> lastID = $ai;
            $this -> data[$this -> field_id] = $ai ;
            $data = $this -> selectData();
            
            $data[$ai] = $this -> data;
            file_put_contents($this -> path,serialize($data));
            return;
        }

        if(!empty($data)){

        
            file_put_contents($this -> path,serialize($data));

        }
    }
    public function __get($name){
        if(array_key_exists($name,$this -> data)){
            return $this -> data[$name];
        }
    }

    public function selectData(){
        if(file_exists($this -> path) && filesize($this -> path) > 0){
            return unserialize(file_get_contents($this -> path));
        }
        return [];
    }

    public function getValueByField($field, $value){
        $data = $this -> selectData();
        foreach ($data as $key => $row) {
            if($row[$field] == $value){
                return $row;
            }
        }
    }

    public function getLastID(){
        return $this -> lastID;
    }

    public function removeData($id){

        $data = $this -> selectData();
        
            foreach ($data as $key => $value) {
                
                if($key === $id){
                    unset($data[$key]);
                    break;
                }
    
            }

            
        $this -> saveData(0,$data);

    }

    public function updateData($id, array $new_data){

        $data = $this -> selectData();
        
            foreach ($data as $key => $value) {
                
                if($key === $id){
                    $data[$key] = array_merge($data[$key],$new_data);
                    break;
                }
    
            }

            
        $this -> saveData(0,$data);

    }

    public function getNameClass(){
        return get_called_class();
    }
}