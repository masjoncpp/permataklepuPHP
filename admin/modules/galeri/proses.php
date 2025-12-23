<?php
include '../../../config/koneksi.php';

// Ambil parameter aksi (tambah/edit/hapus)
$aksi = $_GET['aksi'];

// Folder tujuan upload
$target_dir = "../../../assets/uploads/";

// --- LOGIKA TAMBAH ---
if ($aksi == "tambah") {
    $judul = $_POST['judul'];
    $tanggal = $_POST['tanggal'];

    // Proses Upload File
    $foto_nama = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto_baru = rand() . '_' . $foto_nama; // Rename biar gak bentrok

    if (move_uploaded_file($foto_tmp, $target_dir . $foto_baru)) {
        // Jika upload berhasil, simpan ke DB
        $stmt = mysqli_prepare($koneksi, "INSERT INTO galeri (judul, tanggal, gambar) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $judul, $tanggal, $foto_baru);
        mysqli_stmt_execute($stmt);
        header("Location: index.php?pesan=sukses");
    } else {
        echo "Gagal Upload Gambar!";
    }

    // --- LOGIKA EDIT ---
} elseif ($aksi == "edit") {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $tanggal = $_POST['tanggal'];
    $foto_lama = $_POST['foto_lama'];

    // Cek apakah user upload foto baru?
    if ($_FILES['foto']['name'] != "") {
        // Upload foto baru
        $foto_nama = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_baru = rand() . '_' . $foto_nama;

        move_uploaded_file($foto_tmp, $target_dir . $foto_baru);

        // Hapus foto lama dari folder uploads (jika ada dan bukan gambar bawaan asset)
        if (file_exists($target_dir . $foto_lama) && $foto_lama != "") {
            unlink($target_dir . $foto_lama);
        }

        $nama_gambar_db = $foto_baru;
    } else {
        // Jika tidak ganti foto, pakai nama lama
        $nama_gambar_db = $foto_lama;
    }

    $stmt = mysqli_prepare($koneksi, "UPDATE galeri SET judul=?, tanggal=?, gambar=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssi", $judul, $tanggal, $nama_gambar_db, $id);
    mysqli_stmt_execute($stmt);
    header("Location: index.php?pesan=update");

    // --- LOGIKA HAPUS ---
} elseif ($aksi == "hapus") {
    $id = $_GET['id'];
    $gambar = $_GET['gambar'];

    // Hapus file fisik di folder uploads
    if (file_exists($target_dir . $gambar) && $gambar != "") {
        unlink($target_dir . $gambar);
    }

    // Hapus data di database
    $stmt = mysqli_prepare($koneksi, "DELETE FROM galeri WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    header("Location: index.php?pesan=hapus");
}
?>