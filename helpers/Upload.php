<?php

namespace helpers;
session_start();
class Upload{
    public static function save($file){
    // Check if file is selected
    if ($file) {
        
        // File details
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        // Generate a unique filename using the current date and time
        $timestamp = date("Ymd_His");
        $new_file_name = $timestamp . "_" . basename($file_name);
        
        // Move the file to the destination directory with the new filename
        $upload_dir = '../../blog/asset/uploads';
        $target_file = $upload_dir . $new_file_name;
            // Check file size (optional)
            if ($file_size > 500000) { // 500 KB
                echo "Sorry, your file is too large.";
                FLUSH::message('error,your image file is too large');
                HTTP::redirect('/create-post.php');
            } else {
                // Move the file from the temporary location to the specified destination
                if (move_uploaded_file($file_tmp, $target_file)) {
                   echo $target_file;
                } else {
                FLUSH::message('error','Error in upload file');
                HTTP::redirect('/create-post.php');
                }
            }
    }
    }

}
