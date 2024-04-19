<?php

namespace database\model;

use database\MySQL;
use PDOException;
use PDO;

class PostTable extends MySQL
{

    private $db = null;
    public function __construct()
    {
        $this->db = $this->connect();
    }


    public function index()
    {
        try {
            $statement = $this->db->query("
                SELECT posts.*, users.name AS user, categories.title AS category, GROUP_CONCAT(tags.name) AS tags
                FROM posts
                LEFT JOIN users ON posts.user_id = users.id
                LEFT JOIN categories ON posts.category_id = categories.id
                LEFT JOIN post_tags ON posts.id = post_tags.post_id
                LEFT JOIN tags ON post_tags.tag_id = tags.id
                WHERE posts.delete_status = 1
                GROUP BY posts.id
                ORDER BY posts.created_at DESC
            ");
            
            $rows = $statement->fetchAll();
            return $rows ?? false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        
        
    
    }
    public function indexAdmin()
    {
        try {
            $statement = $this->db->query("
                SELECT posts.*, users.name AS user, categories.title AS category, GROUP_CONCAT(tags.name) AS tags
                FROM posts
                LEFT JOIN users ON posts.user_id = users.id
                LEFT JOIN categories ON posts.category_id = categories.id
                LEFT JOIN post_tags ON posts.id = post_tags.post_id
                LEFT JOIN tags ON post_tags.tag_id = tags.id
                GROUP BY posts.id
                ORDER BY posts.created_at DESC
            ");
            
            $rows = $statement->fetchAll();
            return $rows ?? false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        
        
    
    }


    public function create($data)

    {

        try {
            $query = "
                INSERT INTO posts (
                    title, slug, description, category_id, user_id, image_path, delete_status
                ) VALUES (
                    :title, :slug, :description, :category_id, :user_id, :image_path, :delete_status
                )
            ";
            $statement = $this->db->prepare($query);
            $statement->execute($data); // Assuming $data is an associative array
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
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
            $sql = "
                SELECT p.*, u.name as postBy, c.title as category, GROUP_CONCAT(t.name) as tags
                FROM posts p
                LEFT JOIN users u ON p.user_id = u.id
                LEFT JOIN post_tags pt ON p.id = pt.post_id
                LEFT JOIN tags t ON pt.tag_id = t.id
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.id = :id
                GROUP BY p.id";
        
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? $row : false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        
        
    }
    
    
    public function findByName($name)
    {
        try {
            $query = $this->db->prepare("SELECT `title` FROM `posts` WHERE `slug` = ?");
            $query->bindValue(1, $name);
            $query->execute();
            $row = $query->fetch();
            return $row ?? false;
        } catch (PDOException $e) {
            return $e->getMessage()();
        }
    }
    public function findByUser($id){
        try {
            $sql = "
                SELECT p.*, u.name as postBy, c.title as category, GROUP_CONCAT(COALESCE(t.name, '')) as tags
                FROM posts p
                LEFT JOIN users u ON p.user_id = u.id
                LEFT JOIN post_tags pt ON p.id = pt.post_id
                LEFT JOIN tags t ON pt.tag_id = t.id
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.user_id = :user_id
                GROUP BY p.id";
        
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':user_id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows ? $rows : false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }   
    }
    public function destory($id){
        try {
            $statement = $this->db->prepare("
            DELETE FROM posts WHERE id = :id
            ");
            $statement->execute([ 'id' => $id ]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function suspend($id){
            try {
                $data = [
                    ':id' => $id,
                    ':delete_status'=>0
                ];
    
                $sql = "UPDATE posts SET delete_status=:delete_status WHERE id =:id";
                $statement = $this->db->prepare($sql);
                // Execute the prepared statement with the provided data
                $statement->execute($data);
    
                $affectedRows = $statement->rowCount();
                return $affectedRows;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
    }
    public function noSuspend($id){
        try {
            $data = [
                ':id' => $id,
                ':delete_status'=>1
            ];

            $sql = "UPDATE posts SET delete_status=:delete_status WHERE id =:id";
            $statement = $this->db->prepare($sql);
            // Execute the prepared statement with the provided data
            $statement->execute($data);

            $affectedRows = $statement->rowCount();
            return $affectedRows;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
}

public function allCountPosts($status)
{
    try {

        // SQL query to count all rows in the table
        $query = "SELECT COUNT(*) as total_rows FROM posts WHERE delete_status = $status ";

        // Prepare the statement
        $statement = $this->db->prepare($query);

        // Execute the statement
        $statement->execute();

        // Fetch the result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['total_rows'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


}
