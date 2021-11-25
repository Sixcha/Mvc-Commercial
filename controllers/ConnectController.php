<?php

namespace Controllers;

class ConnectController {
    
    public function display() {
        
        session_start();
    
        $model = new \Models\Connect();
        
        $articles = $model->connect();
        
        $template = "connect.phtml";
        include_once 'views/layout.phtml';
        
        if (isset($_SESSION["errors"])){
            $_SESSION["errors"]=[];
            }
    }
}
