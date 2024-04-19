<?php

use database\model\CategoryTable;
use helpers\FLUSH;
use helpers\HTTP;
use helpers\StrSlug;

try {
    require_once '../../../vendor/autoload.php';
    $table = new CategoryTable();
    $id = $_POST['id'];
   if($table){
        $table->destory($id);
        FLUSH::message('success','Category updated successfully.');
        HTTP::redirect("/admin/category/category.php");
   }

} catch (PDOException $e) {
    return $e->getMessage();
}
