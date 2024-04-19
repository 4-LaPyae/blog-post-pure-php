<?php

namespace database\model;

use database\MySQL;
use PDO;
use PDOException;

class UserTable extends MySQL
{

    private $db = null;
    public function __construct()
    {
        $this->db = $this->connect();
    }
    public function findUserByEmail(string $email)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $row = $stmt->fetch();
            return $row;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function index()

    {
        try {
            $statement = $this->db->query("
            SELECT users.*, roles.name AS role
            FROM users LEFT JOIN roles
            ON users.role_id = roles.id
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
                INSERT INTO users (
                    name, email, password, role_id,
                    status, created_at
                ) VALUES (
                    :name, :email, :password, :role_id,
                    :status, NOW()
                )
            ";
        
            $statement = $this->db->prepare($query);
            $statement->execute($data);
        
            // Get the last insert ID
            $lastInsertId = $this->db->lastInsertId();
        
            // Fetch the inserted data using the last insert ID
            $selectQuery = "SELECT * FROM users WHERE id = :id";
            $selectStatement = $this->db->prepare($selectQuery);
            $selectStatement->bindParam(':id', $lastInsertId, PDO::PARAM_INT);
            $selectStatement->execute();
        
            // Fetch the data
            $insertedData = $selectStatement->fetch();
        
            return $insertedData;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        
    }
    public function findByEmail($email)
    {
        try {
            $query = $this->db->prepare("SELECT `email` FROM `users` WHERE `email` = ?");
            $query->bindValue(1, $email);
            $query->execute();
            return $query->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage()();
        }
    }
    public function findById($id)
    {
        try {
            $statement = $this->db->query("
            SELECT * FROM users
            WHERE id = $id
            ");
            $row = $statement->fetchAll();
            return $row ?? false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function update($data)
    {
        try {
            $data = [
                ':id' => $data['id'],
                ':role' => $data['role_id'],
                ':status' => $data['status'],
            ];

            $sql = "UPDATE users SET role_id=:role, status=:status WHERE id =:id";
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
        $query = "SELECT COUNT(*) as total_rows FROM users";

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
