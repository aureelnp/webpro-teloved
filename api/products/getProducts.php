<?php

include '../../config/connect.php';

$query = mysqli_query($conn,
    "SELECT products.*, users.name as seller_name
     FROM products
     JOIN users ON users.id = products.seller_id"
);

$data = [];

while($row = mysqli_fetch_assoc($query)){
    $data[] = $row;
}

echo json_encode($data);

?>