<?php
include '../config/koneksi.php';
include 'layout/header.php';

$jumlah_artikel = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM artikel"));
$jumlah_galeri = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM galeri"));
$jumlah_nilai = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai"));
$jumlah_kelas = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kelas"));
?>

<h2 style="margin-bottom: 1.5rem;">Dashboard Overview</h2>

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon bg-purple">
            <i class="fas fa-newspaper"></i>
        </div>
        <div>
            <h3 style="margin:0; font-size: 2rem; color: #8b5cf6;"><?= $jumlah_artikel ?></h3>
            <span style="color: #6b7280;">Total Artikel</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-green">
            <i class="fas fa-images"></i>
        </div>
        <div>
            <h3 style="margin:0; font-size: 2rem; color: #10b981;"><?= $jumlah_galeri ?></h3>
            <span style="color: #6b7280;">Foto Galeri</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: #f59e0b; color: white;">
            <i class="fas fa-chalkboard-teacher"></i>
        </div>
        <div>
            <h3 style="margin:0; font-size: 2rem; color: #f59e0b;"><?= $jumlah_kelas ?></h3>
            <span style="color: #6b7280;">Program Kelas</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-blue">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <h3 style="margin:0; font-size: 2rem; color: #3b82f6;"><?= $jumlah_nilai ?></h3>
            <span style="color: #6b7280;">Data Nilai</span>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 2rem; padding: 2rem;">
    <h3><i class="fas fa-info-circle"></i> Petunjuk Penggunaan</h3>
    <p>Selamat datang di halaman administrator. Gunakan menu di sebelah kiri untuk mengelola konten website:</p>
    <ul style="line-height: 1.8; margin-left: 1.5rem;">
        <li><b>Kelola Kelas:</b> Tambah, edit, atau hapus program kelas yang ditampilkan di halaman depan.</li>
        <li><b>Kelola Galeri:</b> Upload foto dokumentasi kegiatan baru.</li>
        <li><b>Kelola Artikel:</b> Tulis berita atau literasi baru.</li>
        <li><b>Kelola Nilai:</b> Input data kelulusan dan link ijazah peserta.</li>
    </ul>
</div>

<?php include 'layout/footer.php'; ?>