<?php

include '../../config/connect.php';

$id = $_POST['id'];
$product_name = $_POST['product_name'];
$description = $_POST['description'];
$price = $_POST['price'];

$query = "UPDATE products
          SET
          product_name='$product_name',
          description='$description',
          price='$price'
          WHERE id='$id'";

$result = mysqli_query($conn, $query);

if($result){
    echo "Updated";
} else {
    echo "Failed";
}

?>