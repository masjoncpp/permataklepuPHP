<?php
session_start();
session_destroy();
include '../config/koneksi.php';
header("Location: " . BASE_URL . "admin/login.php");
exit;
?>