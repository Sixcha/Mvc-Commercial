<?php

namespace Models;

class AddToCart extends Database{
    
    public function addToCart(){
        
        if (!isset($_COOKIE["cart"])){
            $cookieArray =[];
            $cookieJson = json_encode($cookieArray);
            setcookie("cart",$cookieJson,time()+ 60 * 60 *24);
        }
        else{
            $cookieArray = json_decode($_COOKIE["cart"],true);
        }
        
        $quantity = $_POST["quantity"];
        $articleId = $_POST["articleId"];
        for ($i = 0; $i< $quantity; $i++){
            $cookieArray[] = $articleId;
        }
        $cookieJson = json_encode($cookieArray);
        setcookie("cart",$cookieJson,time()+ 60 * 60 *24);
    }
    
}

?>