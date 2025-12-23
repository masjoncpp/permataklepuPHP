<?php
include 'config/koneksi.php';

header('Content-Type: application/json');

// Check method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

// Check if presensi is open
$query_setting = mysqli_query($koneksi, "SELECT nilai FROM pengaturan WHERE kunci = 'presensi_status'");
$setting = mysqli_fetch_assoc($query_setting);

if (!$setting || $setting['nilai'] !== 'buka') {
    echo json_encode(['status' => 'error', 'message' => 'Mohon maaf, form presensi saat ini sedang ditutup.']);
    exit;
}

$nama = $_POST['NamaLengkap'] ?? '';
$alamat = $_POST['Alamat'] ?? '';
$program = $_POST['NamaKegiatan'] ?? '';

if (empty($nama) || empty($alamat) || empty($program)) {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap.']);
    exit;
}

$stmt = mysqli_prepare($koneksi, "INSERT INTO presensi (nama_lengkap, alamat, program) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sss", $nama, $alamat, $program);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['status' => 'success', 'message' => 'Presensi berhasil disimpan.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data database: ' . mysqli_error($koneksi)]);
}
?>