<?php
session_start();
include '../../config/connect.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}

$id = $_POST['id'];
$product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$price = $_POST['price'];
$category = $_POST['category'];
$product_condition = $_POST['product_condition'];

$image_update = "";

if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['product_image']['tmp_name'];
    $file_name = $_FILES['product_image']['name'];
    
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
    $new_file_name = time() . '_' . uniqid() . '.' . $file_ext;
    
    $upload_dir = "../../assets/images/products/";
    
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
        $image_update = ", image='$new_file_name'";
    }
}

$query = "UPDATE products 
          SET 
            product_name='$product_name', 
            description='$description', 
            price='$price',
            category='$category',
            product_condition='$product_condition'
            $image_update 
          WHERE id='$id'";

$result = mysqli_query($conn, $query);

if($result){
    header("Location: ../../seller/products.php?status=updated");
} else {
    echo "Failed to update: " . mysqli_error($conn);
}
?>