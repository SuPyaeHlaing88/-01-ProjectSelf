<?php
namespace Libs\Database;

use PDO;
use PDOException;

class MySQL{
    private $dbhost;
    private $dbuser;
    private $dbpassword;
    private $dbname;
    private $db;

    public function __construct(
        $dbhost="localhost",
        $dbuser="root",
        $dbpassword="",
        $dbname= "project_self",
    )
    {
        $this->dbhost= $dbhost;
        $this->dbuser= $dbuser;
        $this->dbpassword= $dbpassword;
        $this->dbname= $dbname;
        $this->db= null;
    }
    public function connect(){
        try{
            $this->db= new PDO(
                "mysql:host=$this->dbhost;dbname=$this->dbname",
                $this->dbuser,
                $this->dbpassword,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                ]
                );

            return $this->db;
            
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
}