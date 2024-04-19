<?php
session_start();
use database\model\UserTable;
use helpers\AppError;
use helpers\FLUSH;
use helpers\HTTP;

try {
    require_once '../../../vendor/autoload.php';
    $errors = array("name" => "", "email" => "", "password" => "");
    if (empty($_POST['name'])) {
        $errors['name'] = "Name is requered!";
    } else {
        $name = $_POST['name'];
    }
    if (empty($_POST['email'])) {
        $errors['email'] = "Email is requered!";
    } else {
        $email = $_POST['email'];
    }
    if (empty($_POST['password'])) {
        $errors['password'] = "Password is requered!";
    } else {
        $password = $_POST['password'];
    }
    if (!array_filter($errors)) {
        $data = [
            "name" => $name ?? 'Unknown',
            "email" => $email ?? 'Unknown',
            "password" => md5($password),
            "role_id" => 2,
            "status" => 1,
        ];

        $table = new UserTable();

        if ($table) {
            //check email
            if ($table->findByEmail($email) > 0) {
                FLUSH::message('error', 'Email  is already exits.');
                HTTP::redirect("../../../register.php");
            }
            $user =  $table->create($data);
            $_SESSION['user'] = $user;
            HTTP::redirect("../../../../blog/index.php");
        }
    } 
} catch (PDOException $e) {
    return $e->getMessage();
}
