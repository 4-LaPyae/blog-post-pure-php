<?php

use database\model\CategoryTable;
use helpers\FLUSH;
use helpers\HTTP;
use helpers\StrSlug;

try {
    require_once '../../../vendor/autoload.php';
    if(empty($_POST['title'])){
        FLUSH::message('error', 'Name  is required.');
        HTTP::redirect("/admin/category/edit-category.php");
    }else{
        $data = [
            'id' => $_POST['id'],
            'title' =>$_POST['title'],
            'slug' => StrSlug::convert($_POST['title']),
        ];
        $categoryTable = new CategoryTable();
        if($categoryTable){
            if($categoryTable->findByName($_POST['title']) > 0){
                FLUSH::message('error', 'Name  is already exits.');
                HTTP::redirect("/admin/category/edit-category.php"); 
            }
            if( $categoryTable->update($data) > 0){
                FLUSH::message('success','Category updated successfully.');
                HTTP::redirect("/admin/category/category.php");
            }
        }
       
       
    }
   
   

} catch (PDOException $e) {
    return $e->getMessage();
}
