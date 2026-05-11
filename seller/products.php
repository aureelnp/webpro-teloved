<?php

include '../auth/middleware.php';
include '../config/connect.php';

$seller_id = $_SESSION['user_id'];

$query = mysqli_query($conn,
    "SELECT * FROM products
     WHERE seller_id='$seller_id'"
);

?>

<h1>My Products</h1>

<a href="add-product.php">
    Add Product
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>
    <th>Name</th>
    <th>Price</th>
    <th>Action</th>
</tr>

<?php while($product = mysqli_fetch_assoc($query)) : ?>

<tr>

    <td>
        <?php echo $product['product_name']; ?>
    </td>

    <td>
        Rp <?php echo $product['price']; ?>
    </td>

    <td>

        <a href="../api/products/deleteProducts.php?id=<?php echo $product['id']; ?>">
            Delete
        </a>

    </td>

</tr>

<?php endwhile; ?>

</table>