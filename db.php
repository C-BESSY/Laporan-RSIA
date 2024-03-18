<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laporan_bulanan";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
