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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<nav class="navbar">
    <div class="container nav-wrapper">
        <div class="logo">TELOVED</div>
        <div class="search-bar">
            <input  
                type="text"
                id="searchInput"
                placeholder="Search products..."
            >
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
            $cats = ['Tas', 'Sepatu', 'Atasan', 'Bawahan', 'Aksesoris'];
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
            <div class="product-card" data-name="<?php echo strtolower($product['product_name']); ?>">
                <div class="product-image">
                    <?php 
                        // Logika pengecekan gambar
                        $imgName = $product['image'];
                        $imgPath = "../assets/images/products/" . $imgName;
                        
                        if (!empty($imgName) && file_exists($imgPath)) {
                            $displayImg = $imgPath;
                        } else {
                            $displayImg = "https://via.placeholder.com/300?text=No+Image";
                        }
                    ?>
                    <img src="<?php echo $displayImg; ?>" alt="<?php echo $product['product_name']; ?>">
                    <span class="badge">NEW ARRIVAL</span>
                </div>
                <div class="product-info">
                    <h3><?php echo $product['product_name']; ?></h3>
                    <p class="price">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                    
                    <div class="product-meta" style="margin: 8px 0; border-top: 1px solid #f0f0f0; padding-top: 8px;">
                        <span style="font-size: 11px; color: #888; display: block; margin-bottom: 4px;">
                            <i class="fas fa-tag"></i> <?php echo $product['category']; ?>
                        </span>
                        <span style="font-size: 11px; font-weight: 600; color: #4A7C59; display: block;">
                            <i class="fas fa-info-circle"></i> Condition: <?php echo $product['product_condition']; ?>
                        </span>
                    </div>

                    <p class="seller" style="margin-top: 5px;">Seller: <?php echo $product['seller_name']; ?></p>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const cards = document.querySelectorAll('.product-card');

    searchInput.addEventListener('keyup', () => {
        const keyword = searchInput.value.toLowerCase();
        cards.forEach(card => {
            const productName = card.dataset.name;
            if(productName.includes(keyword)){
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    searchInput.addEventListener('focus', () => {
        searchInput.parentElement.style.boxShadow = '0 0 0 3px rgba(74,124,89,0.2)';
    });

    searchInput.addEventListener('blur', () => {
        searchInput.parentElement.style.boxShadow = 'none';
    });

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