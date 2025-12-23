<?php
include '../../../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = mysqli_prepare($koneksi, "DELETE FROM presensi WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?pesan=hapus");
    } else {
        header("Location: index.php?pesan=gagal");
    }
}
?>