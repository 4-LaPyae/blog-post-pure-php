<?php

namespace database\model;

use database\MySQL;
use PDOException;

class TagTable extends MySQL
{

    private $db = null;
    public function __construct()
    {
        $this->db = $this->connect();
    }


    public function index($name)
    {
        // return $name;exit;
        try {
            $statement = $this->db->query("
        SELECT * FROM tags WHERE name LIKE '%" . $name . "%'
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
INSERT INTO tags (
name
) VALUES (
:name
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

    public function findByName($name)
    {
        try {
            $query = $this->db->prepare("SELECT `name` FROM `tags` WHERE `name` = ?");
            $query->bindValue(1, $name);
            $query->execute();
            return $query->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage()();
        }
    }
}
