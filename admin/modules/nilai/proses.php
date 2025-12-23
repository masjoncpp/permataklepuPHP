<?php
include '../../../config/koneksi.php';

$aksi = $_GET['aksi'];

// --- TAMBAH ---
if ($aksi == "tambah") {
    $nama = $_POST['nama_peserta'];
    $kelas = $_POST['kelas'];
    $nilai = $_POST['nilai_akhir'];
    $status = $_POST['status'];
    $link = $_POST['link_ijazah'];

    $stmt = mysqli_prepare($koneksi, "INSERT INTO nilai (nama_peserta, kelas, nilai_akhir, status, link_ijazah) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssdss", $nama, $kelas, $nilai, $status, $link);
    mysqli_stmt_execute($stmt);

    header("Location: index.php?pesan=sukses");

    // --- EDIT ---
} elseif ($aksi == "edit") {
    $id = $_POST['id'];
    $nama = $_POST['nama_peserta'];
    $kelas = $_POST['kelas'];
    $nilai = $_POST['nilai_akhir'];
    $status = $_POST['status'];
    $link = $_POST['link_ijazah'];
    $password_baru = $_POST['password_baru'];

    if (!empty($password_baru)) {
        // Jika password diisi, update password juga
        $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($koneksi, "UPDATE nilai SET nama_peserta=?, kelas=?, nilai_akhir=?, status=?, link_ijazah=?, password=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "ssdsssi", $nama, $kelas, $nilai, $status, $link, $password_hash, $id);
    } else {
        // Jika password kosong, jangan update password
        $stmt = mysqli_prepare($koneksi, "UPDATE nilai SET nama_peserta=?, kelas=?, nilai_akhir=?, status=?, link_ijazah=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "ssdssi", $nama, $kelas, $nilai, $status, $link, $id);
    }

    mysqli_stmt_execute($stmt);

    header("Location: index.php?pesan=update");

    // --- IMPORT CSV ---
} elseif ($aksi == "import") {
    if (isset($_FILES['file_csv']) && $_FILES['file_csv']['error'] == 0) {
        $file = $_FILES['file_csv']['tmp_name'];
        $handle = fopen($file, "r");

        // Skip Header Row
        fgetcsv($handle);

        // Prepare Statement for Insert
        $stmt = mysqli_prepare($koneksi, "INSERT INTO nilai (nama_peserta, kelas, nilai_akhir, status, link_ijazah) VALUES (?, ?, ?, ?, ?)");

        $count = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Map CSV columns to variables
            // Format CSV: Nama Peserta, Kelas, Nilai Akhir, Status, Link Ijazah
            $nama = $data[0];
            $kelas = $data[1];
            $nilai = $data[2];
            $status = $data[3];
            $link = $data[4];

            if (!empty($nama)) { // Basic validation
                mysqli_stmt_bind_param($stmt, "ssdss", $nama, $kelas, $nilai, $status, $link);
                mysqli_stmt_execute($stmt);
                $count++;
            }
        }

        fclose($handle);
        header("Location: index.php?pesan=sukses&jumlah=" . $count);
    } else {
        header("Location: index.php?pesan=gagal");
    }

    // --- HAPUS ---
} elseif ($aksi == "hapus") {
    $id = $_GET['id'];
    $stmt = mysqli_prepare($koneksi, "DELETE FROM nilai WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    header("Location: index.php?pesan=hapus");
}
?>