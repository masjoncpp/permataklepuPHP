<?php
include 'config/koneksi.php';

$sql = "CREATE OR REPLACE VIEW view_siswa_summary AS
SELECT 
    id,
    nama_peserta,
    username,
    kelas,
    nilai_akhir,
    status,
    link_ijazah
FROM nilai";

if (mysqli_query($koneksi, $sql)) {
    echo "View 'view_siswa_summary' created successfully.\n";
} else {
    echo "Error creating view: " . mysqli_error($koneksi) . "\n";
}
?>