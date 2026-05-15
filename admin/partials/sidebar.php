<?php

$currentPage = basename($_SERVER['PHP_SELF']);

?>
<div class="sidebar">

    <div class="logo">
        <h2>TELOVED</h2>
        <p>Admin Workspace</p>
    </div>

    <ul class="menu">
        <li>
                <a 
                href="users.php"
                class="<?= $currentPage == 'users.php' ? 'active' : '' ?>"
                >
                    Manage Users
                </a>
            </li>

            <li>
                <a 
                href="products.php"
                class="<?= $currentPage == 'products.php' ? 'active' : '' ?>"
                >
                    Manage Products
                </a>
            </li>

        <li>
            <a href="../auth/logout.php">
                Logout
            </a>
        </li>

    </ul>

</div>