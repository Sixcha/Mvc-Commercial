<?php

namespace Controllers;

class HomeController {
    
    public function display(){
        
        session_start();
        
        $model = new \Models\Articles();
        
        $results = $model->getArticles();
        
        if(isset($_POST["quantity"]) && !empty($_POST["quantity"])){
            
            $cartModel = new \Models\AddToCart();
            
            $cartResults = $cartModel->addToCart();
            
        }
        
        $template = "mainPage.phtml";
        include_once 'views/layout.phtml';
    }
    
}

?>