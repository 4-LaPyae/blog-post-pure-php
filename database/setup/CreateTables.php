<?php
require_once './vendor/autoload.php';
use helpers\AppError;
AppError::Msg();
use database\MySQL;
echo "no no";
$sql = new MySQL();
echo "hee hee";

echo "hi";
return;
/******
 * User Table
 ***/
$querys =array(
"create table users(
    id int(11) primary key auto_increment,
    name varchar(100) not null,
    email varchar(255) not null,
    password varchar(255) not null,
    action int(11) not null default 0,
    created_at datetime not null,
    updated_at datetime not null)",
"create table user_role(
    id int(11) primary key auto_increment,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (role_id) REFERENCES roles(id),)",
"create table roles(
    id int(11) primary key auto_increment,
    name varchar(100) not null,
    created_at datetime not null,
    updated_at datetime not null
)"
);
foreach ($querys as $query) {
    if ($sql->connect()->query($query) === TRUE) {
        echo "Query executed successfully: $query<br>";
    } else {
        echo "Error executing query: $query. Error: "."<br>";
    }
}
