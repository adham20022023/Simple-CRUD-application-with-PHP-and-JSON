<?php
include "parts/header.php";
require __DIR__.'/PHP_Actions/users.php';
$user=[
    'id'=>'',
    'name'=>'',
    'username'=>'',
    'email'=>'',
    'phone'=>'',
    'website'=>'',
];
$errors=[
    'name'=>'',
    'username'=>'',
    'email'=>'',
    'phone'=>'',
    'website'=>'',
];
$isvalid=true;
if($_SERVER['REQUEST_METHOD'] ==='POST'){
    $user=array_merge($user,$_POST);
    $isvalid=validate_user($user,$errors);
    if($isvalid){
        $user=create_user($_POST);
        /**
         * Files => filename,tmp_name,size,error
         */
        uploadimage($_FILES['picture'],$user);
        header('location: index.php');
    }

}
?>
<?php include '_form.php' ?>


