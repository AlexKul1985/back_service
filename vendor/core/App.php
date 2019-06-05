<?php
namespace core;
use core\lib\Store;
use core\lib\models\Users;
use core\lib\models\Articles;
use core\lib\models\Categories;
use core\lib\Router;
use core\lib\Request;
use core\lib\Response;
use core\lib\Auth;

class App{
    
    public function __construct(){
          
            Router::add('/auth',function(Request $r,Response $res){
               
                header('Access-Control-Allow-Origin:*');
                header('Access-Control-Allow-Headers:*');
                header('Content-Type: application/json');
                $m = new Users();
                if(($id = $m -> isCheckPassword($r -> password, $r -> email) !== false)){
                    $token = Auth::packData([
                        'expire_at' => 10,
                        ]);
                        
                    echo json_encode(["token" => $token]);
                }
            });
            Router::add('/reg',function(Request $r,Response $res){
                header('Access-Control-Allow-Origin:*');
                header('Access-Control-Allow-Headers:*');
                header('Content-Type: application/json');
                $data = (array) json_decode(file_get_contents('php://input'));
                 $s = new Store();
                 $m = new Users();
                $m -> setData($data);
                 $s -> setModel($m);
                 $s -> saveData();
                echo json_encode( ["uid" => $m -> getLastID()] );
            });

            Router::add('/test',function(Request $r,Response $res){
                print_r($r -> getHeaders());
            });
            
           

            Router::run();
    }
}