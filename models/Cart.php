<?php

namespace Models;

class Cart extends Database{
    
    public function showCart(){
        if(isset($_COOKIE["cart"]) && !empty($_COOKIE["cart"])){
            $cookieArray = json_decode($_COOKIE["cart"],true);
            $cookieQuantities = array_count_values($cookieArray);
            $cookieIds = array_keys($cookieQuantities);
            $_SESSION["cookieQuantities"]=$cookieQuantities;
            $items = "";
            for ($i=0; $i<count($cookieIds);$i++){
                if($i==count($cookieIds)-1){
                    $items .= "art_id = ".$cookieIds[$i];
                }
                else{
                    $items .= "art_id = ".$cookieIds[$i]." OR "; 
                }
            }
            if ($items != ""){
                $query = "SELECT * FROM `articles` WHERE ".$items;
                $sth = $this->dbh->prepare ($query);
                $sth->execute();
                return $sth->fetchAll(\PDO::FETCH_ASSOC);
            }
            else{
                header("Location: https://paulboraakcan.sites.3wa.io/dev/PHP/mod-3/PHP3.2/Projet/index.php?route=home");
            }
        }
        else{
            header("Location: https://paulboraakcan.sites.3wa.io/dev/PHP/mod-3/PHP3.2/Projet/index.php?route=home");
        }

    }
    
    public function removeFromCart(){
        $removeQuantity = $_POST["removeQuantity"];
        $articleId = $_POST["articleId"];
        $cookieArray = json_decode($_COOKIE["cart"],true);
        for ($i = 0; $i<$removeQuantity; $i++){
            $key = array_search($articleId, $cookieArray);
            unset($cookieArray[$key]);
        }
        $cookieJson = json_encode($cookieArray);
        setcookie("cart",$cookieJson,time()+ 60 * 60 *24);
        header("Location: https://paulboraakcan.sites.3wa.io/dev/PHP/mod-3/PHP3.2/Projet/index.php?route=cart");
    }
    
}

?>