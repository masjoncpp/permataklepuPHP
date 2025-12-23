<?php
include '../../../config/koneksi.php';

$aksi = $_GET['aksi'];
$target_dir = "../../../assets/uploads/";

// --- TAMBAH ---
if ($aksi == "tambah") {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $kategori = $_POST['kategori'];
    $tanggal = $_POST['tanggal'];
    $link_drive = $_POST['link_drive'];

    // Upload Gambar
    $foto_nama = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto_baru = rand() . '_' . $foto_nama;

    move_uploaded_file($foto_tmp, $target_dir . $foto_baru);

    $stmt = mysqli_prepare($koneksi, "INSERT INTO artikel (judul, kategori, isi, gambar, link_drive, tanggal) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssss", $judul, $kategori, $isi, $foto_baru, $link_drive, $tanggal);
    mysqli_stmt_execute($stmt);

    header("Location: index.php?pesan=sukses");

    // --- EDIT ---
} elseif ($aksi == "edit") {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $kategori = $_POST['kategori'];
    $tanggal = $_POST['tanggal'];
    $link_drive = $_POST['link_drive'];
    $foto_lama = $_POST['foto_lama'];

    if ($_FILES['foto']['name'] != "") {
        $foto_nama = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_baru = rand() . '_' . $foto_nama;

        move_uploaded_file($foto_tmp, $target_dir . $foto_baru);
        if (file_exists($target_dir . $foto_lama) && $foto_lama != "")
            unlink($target_dir . $foto_lama);

        $gambar_db = $foto_baru;
    } else {
        $gambar_db = $foto_lama;
    }

    $stmt = mysqli_prepare($koneksi, "UPDATE artikel SET judul=?, kategori=?, isi=?, gambar=?, link_drive=?, tanggal=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssssssi", $judul, $kategori, $isi, $gambar_db, $link_drive, $tanggal, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php?pesan=update");

    // --- HAPUS ---
} elseif ($aksi == "hapus") {
    $id = $_GET['id'];
    $gambar = $_GET['gambar'];

    if (file_exists($target_dir . $gambar) && $gambar != "")
        unlink($target_dir . $gambar);

    $stmt = mysqli_prepare($koneksi, "DELETE FROM artikel WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    header("Location: index.php?pesan=hapus");
}
?>