<?php

include '../auth/adminMiddleware.php';
include '../config/connect.php';

$query = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE role != 'admin'"
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Manage Users</title>

<link rel="stylesheet" href="../assets/css/admin.css">

</head>

<body>

<?php include 'partials/sidebar.php'; ?>

<div class="main">

    <h1 class="page-title">
        Manage Users
    </h1>

    <p class="page-subtitle">
        List of registered users.
    </p>

    <div class="table-container">

        <table>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>

            <?php while($user = mysqli_fetch_assoc($query)) : ?>

            <tr>

                <td><?php echo $user['id']; ?></td>

                <td><?php echo $user['name']; ?></td>

                <td><?php echo $user['email']; ?></td>

                <td><?php echo $user['role']; ?></td>

                <td>

                    <a
                    class="delete-btn"
                    href="../api/admin/deleteUser.php?id=<?php echo $user['id']; ?>"
                    >
                        Delete
                    </a>

                </td>

            </tr>

            <?php endwhile; ?>

        </table>

    </div>

</div>

</body>
</html>