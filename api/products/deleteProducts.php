<?php
include '../../config/connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "DELETE FROM products WHERE id='$id'");

    if ($query) {
        echo "success"; 
    } else {
        echo "failed";
    }
}
exit(); 
?>