<?php
include '../auth/middleware.php';
include '../config/connect.php';

if ($_SESSION['role'] != 'seller') {
    die("Access Denied");
}

$id = $_GET['id'];
$seller_id = $_SESSION['user_id'];

$query = mysqli_query($conn, "SELECT * FROM products WHERE id='$id' AND seller_id='$seller_id'");
$product = mysqli_fetch_assoc($query);

if (!$product) {
    die("Product not found or unauthorized.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product | Teloved</title>
    <link rel="stylesheet" href="../assets/css/seller-dashboard.css">
    <link rel="stylesheet" href="../assets/css/seller-editproduct.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<nav class="navbar">
    <div class="container nav-wrapper">
        <div class="logo">TELOVED</div>
        <div class="nav-links">
            <a href="dashboard.php">Dashboard</a>
            <a href="products.php" class="active">Manage Products</a>
            <a href="../auth/logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
</nav>

<main class="container">
    <!-- CRITICAL: Tambahkan enctype="multipart/form-data" -->
    <form action="../api/products/updateProducts.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

        <div class="edit-product-container">
            <section class="form-main-card">
                <h1>Edit Product</h1>
                
                <div class="form-group">
                    <label>PRODUCT TITLE</label>
                    <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>" required>
                </div>

                <div style="display: flex; gap: 20px;">
                    <div class="form-group" style="flex: 1;">
                        <label>CATEGORY</label>
                        <select name="category" required>
                            <option value="Tas" <?php if($product['category'] == 'Tas') echo 'selected'; ?>>Tas</option>
                            <option value="Sepatu" <?php if($product['category'] == 'Sepatu') echo 'selected'; ?>>Sepatu</option>
                            <option value="Atasan" <?php if($product['category'] == 'Atasan') echo 'selected'; ?>>Atasan</option>
                            <option value="Bawahan" <?php if($product['category'] == 'Bawahan') echo 'selected'; ?>>Bawahan</option>
                            <option value="Aksesoris" <?php if($product['category'] == 'Aksesoris') echo 'selected'; ?>>Aksesoris</option>
                            <option value="Buku" <?php if($product['category'] == 'Buku') echo 'selected'; ?>>Buku</option>
                        </select>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label>PRICE (Rp)</label>
                        <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>CONDITION</label>
                    <div style="display: flex; gap: 15px; margin-top: 10px;">
                        <label><input type="radio" name="product_condition" value="New" <?php if($product['product_condition'] == 'New') echo 'checked'; ?>> New</label>
                        <label><input type="radio" name="product_condition" value="Like New" <?php if($product['product_condition'] == 'Like New') echo 'checked'; ?>> Like New</label>
                        <label><input type="radio" name="product_condition" value="Good" <?php if($product['product_condition'] == 'Good') echo 'checked'; ?>> Good</label>
                        <label><input type="radio" name="product_condition" value="Fair" <?php if($product['product_condition'] == 'Fair') echo 'checked'; ?>> Fair</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>DESCRIPTION</label>
                    <textarea name="description" rows="6"><?php echo $product['description']; ?></textarea>
                </div>

                <div class="form-group">
                   <label>PRODUCT PHOTOS</label>
                    <div class="photo-upload-area" onclick="document.getElementById('imageInput').click();" style="cursor: pointer;">
                        <i class="fas fa-file-upload"></i>
                        <p id="fileNameDisplay">
                            <?php echo !empty($product['image']) ? "Current: " . $product['image'] : "Click to upload new image"; ?>
                            <br><small>Supports JPG, PNG up to 10MB</small>
                        </p>
                        <input type="file" name="product_image" id="imageInput" accept="image/*" style="display: none;" onchange="showName()">
                    </div>
                </div>
            </section>

            <aside class="sidebar-status">
                <div class="status-card">
                    <h3>Publish Status</h3>
                    <button type="submit" class="btn-save-changes">Save Changes</button>
                    <a href="products.php" class="btn-cancel">Cancel</a>
                </div>
            </aside>
        </div>
    </form>
</main>

<script>
function showName() {
    const fileInput = document.getElementById('imageInput');
    const display = document.getElementById('fileNameDisplay');
    if (fileInput.files.length > 0) {
        display.innerHTML = "<strong>Selected:</strong> " + fileInput.files[0].name;
    }
}
</script>

</body>
</html>