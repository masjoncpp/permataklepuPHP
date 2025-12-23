<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Cek Keamanan: Jika belum login, tendang ke login.php
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: " . BASE_URL . "admin/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>Dashboard Admin - Permata Klepu</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="admin-wrapper">
        <?php include __DIR__ . '/sidebar.php'; ?>

        <div class="main-content">
            <div class="topbar">
                <div style="display: flex; align-items: center; gap: 15px;">

                    <button class="toggle-btn" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>

                    <h4 style="margin: 0; font-size: 1rem;">
                        Hai, <b><?= explode(' ', $_SESSION['nama_lengkap'])[0] ?></b>
                    </h4>
                </div>

                <a href="<?= BASE_URL ?>" target="_blank" class="btn btn-outline"
                    style="padding: 5px 10px; font-size: 0.8rem; white-space: nowrap;">
                    <i class="fas fa-globe"></i> Lihat Web
                </a>
            </div>

            <div class="content-body">