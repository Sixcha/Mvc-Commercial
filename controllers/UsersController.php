<?php

namespace Controllers;

class UsersController {
    
    public function display() {
        
        session_start();
    
        $model = new \Models\Users();
        
        $results = $model->getUsers();
        
        $template = "users.phtml";
        include_once 'views/layoutAdmin.phtml';
    }
}
