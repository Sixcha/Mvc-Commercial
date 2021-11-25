<?php

namespace Controllers;

class AddArticlesController {
    
    public function display() {
        
        session_start();
    
        $model = new \Models\AddArticles();
        
        $articles = $model->addArticles();
        
        $template = "addArticles.phtml";
        include_once 'views/layoutAdmin.phtml';
        
        if (isset($_SESSION["errors"])){
            $_SESSION["errors"]=[];
            }
    }
}
