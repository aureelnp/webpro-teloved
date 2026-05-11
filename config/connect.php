<?php
    $servername = "localhost"; // Ganti dengan nama host database Anda
    $username   = "root";     // Ganti dengan username database Anda
    $password   = "";         // Ganti dengan password database Anda
    $dbname     = "webpro"; // Ganti dengan nama database Anda

    // Membuat koneksi
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Memeriksa koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
    // echo "<p>Koneksi ke database berhasil!</p>";

?>