<?php

namespace database\model;

use database\MySQL;
use PDOException;
use PDO;

class CommentTable extends MySQL
{

    private $db = null;
    public function __construct()
    {
        $this->db = $this->connect();
    }


    public function index($post_id)
    {
        try {
            $statement = $this->db->prepare("
                SELECT c.*, u.name as commentBy
                FROM comments c 
                LEFT JOIN users u ON c.user_id = u.id 
                WHERE post_id = :post_id ORDER BY `created_at` DESC
            ");
    
            $statement->bindValue(':post_id', $post_id, PDO::PARAM_INT);
            $statement->execute();
    
            $row = $statement->fetchAll();
            return $row ?? false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    

    public function create($data)

    {
        try {
            $query = "
                INSERT INTO comments (
                    text, post_id, user_id
                ) VALUES (
                    :text, :post_id, :user_id
                )
            ";
        
            $statement = $this->db->prepare($query);
            $statement->execute($data); // Assuming $data is an associative array
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            var_dump($e->getMessage());exit;
        }
        
    }

    public function update($data)
    {
        try {
            $data = [
                ':id' => $data['id'],
                ':title' => $data['title'],
                ':slug' => $data['slug'],
            ];

            $sql = "UPDATE categories SET title=:title, slug=:slug WHERE id =:id";
            $statement = $this->db->prepare($sql);

            // Execute the prepared statement with the provided data
            $statement->execute($data);

            $affectedRows = $statement->rowCount();
            return $affectedRows;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function findById($id)
    {
        try {
            $sql = "SELECT p.*, u.name as postBy FROM posts p LEFT JOIN users u ON p.user_id = u.id WHERE p.id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? $row : false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    
}
