<?php

include '../auth/middleware.php';

if($_SESSION['role'] != 'seller'){
    die("Access Denied");
}

?>

<h1>Seller Dashboard</h1>

<h3>
    Welcome,
    <?php echo $_SESSION['name']; ?>
</h3>

<a href="products.php">
    Manage Products
</a>

<br><br>

<a href="../auth/logout.php">
    Logout
</a>