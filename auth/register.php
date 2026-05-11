<?php

include '../config/connect.php';

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $query = "INSERT INTO users(name, email, password, role)
              VALUES('$name', '$email', '$password', '$role')";

    $result = mysqli_query($conn, $query);

    if($result){
        echo "Register Success";
    } else {
        echo "Register Failed";
    }
}

?>

<form method="POST">

    <input type="text" name="name" placeholder="Name">
    <br><br>

    <input type="email" name="email" placeholder="Email">
    <br><br>

    <input type="password" name="password" placeholder="Password">
    <br><br>

    <select name="role">
        <option value="seller">Seller</option>
        <option value="buyer">Buyer</option>
    </select>

    <br><br>

    <button type="submit" name="register">
        Register
    </button>

</form>