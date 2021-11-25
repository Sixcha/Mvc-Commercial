<?php

spl_autoload_register(function($class) { // $class = Controllers/HomeController
    require_once lcfirst(str_replace('\\','/', $class)) . '.php'; // require_once ('controllers/HomeController.php')
});

if(array_key_exists('route', $_GET)):
    switch($_GET['route']) {
        
        case 'home':
            $controller = new Controllers\HomeController();
            $controller->display(); 
        break;
        
        case 'signUp':
            $controller = new Controllers\SignUpController();
            $controller->display(); 
        break;
        
        case 'connect':
            $controller = new Controllers\ConnectController();
            $controller->display(); 
        break;
        
        case 'disconnect':
            $controller = new Controllers\DisconnectController();
            $controller->display(); 
        break;
        
        case 'users':
            $controller = new Controllers\UsersController();
            $controller->display(); 
        break;
        
        case 'addArticles':
            $controller = new Controllers\AddArticlesController();
            $controller->display(); 
        break;
        
        case 'admin':
            $controller = new Controllers\AdminController();
            $controller->display(); 
        break;
        
        case 'changePassword':
            $controller = new Controllers\ChangePasswordController();
            $controller->display(); 
        break;
        
        case 'deleteArticles':
            $controller = new Controllers\DeleteArticlesController();
            $controller->display(); 
        break;
        
        case 'cart':
            $controller = new Controllers\CartController();
            $controller->display(); 
        break;
        
        default:
            header('Location: index.php?route=home');
            exit;
    }
else:
    header('Location: index.php?route=home');
    exit;
endif;