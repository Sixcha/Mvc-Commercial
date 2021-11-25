<?php

namespace Controllers;

class ChangePasswordController {
    
    public function display() {
        
        session_start();
    
        $model = new \Models\ChangePassword();
        
        $results = $model->changePassword();
        
        $template = "changePassword.phtml";
        include_once 'views/layout.phtml';
        
        if (isset($_SESSION["errors"])){
            $_SESSION["errors"]=[];
            }
    }
}
