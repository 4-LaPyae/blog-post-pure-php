<?php
session_start();
use database\model\CommentTable;
use helpers\AUTH;
use helpers\FLUSH;
use helpers\HTTP;

include("../../../vendor/autoload.php");
if(AUTH::valid('user')){
    $userId = $_SESSION['user']->id;
}

if($_POST['text'] == ''){
    FLUSH::message('error', 'Comment field is required.');
    HTTP::redirect('/post-detail.php?id='.$_POST['post_id']);
}

$data = [
    'text' => $_POST['text'],
    'post_id' => $_POST['post_id'],
    'user_id' => $userId
]; 

$commentTable = new CommentTable();

if($commentTable->create($data)){
    FLUSH::message('success', 'Comment created successfully.');
    HTTP::redirect('/post-detail.php?id='.$_POST['post_id']);
}

    
  

        
