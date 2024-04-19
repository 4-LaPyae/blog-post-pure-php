<?php
session_start();

use database\model\UserTable;
use helpers\FLUSH;
use helpers\HTTP;

try {
    require_once '../../../vendor/autoload.php';
    unset($_SESSION['user']);
    HTTP::redirect("/login.php");
} catch (PDOException $e) {
    return $e->getMessage();
}
