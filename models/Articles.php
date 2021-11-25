<?php

namespace Models;

class Articles extends Database{
    
    public function getArticles(){
        $sql = "SELECT * FROM articles ORDER BY art_date DESC LIMIT 100";
        return $this-> getAll($sql);
    }
    
}

?>