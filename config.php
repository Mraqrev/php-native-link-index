<?php
$host = 'localhost'; // Ganti dengan host database Anda
$db = 'linkdb'; // Ganti dengan nama database Anda
$user = 'root'; // Ganti dengan username database Anda
$pass = ''; // Ganti dengan password database Anda

// Buat koneksi database
$conn = new mysqli($host, $user, $pass, $db);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
