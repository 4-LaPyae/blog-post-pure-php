<?php

namespace database\model;

use database\MySQL;
use PDO;
use PDOException;

class PostTagTable extends MySQL
{

    private $db = null;
    public function __construct()
    {
        $this->db = $this->connect();
    }

    public function create($data)

    {

        try {
            $query = "
                INSERT INTO post_tags (
                    post_id, tag_id
                ) VALUES (
                    :post_id, :tag_id
                )
            ";
        
            $statement = $this->db->prepare($query);
            $statement->execute($data); // Assuming $data is an associative array
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        
    }
    public function destory($id){
        try {
        
            $sql = "DELETE FROM post_tags WHERE post_id = :post_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':post_id', $id, PDO::PARAM_INT);
            $stmt->execute();        
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
    }

}
