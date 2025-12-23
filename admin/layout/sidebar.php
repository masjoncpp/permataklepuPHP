<?php
$current_page = basename($_SERVER['PHP_SELF']);
$current_dir = basename(dirname($_SERVER['PHP_SELF']));
?>

<aside class="sidebar">
    <div class="sidebar-header">
        <img src="<?= BASE_URL ?>assets/img/permata-min.png" alt="Logo"
            style="width: 40px; height: 40px; object-fit: contain; margin-right: 10px;">
        <h3 style="font-size: 1.2rem; margin: 0;">Permata Klepu</h3>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="<?= BASE_URL ?>admin/index.php"
                class="<?= ($current_page == 'index.php' && $current_dir == 'admin') ? 'active' : '' ?>">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>admin/modules/kelas/index.php"
                class="<?= ($current_dir == 'kelas') ? 'active' : '' ?>">
                <i class="fas fa-chalkboard-teacher"></i> Kelola Kelas
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>admin/modules/galeri/index.php"
                class="<?= ($current_dir == 'galeri') ? 'active' : '' ?>">
                <i class="fas fa-images"></i> Kelola Galeri
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>admin/modules/artikel/index.php"
                class="<?= ($current_dir == 'artikel') ? 'active' : '' ?>">
                <i class="fas fa-newspaper"></i> Kelola Artikel
            </a>
        </li>
        <a href="<?= BASE_URL ?>admin/modules/nilai/index.php" class="<?= ($current_dir == 'nilai') ? 'active' : '' ?>">
            <i class="fas fa-graduation-cap"></i> Kelola Nilai
        </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>admin/modules/presensi/index.php"
                class="<?= ($current_dir == 'presensi') ? 'active' : '' ?>">
                <i class="fas fa-calendar-check"></i> Kelola Presensi
            </a>
        </li>
        <li style="margin-top: auto;">
            <a href="<?= BASE_URL ?>admin/logout.php" style="color: #fca5a5;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
    </ul>
</aside>