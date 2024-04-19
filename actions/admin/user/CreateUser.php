<?php
session_start();
use database\model\UserTable;
use helpers\AppError;
use helpers\FLUSH;
use helpers\HTTP;

try {
    require_once '../../../vendor/autoload.php';
    $status = "";
    $role  = "";
    $errors = array("name" => "", "email" => "", "password" => "", "role_id" => "", "status" => "");
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
    if (empty($_POST['role_id'])) {
        $errors['role_id'] = "Role is requered!";
    } else {
        $role_id = $_POST['role_id'] == 'admin' ? 1 : 2;
    }
    if (empty($_POST['status'])) {
        $errors['status'] = "Status is requered!";
    } else {
        $status = $_POST['status'] == 'active' ? 1 : 0;
    }
    if (!array_filter($errors)) {
        $data = [
            "name" => $name ?? 'Unknown',
            "email" => $email ?? 'Unknown',
            "password" => md5($password),
            "role_id" => $role_id ?? 2,
            "status" =>  $status ?? 1,
        ];
        $table = new UserTable();
        if ($table) {
            //check email
            if ($table->findByEmail($email) > 0) {
                FLUSH::message('error', 'Email  is already exits.');
                HTTP::redirect("/admin/user/create-user.php");
            }
            $table->create($data);
            HTTP::redirect("/admin/user/user.php");
        }
    } else {;
        FLUSH::message('error', 'All field are required');
        HTTP::redirect("/admin/user/create-user.php");
    }
} catch (PDOException $e) {
    return $e->getMessage();
}
