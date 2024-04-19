<?php
session_start();

use database\model\UserTable;
use helpers\FLUSH;
use helpers\HTTP;

try {
    require_once '../../../vendor/autoload.php';
    if (empty($_POST['email']) || empty($_POST['password'])) {
        FLUSH::message('error', 'Email and Password is required.');
        HTTP::redirect("/login.php");
    } else {
        $data = [
            "email" => $_POST['email'],
            "password" => $_POST['password']
        ];
        $model = new UserTable();
        $user = $model->findUserByEmail($data['email']);
        if ($user) {
            if ($user->password == md5($data['password'])) {
                $_SESSION['user'] = $user;
                HTTP::redirect("/index.php");
            } else {
                FLUSH::message('error', 'Incorrect password');
                HTTP::redirect("/login.php");
            }
        } else {
            FLUSH::message('error', 'User not found');
            HTTP::redirect("/login.php");
        }
    }
} catch (PDOException $e) {
    return $e->getMessage();
}
