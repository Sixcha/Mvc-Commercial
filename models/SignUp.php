<?php

namespace Models;

class SignUp extends Database{
    
    public function signUp(){

if (isset($_SESSION["errors"])){
    $_SESSION["errors"]=[];
    }

$errors = [];
$valids = [];

 if(array_key_exists('email', $_POST)){
     
            try{
                
                        $addUser = [
                        'addNom'                => trim(strtoupper($_POST['lastName'])),
                        'addPrenom'             => trim(ucfirst($_POST['firstName'])),
                        'addEmail'              => trim(strtolower($_POST['email'])),
                        'addPassword'           => trim($_POST['password']),
                        'addPassword_confirme'  => trim($_POST['passwordCheck']),
                        'addPicture'            => 'silhouette.png'
                    ];
                   
       
        if($addUser['addNom'] == '')
            $errors[] = "Veuillez remplir le champ 'Nom' !"; 
        
        if($addUser['addPrenom'] == '')
            $errors[] = "Veuillez remplir le champ 'Prénom' !"; 
        
        if(!filter_var($addUser['addEmail'], FILTER_VALIDATE_EMAIL))
            $errors[] =  'Veuillez renseigner un email valide SVP !';
       
        if(empty($addUser['addPassword']))
            $errors[] = "Veuillez renseigner votre mot de passe !";
       
        if($addUser['addPassword'] != $addUser['addPassword_confirme'] )
            $errors[] = "Vous n'avez pas confirmé correctement votre mot de passe !";
             
            
        if(count($errors) == 0){
            
            
            $sth = $this->dbh->prepare('SELECT * FROM usersblog WHERE user_mail = :email');
            $sth->bindValue('email', $addUser['addEmail'], \PDO::PARAM_STR);
            $sth->execute();
            $resultUser_mail = $sth->fetch(\PDO::FETCH_ASSOC);
            
            if(!empty($resultUser_mail)){
                $errors[] = 'Cette adresse e-mail existe déjà !'; }
            
            if(count($errors) == 0){
            
                $dateEdition = $this->dateNow();
                
                if(isset($_FILES['userAvatar']) && $_FILES['userAvatar']['name'] != '')
                    $addUser['addPicture'] = uploadFile($_FILES['userAvatar'], $errors, UPLOADS_DIR);
                                        
                $sth = $this->dbh->prepare('INSERT INTO 
                                                    usersblog    
                                                        (  
                                                            user_lastname, 
                                                            user_firstname, 
                                                            user_mail, 
                                                            user_avatar, 
                                                            user_password, 
                                                            user_role, 
                                                            user_valid, 
                                                            user_create_time
                                                        )
                                                    VALUES  
                                                        (  
                                                            :lastname, 
                                                            :firstname, 
                                                            :email, 
                                                            :avatar, 
                                                            :password, 
                                                            "USER", 
                                                            1, 
                                                            :create_time
                                                        )
                                    ');
                                        
                                        
                    $sth->bindValue('lastname', $addUser['addNom'], \PDO::PARAM_STR);
                    $sth->bindValue('firstname', $addUser['addPrenom'], \PDO::PARAM_STR);
                    $sth->bindValue('email', $addUser['addEmail'], \PDO::PARAM_STR);
                    $sth->bindValue('avatar', $addUser['addPicture'], \PDO::PARAM_STR);
                
                    $password = password_hash($addUser['addPassword'], PASSWORD_DEFAULT);
                    $sth->bindValue('password', $password, \PDO::PARAM_STR);
                
                    $sth->bindValue('create_time', $dateEdition, \PDO::PARAM_STR);
                    
                    $sth->execute();
                
                    $valids[] = 'Votre demande de création de compte a bien été enregistrée.';
                    $valids[] = 'Un E-mail vient de vous être envoyé avec vos identifiants.';
                    $valids[] = 'Votre mot de passe est : '.$addUser['addPassword'];
                    
                
            }
        }
   $_SESSION["errorArray"]=$errors;
}
catch(PDOException $e) {
    $errors[] = 'Une erreur de connexion a eu lieu :' . $e->getMessage();
}
            
        }



    }
}

?>