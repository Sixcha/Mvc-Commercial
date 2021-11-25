<?php

namespace Controllers;

class SignUpController {
    
    public function display() {
        
        session_start();
    
        $model = new \Models\SignUp();
        
        $articles = $model->signUp();
        
        $template = "signUp.phtml";
        include_once 'views/layout.phtml';
        
    }
}
