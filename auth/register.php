<?php

include '../config/connect.php';

$message = "";

if(isset($_POST['register'])){

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // role otomatis dari hidden input
    $role = $_POST['role'];

    // cek email sudah ada atau belum
    $check = mysqli_query($conn,
        "SELECT * FROM users WHERE email='$email'"
    );

    if(mysqli_num_rows($check) > 0){

        $message = "Email already registered!";

    } else {

        $query = mysqli_query($conn,
            "INSERT INTO users(name,email,password,role)
             VALUES('$name','$email','$password','$role')"
        );

        if($query){

            $message = "Register Success as " . ucfirst($role);

        } else {

            $message = "Register Failed";

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Register | Teloved</title>

    <link rel="stylesheet"
          href="../assets/css/register.css">

</head>

<body>

<div class="register-wrapper">

    <div class="register-card">

        <!-- HEADER -->
        <div class="register-header">

            <h1>Create Account</h1>

            <p>
                Please fill the details below to register your account
            </p>

        </div>

        <!-- ROLE -->
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

        <!-- MESSAGE -->
        <?php if($message != "") : ?>

            <div class="message">

                <?php echo $message; ?>

            </div>

        <?php endif; ?>

        <!-- FORM -->
        <form method="POST"
              class="register-form">

            <!-- hidden role -->
            <input type="hidden"
                   name="role"
                   id="selectedRole"
                   value="buyer">

            <!-- NAME -->
            <div class="form-group">

                <label>Name</label>

                <input type="text"
                       name="name"
                       placeholder="John Doe"
                       required>

            </div>

            <!-- EMAIL -->
            <div class="form-group">

                <label>Email</label>

                <input type="email"
                       name="email"
                       placeholder="j.doe@university.edu"
                       required>

            </div>

            <!-- PASSWORD -->
            <div class="form-group">

                <label>Password</label>

                <input type="password"
                       name="password"
                       placeholder="••••••••"
                       required>

            </div>

            <!-- TERMS -->
            <div class="terms">

                <input type="checkbox"
                       required>

                <p>
                    I agree to the
                    <span>Terms of Service</span>
                    and
                    <span>Privacy Policy</span>
                </p>

            </div>

                <button type="submit"
                        name="register"
                        class="register-btn">

                    CREATE ACCOUNT

                </button>

            <!-- FOOTER -->
            <div class="register-footer">

                <p>
    Already have an account?
    <a href="login.php">Sign In</a>
</p>

            </div>

        </form>

    </div>

</div>

<!-- JAVASCRIPT -->
<script>

const roleButtons = document.querySelectorAll(".role-btn");
const selectedRole = document.getElementById("selectedRole");

roleButtons.forEach(button => {

    button.addEventListener("click", () => {

        // remove active
        roleButtons.forEach(btn => {
            btn.classList.remove("active");
        });

        // add active
        button.classList.add("active");

        // ubah role hidden input
        selectedRole.value = button.dataset.role;

    });

});

</script>

</body>
</html>