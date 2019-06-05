<?php
namespace core\lib;

class Store{
   
   private static $auto_increments = [
       "users" => 1,
       "articles" => 2,
       "categories" => 3
   ];
   
   private $model = null;
   
   private $path_ai = 'store_data/auto_increments';


   public function increment($table_name){
       
        $textArr = file($this -> path_ai);
        $textArr = array_map(function($text){
            return trim($text);
        },$textArr);

        $primary = (int) $textArr[self::$auto_increments[$table_name] - 1];
        
        $textArr[self::$auto_increments[$table_name] - 1] = ++$primary;
        
        file_put_contents($this -> path_ai, implode("".PHP_EOL,$textArr));
        return $primary;
    }

    public function setModel(Model $model){
       $this -> model = $model; 
    }

    public function saveData(){
        $fullNameTable = $this -> model -> getNameClass();
        $pos = strrpos($fullNameTable , "\\");
        $nameTable = substr($fullNameTable ,$pos + 1);
        
        $this -> model -> saveData($this -> increment(strtolower($nameTable)));
    }

    

}