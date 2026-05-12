<?php

include '../auth/middleware.php';

if($_SESSION['role'] != 'seller'){
    die("Access Denied");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Seller Dashboard | Teloved</title>

    <link rel="stylesheet"
          href="../assets/css/seller-dashboard.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
          rel="stylesheet">

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">

    <div class="container nav-wrapper">

        <div class="logo">
            TELOVED
        </div>

        <div class="nav-links">

            <a href="dashboard.php"
               class="active">

                Dashboard

            </a>

            <a href="products.php">

                Manage Products

            </a>

            <a href="../auth/logout.php"
               class="logout-btn">

                Logout

            </a>

        </div>

    </div>

</nav>
<section class="dashboard-hero">

    <div class="hero-content">

        <span class="badge">
            Seller Panel
        </span>

        <h1>
            Welcome Seller,
            <br>

            <span>
                <?php echo $_SESSION['name']; ?>
            </span>

        </h1>

        <p>
            Manage your products easily and grow
            your preloved marketplace experience
            with Teloved.
        </p>

        <div class="hero-buttons">

            <a href="products.php"
               class="primary-btn">

                Manage Products

            </a>

        </div>

    </div>

</section>

<script>

document.addEventListener('DOMContentLoaded', () => {

    const cards = document.querySelectorAll('.stat-card');

    cards.forEach(card => {

        card.addEventListener('mouseenter', () => {

            card.style.transform = 'translateY(-8px)';

        });

        card.addEventListener('mouseleave', () => {

            card.style.transform = 'translateY(0px)';

        });

    });

});

</script>

</body>
</html>