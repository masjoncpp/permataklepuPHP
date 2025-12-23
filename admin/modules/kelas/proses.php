<?php
include '../../../config/koneksi.php';

$aksi = $_GET['aksi'];
$target_dir = "../../../assets/uploads/";

if ($aksi == "tambah") {
    $nama = $_POST['nama_kelas'];
    $deskripsi = $_POST['deskripsi'];

    $foto_nama = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto_baru = rand() . '_' . $foto_nama;

    move_uploaded_file($foto_tmp, $target_dir . $foto_baru);

    $stmt = mysqli_prepare($koneksi, "INSERT INTO kelas (nama_kelas, deskripsi, gambar) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $nama, $deskripsi, $foto_baru);
    mysqli_stmt_execute($stmt);
    header("Location: index.php?pesan=sukses");

} elseif ($aksi == "edit") {
    $id = $_POST['id'];
    $nama = $_POST['nama_kelas'];
    $deskripsi = $_POST['deskripsi'];
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

    $stmt = mysqli_prepare($koneksi, "UPDATE kelas SET nama_kelas=?, deskripsi=?, gambar=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssi", $nama, $deskripsi, $gambar_db, $id);
    mysqli_stmt_execute($stmt);
    header("Location: index.php?pesan=update");

} elseif ($aksi == "hapus") {
    $id = $_GET['id'];
    $gambar = $_GET['gambar'];

    if (file_exists($target_dir . $gambar) && $gambar != "")
        unlink($target_dir . $gambar);
    $stmt = mysqli_prepare($koneksi, "DELETE FROM kelas WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    header("Location: index.php?pesan=hapus");
}
?>