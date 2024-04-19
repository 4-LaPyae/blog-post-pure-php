<?php
use database\model\UserTable;
use helpers\AppError;
use helpers\FLUSH;
use helpers\HTTP;

try {
    require_once '../../../vendor/autoload.php';
    $userTable = new UserTable();
    $data = [
        'id' => $_POST['id'],
        'role_id' =>$_POST['role_id'] == 'admin' ? 1 : 2,
        'status' => $_POST['status'] == 'active'  ? 1 : 0,
    ];
    if( $userTable->update($data) > 0){
        FLUSH::message('success','User updated successfully.');
        HTTP::redirect("/admin/user/user.php");
    }else{
        echo "error";
    }
   
   

} catch (PDOException $e) {
    return $e->getMessage();
}
