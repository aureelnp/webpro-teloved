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

    if($user){

        if(password_verify($password, $user['password'])){

            if($selectedRole != $user['role']){
                $error = "Role tidak sesuai!";

            } else {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'];
            if($user['role'] == 'admin'){
                header("Location: ../admin/users.php");
            }
            elseif($user['role'] == 'seller'){
                header("Location: ../seller/dashboard.php");
            }
            else{
                header("Location: ../buyer/homepage.php");
            }

            }

        } else {
            $error = "Akun tidak ditemukan, silahkan Registrasi terlebih dahulu!";
        }

    } else {
        $error = "Akun tidak ditemukan, silahkan Registrasi terlebih dahulu!";
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
            
            <button type="button"
                    class="role-btn"
                    data-role="admin">
                Admin
            </button>

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

            <p id="registerFooter">
                Don’t have an account?
                <a href="register.php">
                    Create here
                </a>
            </p>

        </footer>

    </section>

</main>

<script>

const roleButtons = document.querySelectorAll(".role-btn");
const selectedRole = document.getElementById("selectedRole");
const registerFooter = document.getElementById("registerFooter");

roleButtons.forEach(button => {

    button.addEventListener("click", () => {

        roleButtons.forEach(btn => {
            btn.classList.remove("active");
        });

        button.classList.add("active");

        let role = button.dataset.role;

        selectedRole.value = role;

        // sembunyikan register kalau admin
        if(role === "admin"){
            registerFooter.style.display = "none";
        }else{
            registerFooter.style.display = "block";
        }

    });

});

</script>
</body>
</html>