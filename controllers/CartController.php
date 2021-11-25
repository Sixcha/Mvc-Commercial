<?php

namespace Controllers;

class CartController {
    
    public function display(){
        
        session_start();
        
        $model = new \Models\Cart();
        
        if(isset($_POST["removeQuantity"]) && !empty($_POST["removeQuantity"])){
            
            $cartRemove = $model->removeFromCart();
            
        }
        
        $articles = $model->showCart();
        
        $totalCost = 0;
        
        foreach($articles as $item){
            $totalCost += $_SESSION["cookieQuantities"][$item["art_id"]] * $item["art_price"];
        }
        
        $_SESSION["totalCost"] = $totalCost;
        
        $template = "cart.phtml";
        include_once 'views/layout.phtml';
    }
    
}

?>