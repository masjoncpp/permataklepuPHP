<?php
include 'config/koneksi.php';

// Create presensi table
$sql1 = "CREATE TABLE IF NOT EXISTS presensi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    program VARCHAR(50) NOT NULL,
    status_kehadiran VARCHAR(20) DEFAULT 'Hadir',
    tanggal DATETIME DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($koneksi, $sql1)) {
    echo "Table 'presensi' created successfully.\n";
} else {
    echo "Error creating table 'presensi': " . mysqli_error($koneksi) . "\n";
}

// Create pengaturan table
$sql2 = "CREATE TABLE IF NOT EXISTS pengaturan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kunci VARCHAR(50) UNIQUE NOT NULL,
    nilai VARCHAR(50) NOT NULL
)";

if (mysqli_query($koneksi, $sql2)) {
    echo "Table 'pengaturan' created successfully.\n";
} else {
    echo "Error creating table 'pengaturan': " . mysqli_error($koneksi) . "\n";
}

// Insert default setting for presensi
$sql3 = "INSERT IGNORE INTO pengaturan (kunci, nilai) VALUES ('presensi_status', 'buka')";
if (mysqli_query($koneksi, $sql3)) {
    echo "Default setting inserted.\n";
} else {
    echo "Error inserting default setting: " . mysqli_error($koneksi) . "\n";
}
?>