<?php

include '../../config/connect.php';

$id = $_GET['id'];

$query = mysqli_query($conn,
    "DELETE FROM products WHERE id='$id'"
);

if($query){
    echo "Deleted";
} else {
    echo "Failed";
}

?>