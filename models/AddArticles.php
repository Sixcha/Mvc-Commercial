<?php

namespace Models;

class AddArticles extends Database{
    
    public function addArticles(){
        
        if (isset($_SESSION["errors"])){
            $_SESSION["errors"]=[];
            }
        
        $errors = [];
        $valids = [];
        
        
        if (isset($_SESSION["user"]) && $_SESSION["user"]!==""){
            try{
                if(array_key_exists('title', $_POST)) {
                    $addTitle = trim(ucfirst($_POST['title']));
                    $addUnderTitle = trim(ucfirst($_POST['undertitle']));
                    $addDescription = trim($_POST['description']);
                    $addReleaseDate = $_POST['releasedate'];
                    $addPrice = trim($_POST['price']);
                    $addArticleImg = 'noimg.png';
                    
                    if($addTitle == "")
                        $errors[] = "Veuillez remplir le champ 'Titre' !";
                    
                    if($addUnderTitle == "")
                        $errors[] = "Veuillez remplir le champ 'Titre Secondaire' !";
                    
                    if($addDescription == "")
                        $errors[] = "Veuillez remplir le champ 'Description' !";
                    
                    if($addReleaseDate == "")
                        $errors[] = "Veuillez remplir le champ 'Date Prévu' !";
                        
                    if($addPrice == "")
                        $errors[] = "Veuillez remplir le champ 'Prix' !";
                        
                    if(!is_numeric($addPrice))
                        $errors[] = "Veuillez mettre un nombre dans le champ 'Prix' !";
                        
                        
                    if(count($errors) == 0){
                        
                        
                        if(isset($_FILES['articlepic']) && $_FILES['articlepic']['name'] != '')
                            $addArticleImg = $this->uploadFile($_FILES['articlepic'], $errors, UPLOADS_DIR);
                        
                        
                        $sth = $this->dbh->prepare('INSERT INTO 
                                                            articles
                                                                (
                                                                    art_title, 
                                                                    art_undertitle, 
                                                                    art_description, 
                                                                    art_price, 
                                                                    art_img, 
                                                                    art_date
                                                                ) 
                                                            VALUES 
                                                                (
                                                                    :title,
                                                                    :undertitle,
                                                                    :description,
                                                                    :price,
                                                                    :img,
                                                                    :date
                                                                )
                                                        ');
                        
                        $sth->bindValue('title', $addTitle, \PDO::PARAM_STR);
                        $sth->bindValue('undertitle', $addUnderTitle, \PDO::PARAM_STR);
                        $sth->bindValue('description', $addDescription, \PDO::PARAM_STR);
                        $sth->bindValue('price', $addPrice, \PDO::PARAM_STR);
                        $sth->bindValue('img', $addArticleImg, \PDO::PARAM_STR);
                        $sth->bindValue('date', $addReleaseDate, \PDO::PARAM_STR);
                        
                        $sth->execute();
                        
                    }
                }
                $_SESSION["errorArray"]=$errors;
            }
            catch(PDOException $e){
                
            }
        }
        else{
            $_SESSION["login"]=0;
            header("Location: https://paulboraakcan.sites.3wa.io/dev/PHP/mod-3/PHP3.2/Projet/index.php");
        }
    }
    
}

?>