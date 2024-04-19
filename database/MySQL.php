<?php
namespace database;
use PDO;
use PDOException;
class MySQL
{
    private $dbhost="localhost";
    private $dbuser="root";
    private $dbname="blog";
    private $dbpass="hello*124#";
    private $db= null;

    public function connect()
    {
        try {
            $this->db = new PDO(
                "mysql:host=$this->dbhost;dbname=$this->dbname",
                $this->dbuser,
                $this->dbpass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                ]
            );
            return $this->db;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
