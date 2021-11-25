<?php

namespace Controllers;

class AdminController {
    
    public function display() {
        
        session_start();
    
        $model = new \Models\Articles();
        
        $results = $model->getArticles();
        
        $template = "mainPageAdmin.phtml";
        include_once 'views/layoutAdmin.phtml';
        
        if (isset($_SESSION["errors"])){
            $_SESSION["errors"]=[];
            }
    }
}
