<?php
session_start();

use database\model\UserTable;
use helpers\FLUSH;
use helpers\HTTP;

try {
    require_once '../../../vendor/autoload.php';
    if (empty($_POST['email']) || empty($_POST['password'])) {
        FLUSH::message('error', 'Email and Password is required.');
        HTTP::redirect("/admin/login.php");
    } else {
        $data = [
            "email" => $_POST['email'],
            "password" => $_POST['password']
        ];
        $model = new UserTable();
        $user = $model->findUserByEmail($data['email']);
        if ($user) {
            if ($user->password == md5($data['password'])) {
                //check role
                    if($user->role_id === 1){
                        $_SESSION['admin'] = $user;
                        HTTP::redirect("/admin/dashboard.php");
                    }else{
                        FLUSH::message('error', 'User not role');
                        HTTP::redirect("/admin/login.php"); 
                    }
                //end
              
            } else {
                FLUSH::message('error', 'Incorrect password');
                HTTP::redirect("/admin/login.php");
            }
        } else {
            FLUSH::message('error', 'User not found');
            HTTP::redirect("/admin/login.php");
        }
    }
} catch (PDOException $e) {
    return $e->getMessage();
}
