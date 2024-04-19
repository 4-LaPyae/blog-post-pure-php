<?php

namespace database\model;

use database\MySQL;
use PDO;
use PDOException;

class CategoryTable extends MySQL
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
        SELECT * FROM categories WHERE delete_status=1
        ");
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
INSERT INTO categories (
title, slug,created_at
) VALUES (
:title,:slug,NOW()
)
";
            $statement = $this->db->prepare($query);
            $statement->execute($data);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage()();
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
            $statement = $this->db->query("
            SELECT * FROM categories
            WHERE id = $id
            ");
            $row = $statement->fetchAll();
            return $row ?? false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function findByName($name)
    {
        try {
            $query = $this->db->prepare("SELECT `title` FROM `categories` WHERE `title` = ?");
            $query->bindValue(1, $name);
            $query->execute();
            return $query->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage()();
        }
    }
    public function destory($id)
    {
        try {
            $data = [
                ':id' => $id,
                ':delete_status' => 0
            ];

            $sql = "UPDATE categories SET delete_status=:delete_status WHERE id =:id";
            $statement = $this->db->prepare($sql);

            // Execute the prepared statement with the provided data
            $statement->execute($data);

            $affectedRows = $statement->rowCount();
            return $affectedRows;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function allCount()
    {
        try {

            // SQL query to count all rows in the table
            $query = "SELECT COUNT(*) as total_rows FROM categories WHERE delete_status = 1 ";

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
