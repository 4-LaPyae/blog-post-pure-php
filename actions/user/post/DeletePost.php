<?php

use database\model\PostTable;
use database\model\PostTagTable;
use helpers\HTTP;

include("../../../vendor/autoload.php");

$postId = $_POST['post_id'] ?? NULL;
$postTable = new PostTable();
//delete pos-tags pivot table
$postTagTable = new PostTagTable();
$postTable->destory($postId);

$postTable->destory($postId) ;
HTTP::redirect("/mypost.php");


