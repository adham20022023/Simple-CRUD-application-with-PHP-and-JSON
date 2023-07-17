<?php
include 'parts/header.php';
require __DIR__.'/PHP_Actions/users.php';
if(!isset($_POST['id'])){
    include "parts/not_found.php";
    exit;
}
$userid=$_POST['id'];
delete_user($userid);
header("Location: index.php");






?>