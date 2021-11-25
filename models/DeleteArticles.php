<?php

namespace Models;

class DeleteArticles extends Database{
    
    public function deleteArticles(){
        
        if(isset($_POST["articleDelete"]) && !empty($_POST["articleDelete"])){
            $sth=$this->dbh->prepare("SELECT art_img FROM articles WHERE art_title= :title");
            $sth->bindValue("title",$_POST["articleDelete"]);
            $sth->execute();
            $file= $sth->fetch(\PDO::FETCH_ASSOC);
            unlink("uploads/".$file["art_img"]);
            
            $sth=$this->dbh->prepare("DELETE FROM articles WHERE art_title= :title");
            $sth->bindValue("title",$_POST["articleDelete"]);
            $sth->execute();
        }
        
        $sql = "SELECT * FROM articles ORDER BY art_date DESC LIMIT 100";
        return $this-> getAll($sql);
        
    }
}

?>