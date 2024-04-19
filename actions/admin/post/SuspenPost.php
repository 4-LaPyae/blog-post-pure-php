<?php

use database\model\PostTable;
use helpers\HTTP;

include("../../../vendor/autoload.php");
$post_id = $_POST['post_id'];

$postTable = new PostTable();
$postTable->suspend($post_id);
HTTP::redirect("/admin/post/post.php");

?>