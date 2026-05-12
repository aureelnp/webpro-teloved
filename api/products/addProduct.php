<?php
session_start();
include '../../config/connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'seller') {
    echo json_encode(["message" => "Unauthorized"]);
    exit;
}

$seller_id = $_SESSION['user_id'];

$product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$price = $_POST['price'];
$category = $_POST['category'];
$product_condition = $_POST['product_condition'];

$query = "INSERT INTO products (
            seller_id, 
            product_name, 
            description, 
            price, 
            category, 
            product_condition
          ) 
          VALUES (
            '$seller_id', 
            '$product_name', 
            '$description', 
            '$price', 
            '$category', 
            '$product_condition'
          )";

$result = mysqli_query($conn, $query);

if($result){
    header("Location: ../../seller/products.php?status=success");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>