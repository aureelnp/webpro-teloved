<?php

include '../../auth/adminMiddleware.php';
include '../../config/connect.php';

$id = $_GET['id'];

if($id == $_SESSION['user_id']){
    die("Cannot delete your own account");
}

mysqli_query(
    $conn,
    "DELETE FROM users WHERE id='$id'"
);

header("Location: ../../admin/users.php");