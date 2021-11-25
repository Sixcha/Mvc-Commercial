<?php

namespace Controllers;

class DisconnectController {
    
    public function display() {
        
        session_start();
    
        $model = new \Models\Disconnect();
        
        $articles = $model->disconnect();
        
        $template = "disconnect.phtml";
        include_once 'views/layout.phtml';
    }
}
