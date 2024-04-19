<?php
session_start();
use database\model\PostTable;
use database\model\PostTagTable;
use database\model\TagTable;
use helpers\AUTH;
use helpers\FLUSH;
use helpers\HTTP;
use helpers\StrSlug;

include("../../../vendor/autoload.php");
if(AUTH::valid('user')){
    $userId = $_SESSION['user']->id;
}

function insertData($data){
    $table = new PostTable();
    $postId = $table->create($data);
        //insert tags and post_tags to database;
        $tagArrays = explode(',', $_POST['tags']);
        foreach ($tagArrays as $value) {
            
            $postTagTable = new PostTagTable();
            $tagTable = new TagTable();
            $tagExitId = $tagTable->findByName($value);
            if(!$tagExitId > 0){
                $tagId = $tagTable->create(["name"=>$value]);
                $data = [
                    "post_id"=>$postId,
                    "tag_id"=>$tagId
                ];
            }else{
                $data = [
                    "post_id"=>$postId,
                    "tag_id"=>$tagExitId
                ];
            }
            
            $postTagTable->create($data);
        }
    HTTP::redirect('/index.php');     
}
function validation($message){
    FLUSH::message('error',$message);
    HTTP::redirect('/create-post.php');
}
if($_POST['title'] == ''){
    validation('Title is required');
}
if($_POST['description'] == ''){
    validation('Description is required');
}
if($_POST['tags'] == ''){
   validation('Tags is required');
}
$data = [
    "title"=>$_POST['title'],
    "slug"=>StrSlug::convert($_POST['title']),
    "description"=>$_POST['description'],
    //+ to change number
    "category_id"=>+$_POST['category_id'],
    "user_id"=>$userId,
    "image_path"=>Null,
    "delete_status"=>1
];  
  
 if (boolval( $_FILES['file']['error'] === 0 )) {
        // File details
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_size =$_FILES['file']['size'];
        // Generate a unique filename using the current date and time
        $timestamp = date("Ymd_His");
        $new_file_name = $timestamp . "_" . basename($file_name);
        
        // Move the file to the destination directory with the new filename
        $upload_dir = '../../../asset/uploads/';
        $target_file = $upload_dir . $new_file_name;
            // Check file size (optional)
            if ($file_size > 500000) { // 500 KB
                FLUSH::message('error,your image file is too large');
                HTTP::redirect('/create-post.php');
            } else {
                // Move the file from the temporary location to the specified destination
                if (move_uploaded_file($file_tmp, $target_file)) {
                   $image_path = "http://127.0.0.1/blog/asset/uploads/".$new_file_name;
                   $data["image_path"] = $image_path;
                   insertData($data);
                } else {
                FLUSH::message('error','Error in upload file');
                HTTP::redirect('/create-post.php');
                }
            }   
 }else{
    insertData($data);
 }
        
