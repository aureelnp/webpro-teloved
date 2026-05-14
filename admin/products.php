<?php

include '../auth/adminMiddleware.php';
include '../config/connect.php';

$query = mysqli_query(
    $conn,
    "SELECT products.*, users.name AS seller_name
     FROM products
     JOIN users
     ON users.id = products.seller_id"
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Manage Products</title>

<link rel="stylesheet" href="../assets/css/admin.css">

</head>

<body>

<?php include 'partials/sidebar.php'; ?>

<div class="main">

    <h1 class="page-title">
        Manage Products
    </h1>

    <p class="page-subtitle">
        List of all uploaded products.
    </p>

    <div class="table-container">

        <table>

            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Seller</th>
                <th>Action</th>
            </tr>

            <?php while($product = mysqli_fetch_assoc($query)) : ?>

            <tr>

                <td>
                    <?php echo $product['id']; ?>
                </td>

                <td>

                    <img
                    class="product-image"
                    src="../assets/images/products/<?php echo $product['image']; ?>"
                    >

                </td>

                <td>
                    <?php echo $product['product_name']; ?>
                </td>

                <td>
                    Rp <?php echo number_format($product['price']); ?>
                </td>

                <td>
                    <?php echo $product['seller_name']; ?>
                </td>

                <td>

                    <a
                    class="delete-btn"
                    href="../api/admin/deleteProduct.php?id=<?php echo $product['id']; ?>"
                    >
                        Delete
                    </a>

                </td>

            </tr>

            <?php endwhile; ?>

        </table>

    </div>

</div>

</body>
</html>