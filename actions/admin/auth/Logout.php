<?php
session_start();

use database\model\UserTable;
use helpers\FLUSH;
use helpers\HTTP;

try {
    require_once '../../../vendor/autoload.php';
    unset($_SESSION['admin']);
    HTTP::redirect("/admin/login.php");
} catch (PDOException $e) {
    return $e->getMessage();
}
