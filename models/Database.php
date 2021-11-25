<?php

namespace Models;

const DB_HOST = '';
const DB_NAME = '';

const DB_USER = '';
const DB_PASS = '';

const DB_DSN = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';


define('BASE_DIR', realpath(dirname(__FILE__) . "/../"));

const UPLOADS_DIR = BASE_DIR.'/uploads/';

const FILE_EXT_IMG = ['jpg','jpeg','gif','png'];


class Database{
    
    protected $dbh;
    
    public $errors = [];
    public $valids = [];
    
    public function __construct() {
        $this->dbh = new \PDO(DB_DSN, DB_USER, DB_PASS);
        $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    
    public function getAll(string $sql){
        $query = $this->dbh->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    
    public function uploadFile(array $file, array &$errors, string $folder = UPLOADS_DIR, array $fileExtensions = FILE_EXT_IMG){
        $filename = '';
    
        if ($file["error"] === UPLOAD_ERR_OK) {
            $tmpName = $file["tmp_name"];
    
            $tmpNameArray = explode(".", $file["name"]);
            $tmpExt = end($tmpNameArray);
            if(in_array($tmpExt, $fileExtensions))
            {
                $filename = uniqid().'-'.basename($file["name"]);
                if(!move_uploaded_file($tmpName, $folder.$filename))
                {
                    $errors[] = 'Le fichier n\'a pas été enregistré correctement';
                }
            }
            else
                $errors[] = 'Ce type de fichier n\'est pas autorisé !';
        }
        else if($file["error"] == UPLOAD_ERR_INI_SIZE || $file["error"] == UPLOAD_ERR_FORM_SIZE) {
            $errors[] = 'Le fichier est trop volumineux';
        }
        else {
            $errors[] = 'Une erreur a eu lieu au moment de l\'upload';
        }
    
        return $filename;
    }
    
    public function dateNow(){
        date_default_timezone_set("Europe/Paris");
        return date("Y-m-d H:i:s");
    }
}

?>