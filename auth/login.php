<?php

session_start();

include '../config/connect.php';

$error = "";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $selectedRole = $_POST['role'];

    $query = mysqli_query($conn,
        "SELECT * FROM users WHERE email='$email'"
    );

    $user = mysqli_fetch_assoc($query);

    // cek apakah user ditemukan
    if($user){

        // cek password
        if(password_verify($password, $user['password'])){

            // cek role sesuai atau tidak
            if($selectedRole != $user['role']){

                $error = "Role tidak sesuai!";

            } else {

                // simpan session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'];

                // redirect berdasarkan role
                if($user['role'] == 'seller'){

                    header("Location: ../seller/dashboard.php");
                    exit;

                } else {

                    header("Location: ../buyer/homepage.php");
                    exit;

                }

            }

        } else {

            $error = "Akun tidak ditemukan!";

        }

    } else {

        $error = "Akun tidak ditemukan!";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login | Teloved</title>

    <link rel="stylesheet"
          href="../assets/css/login.css">
</head>

<body>

<main class="login-wrapper">

    <section class="login-card">

        <header class="login-header">

            <div class="icon">
                <img src="../assets/images/login-icon.png"
                     alt="Login Icon">
            </div>

            <h1>
                Welcome to <span>Teloved!</span>
            </h1>

            <p>
                Login to existing account
            </p>

            <small>
                Please fill the details below to login to your account
            </small>

        </header>

        <!-- ROLE BUTTON -->
        <section class="login-type">

            <button type="button"
                    class="role-btn active"
                    data-role="buyer">

                Buyer

            </button>

            <button type="button"
                    class="role-btn"
                    data-role="seller">

                Seller

            </button>

        </section>

        <!-- ERROR MESSAGE -->
        <?php if($error != "") : ?>

            <div class="error-message">
                <?php echo $error; ?>
            </div>

        <?php endif; ?>

        <!-- LOGIN FORM -->
        <form class="login-form"
              method="POST">

            <!-- hidden role -->
            <input type="hidden"
                   name="role"
                   id="selectedRole"
                   value="buyer">

            <div class="form-group">

            <label>Email</label>

                <input type="email"
                       name="email"
                       placeholder="E-mail"
                       required>

            </div>

            <div class="form-group">

                <input type="password"
                       name="password"
                       placeholder="Password"
                       required>

                <a href="#"
                   class="forgot">

                    Forgot Password?

                </a>

            </div>

            <button type="submit"
                    class="login-btn"
                    name="login">

                Login

            </button>

        </form>

        <footer class="login-footer">

            <p>
                Don’t have an account?
                <a href="register.php">
                    Create here
                </a>
            </p>

        </footer>

    </section>

</main>

<!-- JAVASCRIPT ROLE SWITCH -->
<script>

const roleButtons = document.querySelectorAll(".role-btn");
const selectedRole = document.getElementById("selectedRole");

roleButtons.forEach(button => {

    button.addEventListener("click", () => {

        // hapus active semua button
        roleButtons.forEach(btn => {
            btn.classList.remove("active");
        });

        // tambahkan active ke button dipilih
        button.classList.add("active");

        // ubah hidden input role
        selectedRole.value = button.dataset.role;

    });

});

</script>

</body>

</html>