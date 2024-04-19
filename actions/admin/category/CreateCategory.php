<?php

use database\model\CategoryTable;
use helpers\FLUSH;
use helpers\HTTP;
use helpers\StrSlug;
session_start();
try {
    require_once '../../../vendor/autoload.php';
    if(empty($_POST['title'])){
        FLUSH::message('error', 'Name  is required.');
        HTTP::redirect("/admin/category/create-category.php");
    }else{
        $data = [
            "title" => $_POST['title'] ?? 'Unknown',
            "slug" =>StrSlug::convert($_POST['title']) ?? 'unknown'
        ];
        $table = new CategoryTable();
        if($table){
            if($table->findByName($_POST['title']) > 0){
                FLUSH::message('error', 'Name  is already exits.');
                HTTP::redirect("/admin/category/create-category.php"); 
            }
            $table->create($data);
            HTTP::redirect("/admin/category/category.php");
                
        }
       
    }
       

} catch (PDOException $e) {
    return $e->getMessage();
}
