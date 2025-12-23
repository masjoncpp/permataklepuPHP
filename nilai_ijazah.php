<?php
session_start();
include 'config/koneksi.php';

// Cek apakah sudah login sebagai siswa
if (!isset($_SESSION['siswa_login']) || $_SESSION['siswa_login'] !== true) {
  header("Location: login_siswa.php");
  exit;
}

include 'layout/header.php';

$id_siswa = $_SESSION['siswa_id'];
$query = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id = '$id_siswa'");
$data = mysqli_fetch_assoc($query);

// Tentukan warna status
$statusClass = ($data['status'] == 'Lulus') ? 'status-lulus' : 'status-belum-lulus';
?>

<section class="certificates-section" id="certificates">
  <div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
      <h2 class="section-title" data-aos="fade-up" style="margin-bottom: 0;">Nilai & Ijazah Saya</h2>
      <a href="logout_siswa.php" class="btn-logout"
        style="background-color: #ef4444; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; font-weight: bold;">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </div>

    <div class="certificates-container" data-aos="fade-up" data-aos-delay="200">
      <div class="card"
        style="padding: 2rem; max-width: 800px; margin: 0 auto; background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div class="text-center mb-4">
          <h3 style="color: #4b5563; margin-bottom: 0.5rem;">Hasil Studi Anda</h3>
          <p style="color: #6b7280;">Sekolah Permata Klepu</p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem;">
          <div>
            <label style="display: block; color: #6b7280; font-size: 0.875rem; margin-bottom: 0.25rem;">Nama
              Peserta</label>
            <div style="font-size: 1.125rem; font-weight: 600; color: #1f2937;"><?= $data['nama_peserta'] ?></div>
          </div>
          <div>
            <label style="display: block; color: #6b7280; font-size: 0.875rem; margin-bottom: 0.25rem;">Program
              Kelas</label>
            <div style="font-size: 1.125rem; font-weight: 600; color: #1f2937;"><?= $data['kelas'] ?></div>
          </div>
          <div>
            <label style="display: block; color: #6b7280; font-size: 0.875rem; margin-bottom: 0.25rem;">Nilai
              Akhir</label>
            <div style="font-size: 2rem; font-weight: 700; color: #8b5cf6;"><?= $data['nilai_akhir'] ?></div>
          </div>
          <div>
            <label style="display: block; color: #6b7280; font-size: 0.875rem; margin-bottom: 0.25rem;">Status
              Kelulusan</label>
            <div class="<?= $statusClass ?>"
              style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 600; font-size: 0.875rem; color:white; margin-top:0.5rem;">
              <?= $data['status'] ?>
            </div>
          </div>
        </div>

        <?php if ($data['status'] == 'Lulus' && !empty($data['link_ijazah'])): ?>
          <div style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e5e7eb;">
            <p style="margin-bottom: 1rem; color: #4b5563;">Selamat! Anda dapat mengunduh ijazah Anda melalui tombol di
              bawah ini.</p>
            <a href="<?= $data['link_ijazah'] ?>" target="_blank" class="btn-download"
              style="display: inline-flex; align-items: center; gap: 0.5rem; background: #8b5cf6; color: white; padding: 0.75rem 2rem; border-radius: 0.5rem; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
              <i class="fas fa-download"></i>
              Download Ijazah
            </a>
          </div>
        <?php elseif ($data['status'] == 'Lulus'): ?>
          <div style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e5e7eb;">
            <p
              style="color: #d97706; background: #fffbeb; padding: 1rem; border-radius: 0.5rem; border: 1px solid #fcd34d;">
              <i class="fas fa-info-circle"></i> Ijazah Anda sedang dalam proses penerbitan. Silakan cek kembali secara
              berkala.
            </p>
          </div>
        <?php else: ?>
          <div style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e5e7eb;">
            <p
              style="color: #dc2626; background: #fef2f2; padding: 1rem; border-radius: 0.5rem; border: 1px solid #fca5a5;">
              Mohon maaf, Anda dinyatakan belum lulus program ini. Tetap semangat!
            </p>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</section>

<?php include 'layout/footer.php'; ?>