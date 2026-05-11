<?php

include '../config/connect.php';

$id = $_GET['id'];

$query = mysqli_query($conn,
    "SELECT * FROM products WHERE id='$id'"
);

$product = mysqli_fetch_assoc($query);

?>

<h1>
    <?php echo $product['product_name']; ?>
</h1>

<p>
    <?php echo $product['description']; ?>
</p>

<h3>
    Rp <?php echo $product['price']; ?>
</h3>