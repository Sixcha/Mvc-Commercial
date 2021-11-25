<?php

        namespace Models;

        require_once("Database.php");

        $content = file_get_contents("php://input");
        
        $data = json_decode($content, true);
        
        $search = "%".$data['sendSearched']."%";
        
        $dbh = new \PDO(DB_DSN, DB_USER, DB_PASS);
        $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $sth = $dbh ->prepare( "SELECT * FROM articles WHERE art_title LIKE :search ORDER BY art_id DESC LIMIT 100");
        $sth->bindValue("search",$search,\PDO::PARAM_STR);
        $sth->execute();
        $searchResults = $sth->fetchAll(\PDO::FETCH_ASSOC);
        
        include '../views/searchArticles.phtml';

?>