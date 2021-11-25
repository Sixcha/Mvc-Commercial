<?php

namespace Models;

class ChangePassword extends Database{
    
    public function changePassword(){
        
        $this->errors=[];
        $this->valids=[];
        
        
        if (array_key_exists("oldPass",$_POST)){
                
            $passwordOld= trim($_POST["oldPass"]);
            $passwordNew= trim($_POST["newPass"]);
            $passwordNewCheck= trim($_POST["newPassCheck"]);
            
            if (empty($passwordOld)){
                $this->errors[]= 'Veuillez renseigner votre ancien mot de passe !';
                var_dump($this->errors);
            }
            if (empty($passwordNew)){
                $this->errors[]= 'Veuillez renseigner votre nouveau mot de passe !';
                var_dump($this->errors);
            }
            
            if ($passwordNew !== $passwordNewCheck){
                $this->errors[]= "Les 2 mots de passe ne sont pas les mêmes !";
                var_dump($this->errors);
            }
            
            if (count($this->errors)==0){
                $sth = $this->dbh->prepare("SELECT * FROM usersblog WHERE user_id = :id");
                $sth-> bindValue("id",$_SESSION["id"]);
                $sth-> execute();
                $resultUser = $sth->fetch(\PDO::FETCH_ASSOC);
                var_dump($resultUser);
                
                if(password_verify($passwordOld,$resultUser["user_password"])){
                    $hash = password_hash($passwordNew, PASSWORD_DEFAULT);
                    $sth = $this->dbh->prepare("UPDATE usersblog SET user_password = :password WHERE user_id = :id");
                    $sth-> bindValue("id",$_SESSION["id"]);
                    $sth-> bindValue("password",$hash,\PDO::PARAM_STR);
                    $sth-> execute();
                }
                else{
                    $this->errors[]= "Votre mot de passe est incorrect ! ";
                    var_dump($this->errors);
                }
            }
                
        }

    }
}

?>