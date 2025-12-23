<?php
$host = "localhost";
$user = "jottie";
$pass = "masjottie";
$db = "db_permataklepu";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
define('BASE_URL', 'http://localhost/');
?>