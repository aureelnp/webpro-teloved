<?php

include '../auth/middleware.php';
include '../config/connect.php';

$query = mysqli_query($conn,
    "SELECT products.*, users.name as seller_name
     FROM products
     JOIN users ON users.id = products.seller_id"
);

?>

<h1>Buyer Homepage</h1>

<h3>
    Welcome,
    <?php echo $_SESSION['name']; ?>
</h3>

<hr>

<?php while($product = mysqli_fetch_assoc($query)) : ?>

<div style="border:1px solid black; padding:20px; margin-bottom:20px;">

    <h2>
        <?php echo $product['product_name']; ?>
    </h2>

    <p>
        <?php echo $product['description']; ?>
    </p>

    <h4>
        Rp <?php echo $product['price']; ?>
    </h4>

    <small>
        Seller:
        <?php echo $product['seller_name']; ?>
    </small>

</div>

<?php endwhile; ?>

<a href="../auth/logout.php">
    Logout
</a>