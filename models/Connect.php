<?php

namespace Models;

class Connect extends Database{
    
    public function connect(){

if (isset($_SESSION["errors"])){
    $_SESSION["errors"]=[];
    }

$errors = [];
$valids = [];

try{
   
   if(array_key_exists('email', $_POST)) {
       
       
       $emailCheck = trim(strtolower($_POST['email']));
       $passwordCheck = trim($_POST['password']);
       
       if(!filter_var($emailCheck, FILTER_VALIDATE_EMAIL))
            $errors[] =  'Veuillez renseigner un email valide SVP !';
       
       if(empty($passwordCheck))
            $errors[] = "Veuillez renseigner votre mot de passe !";
            
        if(count($errors) == 0){
            
            
            $sth = $this->dbh->prepare('SELECT * FROM usersblog WHERE user_mail = :email');
            $sth->bindValue('email', $emailCheck, \PDO::PARAM_STR);
            $sth->execute();
            $resultUser_mail = $sth->fetch(\PDO::FETCH_ASSOC);
            
            if(empty($resultUser_mail))
                $errors[] = 'Email incorrecte !'; 
                
            if($resultUser_mail["user_valid"]==0)
                $errors[] = 'Not Yet Authorized'; 
                
            if($resultUser_mail["user_valid"]==2)
                $errors[] = 'Account Disabled';
                
            if(count($errors) == 0){
                $hash = $resultUser_mail["user_password"];
                if(password_verify($passwordCheck,$hash)){
                    echo ("Login Success!");
                    $_SESSION["admin"]= $resultUser_mail["user_role"];
                    $_SESSION["user"]= $resultUser_mail["user_firstname"]." ".$resultUser_mail["user_lastname"];
                    $_SESSION["avatar"]= $resultUser_mail["user_avatar"];
                    $_SESSION["id"]= $resultUser_mail["user_id"];
                    header("Location: https://paulboraakcan.sites.3wa.io/dev/PHP/mod-3/PHP3.2/Projet/index.php");
                }
                else {
                    echo "Password Incorrect!";
                }
            }
        }
       
   }
    $_SESSION["errorArray"]=$errors;
}
catch(PDOException $e) {
    $errors[] = 'Une erreur de connexion a eu lieu :' . $e->getMessage();
}


}
    

}

?>