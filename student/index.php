<?php
session_start();
include '../config/koneksi.php';

// Security Check
if (!isset($_SESSION['siswa_login']) || $_SESSION['siswa_login'] !== true) {
    header("Location: ../login_siswa.php");
    exit;
}

$id_siswa = $_SESSION['siswa_id'];
$nama_siswa = $_SESSION['nama_siswa']; // Defined in login_siswa.php

// Fetch Profile & Grade Data from VIEW
$query_profil = mysqli_query($koneksi, "SELECT * FROM view_siswa_summary WHERE id = '$id_siswa'");
$profil = mysqli_fetch_assoc($query_profil);

// Fetch Attendance History linked by Name
// Assuming nama_lengkap in presensi matches nama_peserta in nilai
$nama_clean = mysqli_real_escape_string($koneksi, $profil['nama_peserta']);
$query_presensi = mysqli_query($koneksi, "SELECT * FROM presensi WHERE nama_lengkap = '$nama_clean' ORDER BY tanggal DESC LIMIT 5");

include '../layout/header.php';
?>

<div class="container" style="padding-top: 120px; padding-bottom: 60px;">

    <!-- Welcome Header -->
    <div class="row align-items-center mb-5" data-aos="fade-down">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold text-primary">Halo, <?= explode(' ', $profil['nama_peserta'])[0] ?>! 👋</h1>
            <p class="lead text-muted">Selamat datang di Dashboard Siswa Permata Klepu.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="../logout_siswa.php" class="btn btn-danger rounded-pill px-4">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Status Card -->
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius: 20px;">
                <div class="card-body p-4 text-center position-relative">
                    <div
                        style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: var(--secondary); border-radius: 50%; opacity: 0.5;">
                    </div>

                    <h5 class="text-muted mb-3">Status Kelulusan</h5>
                    <?php if ($profil['status'] == 'Lulus'): ?>
                        <div class="display-1 text-success mb-2"><i class="fas fa-check-circle"></i></div>
                        <h3 class="fw-bold text-success">LULUS</h3>
                        <p class="text-small text-muted mt-2">Selamat atas pencapaian Anda!</p>
                    <?php else: ?>
                        <div class="display-1 text-warning mb-2"><i class="fas fa-hourglass-half"></i></div>
                        <h3 class="fw-bold text-warning">BELUM LULUS</h3>
                        <p class="text-small text-muted mt-2">Terus semangat belajar!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Grade & Diploma Card -->
        <div class="col-md-8" data-aos="fade-up" data-aos-delay="200">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px;">
                <div class="card-header bg-white border-0 py-3 px-4">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-award text-primary me-2"></i> Akademik</h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="text-muted small">Program Kelas</label>
                            <h4 class="fw-bold"><?= $profil['kelas'] ?></h4>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <label class="text-muted small">Nilai Akhir</label>
                            <h2 class="display-4 fw-bold text-primary"><?= $profil['nilai_akhir'] ?></h2>
                        </div>
                    </div>

                    <hr class="my-4" style="border-color: #f1f5f9;">

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0 fw-bold">Ijazah Digital</p>
                            <small class="text-muted">Download dokumen kelulusan resmi</small>
                        </div>
                        <?php if ($profil['status'] == 'Lulus' && !empty($profil['link_ijazah'])): ?>
                            <a href="<?= $profil['link_ijazah'] ?>" target="_blank"
                                class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-download me-2"></i> Download
                            </a>
                        <?php else: ?>
                            <button class="btn btn-light rounded-pill px-4 text-muted" disabled>
                                <i class="fas fa-lock me-2"></i> Belum Tersedia
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance History -->
        <div class="col-12" data-aos="fade-up" data-aos-delay="300">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-history text-primary me-2"></i> Riwayat Presensi Terbaru
                    </h5>
                    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Tanggal & Waktu</th>
                                <th>Program</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($query_presensi) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($query_presensi)): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold"><?= date('d M Y', strtotime($row['tanggal'])) ?></div>
                                            <small class="text-muted"><?= date('H:i', strtotime($row['tanggal'])) ?> WIB</small>
                                        </td>
                                        <td><?= $row['program'] ?></td>
                                        <td><span class="badge bg-success rounded-pill px-3">Hadir</span></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">Belum ada data presensi.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layout/footer.php'; ?>