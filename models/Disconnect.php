<?php

namespace Models;

class Disconnect extends Database{
    
    public function disconnect(){
        if (isset($_SESSION["user"])){
            unset($_SESSION["user"]);
            unset($_SESSION["admin"]);
            header("Location: https://paulboraakcan.sites.3wa.io/dev/PHP/mod-3/PHP3.2/Projet/index.php");
        }
        else{
            header("Location: https://paulboraakcan.sites.3wa.io/dev/PHP/mod-3/PHP3.2/Projet/index.php");
        }
    }
    
}

?>