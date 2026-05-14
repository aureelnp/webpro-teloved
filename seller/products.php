<?php
include '../auth/middleware.php';
if($_SESSION['role'] != 'seller'){ die("Access Denied"); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | Teloved</title>
    <link rel="stylesheet" href="../assets/css/seller-dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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

<main class="container product-manage-section">
    <div class="header-flex">
        <div class="title-area">
            <h1>My Listings</h1>
            <p>Manage your product inventory.</p>
        </div>
        <a href="add-product.php" class="add-product-btn"><i class="fas fa-plus"></i> Add Product</a>
    </div>

    <div class="product-grid" id="productContainer">
        <p>Loading products...</p>
    </div>
</main>

<script>
async function loadProducts() {
    try {
        const response = await fetch('../api/products/product_action.php');
        const products = await response.json();
        const container = document.getElementById('productContainer');
        container.innerHTML = '';

        if (products.length === 0) {
            container.innerHTML = '<p>Anda belum memiliki produk.</p>';
            return;
        }

        products.forEach(p => {
        const imagePath = p.image 
            ? `../assets/images/products/${p.image}` 
            : null;

        container.innerHTML += `
            <div class="product-card">
                <div class="product-image-placeholder">
                    ${imagePath 
                        ? `<img src="${imagePath}" style="width:100%; height:100%; object-fit:cover;">` 
                        : `<i class="far fa-image"></i>`
                    }
                    <span class="status-badge">ACTIVE</span>
                </div>
                <div class="product-details">
                    <div class="info-top">
                        <h3 class="product-name">${p.product_name}</h3>
                        <p class="product-price">Rp ${new Intl.NumberFormat('id-ID').format(p.price)}</p>
                    </div>
                    <div class="product-meta">
                        <div class="meta-item">
                            <i class="fas fa-tag"></i> <span>${p.category}</span>
                        </div>
                        <div class="meta-item condition">
                            <i class="fas fa-info-circle"></i> <span>Condition: ${p.product_condition}</span>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <a href="editProduct.php?id=${p.id}" class="edit-btn">Edit Details</a>
                        <button onclick="deleteProduct(${p.id})" class="delete-btn">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
    });
    } catch (err) {
        console.error("Gagal memuat produk:", err);
        document.getElementById('productContainer').innerHTML = '<p>Error memuat data.</p>';
    }
}

async function deleteProduct(id) {
    if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
        try {
            const response = await fetch(`../api/products/deleteProducts.php?id=${id}`);
            const result = await response.text();

            if (result.trim().toLowerCase().includes("success")) {
                alert("Produk berhasil dihapus!");
                loadProducts(); 
            } else {
                alert("Gagal menghapus produk. Pesan: " + result);
            }
        } catch (err) {
            console.error("Error saat menghapus:", err);
            alert("Terjadi kesalahan koneksi ke server.");
        }
    }
}

document.addEventListener('DOMContentLoaded', loadProducts);
</script>
</body>
</html>