<?php

namespace Models;

class Users extends Database{
    
    public function getUsers(){
        if (isset($_SESSION["user"]) && $_SESSION["user"]!==""){
            $sql="SELECT * FROM `usersblog` ORDER BY user_id ASC LIMIT 100";
            return $this->getAll($sql);
        }
        else{
            $_SESSION["login"]=0;
            header("Location: https://paulboraakcan.sites.3wa.io/dev/PHP/mod-3/PHP3.2/Projet/index.php");
        }
    }
    
}

?>