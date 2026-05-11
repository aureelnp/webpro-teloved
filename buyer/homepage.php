<?php
include '../auth/middleware.php';
include '../config/connect.php';

$query = mysqli_query($conn,
    "SELECT products.*, users.name as seller_name 
     FROM products 
     JOIN users ON users.id = products.seller_id"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teloved - Preloved Marketplace</title>
    <link rel="stylesheet" href="../assets/css/homepage.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
    <div class="container nav-wrapper">
        <div class="logo">TELOVED</div>
        <div class="search-bar">
            <input type="text" placeholder="Search products...">
        </div>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Dashboard</a>
            <a href="#">Voucher</a>
            <a href="../auth/logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
</nav>

<main class="container">
    <section class="hero">
        <div class="hero-content">
            <h1>PRELOVED MARKETPLACE</h1>
            <p>Discover unique finds and sustainable style in our curated community marketplace.</p>
            <button class="btn-shop">SHOP NOW</button>
        </div>
    </section>

    <section class="categories">
        <h2>CATEGORIES</h2>
        <div class="category-list">
            <?php 
            $cats = ['Tas', 'Sepatu', 'Atasan', 'Bawahan', 'Aksesoris', 'Vintage', 'Limited', 'Sale'];
            foreach($cats as $cat): ?>
                <div class="cat-item">
                    <div class="cat-circle"></div>
                    <span><?php echo $cat; ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="products-section">
        <div class="section-header">
            <h2>TRENDING NOW</h2>
            <a href="#">View All</a>
        </div>
        
        <div class="product-grid">
            <?php while($product = mysqli_fetch_assoc($query)) : ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="https://via.placeholder.com/300" alt="Product">
                    <span class="badge">NEW ARRIVAL</span>
                </div>
                <div class="product-info">
                    <h3><?php echo $product['product_name']; ?></h3>
                    <p class="price">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                    <p class="seller">Seller: <?php echo $product['seller_name']; ?></p>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
</main>

<script>
    // JavaScript untuk interaksi sederhana
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.querySelector('.search-bar input');
        
        // Efek focus pada search bar
        searchInput.addEventListener('focus', () => {
            searchInput.parentElement.style.boxShadow = '0 0 0 2px #d4edda';
        });

        searchInput.addEventListener('blur', () => {
            searchInput.parentElement.style.boxShadow = 'none';
        });

        // Contoh alert saat klik "Shop Now"
        document.querySelector('.btn-shop').addEventListener('click', () => {
            window.scrollTo({
                top: document.querySelector('.products-section').offsetTop - 100,
                behavior: 'smooth'
            });
        });
    });
</script>

</body>
</html>