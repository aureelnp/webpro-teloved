<?php
include '../auth/middleware.php';
if ($_SESSION['role'] != 'seller') { die("Access Denied"); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product | Teloved</title>
    <link rel="stylesheet" href="../assets/css/seller-dashboard.css">
    <link rel="stylesheet" href="../assets/css/seller-add-product.css">
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

<main class="container">
    <div class="add-product-container">
        <aside class="sidebar-tips">
            <div class="tips-card">
                <h3>Listing Tips</h3>
                <p>Ensure your item is campus-compliant. Clear photos and honest descriptions help sell items 3x faster.</p>
                <ul class="tips-list">
                    <li><i class="fas fa-check-circle" style="color: #2f5d50;"></i> Use natural lighting</li>
                    <li><i class="fas fa-check-circle" style="color: #2f5d50;"></i> Mention defects clearly</li>
                </ul>
            </div>
        </aside>

        <section class="form-card">
            <h1>Add New Product</h1>
            <!-- Tambahkan enctype="multipart/form-data" sebagai formalitas -->
            <form id="formAddProduct" enctype="multipart/form-data">
                <div class="form-group">
                    <label>PRODUCT TITLE</label>
                    <input type="text" name="product_name" placeholder="e.g., Organic Chemistry" required>
                </div>

                <div style="display: flex; gap: 20px;">
                    <div class="form-group" style="flex: 1;">
                        <label>CATEGORY</label>
                        <select name="category" required>
                            <option value="">Select Category</option>
                            <option value="Elektronik">Elektronik</option>
                            <option value="Tas">Tas</option>
                            <option value="Sepatu">Sepatu</option>
                            <option value="Atasan">Atasan</option>
                            <option value="Bawahan">Bawahan</option>
                            <option value="Aksesoris">Aksesoris</option>
                            <option value="Buku">Buku</option>
                        </select>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label>PRICE (IDR)</label>
                        <input type="number" name="price" placeholder="Rp 0.00" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>CONDITION</label>
                    <div class="condition-options">
                        <label><input type="radio" name="product_condition" value="New" required> New</label>
                        <label><input type="radio" name="product_condition" value="Like New"> Like New</label>
                        <label><input type="radio" name="product_condition" value="Good"> Good</label>
                        <label><input type="radio" name="product_condition" value="Fair"> Fair</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>DESCRIPTION</label>
                    <textarea name="description" rows="5" placeholder="Describe features..." required></textarea>
                </div>

                <div class="form-group">
                    <label>PRODUCT PHOTOS</label>
                    <!-- Logika klik untuk browse sama seperti edit-product -->
                    <div class="photo-upload-area" onclick="document.getElementById('imageInput').click();" style="cursor: pointer;">
                        <i class="fas fa-file-upload"></i>
                        <p id="fileNameDisplay">Drag and drop images or click to browse<br><small>Supports JPG, PNG up to 10MB</small></p>
                        <!-- Input file asli -->
                        <input type="file" name="product_image" id="imageInput" accept="image/*" style="display: none;" onchange="updateFileName()">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="save-draft-btn" onclick="history.back()">CANCEL</button>
                    <button type="submit" class="submit-btn">SUBMIT</button>
                </div>
            </form>
        </section>
    </div>
</main>

<script>
function updateFileName() {
    const input = document.getElementById('imageInput');
    const display = document.getElementById('fileNameDisplay');
    if (input.files.length > 0) {
        display.innerHTML = "<strong>Selected:</strong> " + input.files[0].name;
    }
}

document.getElementById('formAddProduct').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    try {
        const response = await fetch('/webpro/api/products/product_action.php', {
            method: 'POST',
            body: formData 
        });
        const result = await response.json();
        if(result.status === 'success') {
            alert(result.message);
            window.location.href = 'products.php';
        } else {
            alert("Error: " + result.message);
        }
    } catch (err) {
        console.error(err);
        alert("An error occurred. Check console for details.");
    }
});
</script>
</body>
</html>