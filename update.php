<?php
include 'parts/header.php';
require 'PHP_Actions/users.php';

if (!isset($_GET['id'])) {
    include "parts/not_found.php";
    exit;
}
$userId = $_GET['id'];

$user = get_user_by_id($userId);
if (!$user) {
    include "parts/not_found.php";
    exit;
}

$errors = [
    'name' => "",
    'username' => "",
    'email' => "",
    'phone' => "",
    'website' => "",
];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = array_merge($user, $_POST);

    $isValid = validate_user($user, $errors);

    if ($isValid) {
        $user = update_user($_POST, $userId);
        uploadImage($_FILES['picture'], $user);
        header("Location: index.php");
    }
}

?>

<?php include '_form.php' ?>
