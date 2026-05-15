<?php
header('Content-Type: application/json');
include '../../config/connect.php'; 
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'seller') {
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$seller_id = $_SESSION['user_id'];

switch($method) {
    case 'GET':
        $query = mysqli_query($conn, "SELECT * FROM products WHERE seller_id='$seller_id' ORDER BY id DESC");
        $products = mysqli_fetch_all($query, MYSQLI_ASSOC);
        echo json_encode($products);
        break;

    case 'POST':
        $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $price = (int)$_POST['price'];
        $condition = mysqli_real_escape_string($conn, $_POST['product_condition']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        
        $image_name = ""; 

        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['product_image']['tmp_name'];
            $file_original_name = $_FILES['product_image']['name'];
            
            $file_ext = strtolower(pathinfo($file_original_name, PATHINFO_EXTENSION));
            
            $image_name = time() . '_' . uniqid() . '.' . $file_ext;
            
            $upload_dir = "../../assets/images/products/";
            
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if (!move_uploaded_file($file_tmp, $upload_dir . $image_name)) {
               echo json_encode([
                    "status"=>"error",
                    "tmp"=>$file_tmp,
                    "target"=>$upload_dir.$image_name,
                    "upload_error"=>$_FILES['product_image']['error'],
                    "message"=>"Move failed"
                ]);
            }

            
        }

        $sql = "INSERT INTO products (seller_id, product_name, category, price, product_condition, description, image) 
                VALUES ('$seller_id', '$product_name', '$category', '$price', '$condition', '$description', '$image_name')";
        
        if(mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "success", "message" => "Product added successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
        }
        break;
}