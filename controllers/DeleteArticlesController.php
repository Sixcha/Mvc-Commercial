<?php

namespace Controllers;

class DeleteArticlesController {
    
    public function display() {
        
        session_start();
    
        $model = new \Models\DeleteArticles();
        
        $results = $model->deleteArticles();
        
        $template = "deleteArticles.phtml";
        include_once 'views/layoutAdmin.phtml';
        
        if (isset($_SESSION["errors"])){
            $_SESSION["errors"]=[];
            }
    }
}
