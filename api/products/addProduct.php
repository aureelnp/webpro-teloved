<?php

session_start();

include '../../config/connect.php';

$product_name = $_POST['product_name'];
$description = $_POST['description'];
$price = $_POST['price'];

$seller_id = $_SESSION['user_id'];

$query = "INSERT INTO products(
            seller_id,
            product_name,
            description,
            price
          )
          VALUES(
            '$seller_id',
            '$product_name',
            '$description',
            '$price'
          )";

$result = mysqli_query($conn, $query);

if($result){
    echo json_encode([
        "message" => "Product Added"
    ]);
} else {
    echo json_encode([
        "message" => "Failed"
    ]);
}

?>