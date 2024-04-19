<?php
use database\model\TagTable;
include("../../../vendor/autoload.php");

header("Content-Type: application/json");

$name = $_GET['name'];

// echo json_encode($name);exit;
$TagTable = new TagTable();
$tags = $TagTable->index($name);
$response = $tags;

echo json_encode($response);