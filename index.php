<?php
include 'config/koneksi.php';
include 'layout/header.php';
?>

<section class="hero" id="home">
  <div class="container hero-content" data-aos="fade-up">
    <div class="hero-text">
      <h1 class="gradient-text">Permata Klepu</h1>
      <h2>Perempuan Mandiri & Tangguh Desa Klepu</h2>
      <p>
        Memberdayakan perempuan melalui pendidikan dan keterampilan di
        Desa Klepu, Kecamatan Pringapus, Kabupaten Semarang, Jawa Tengah.
      </p>
      <div class="hero-buttons">
        <a href="#attendance" class="btn btn-primary">
          <i class="fas fa-user-check"></i> Presensi Sekarang
        </a>
        <a href="#classes" class="btn btn-outline">
          <i class="fas fa-book-open"></i> Lihat Program
        </a>
      </div>
      <div class="hero-stats">
        <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
          <div class="stat-number" data-target="75">0</div>
          <div class="stat-label">Peserta Aktif</div>
        </div>
        <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
          <div class="stat-number" data-target="3">0</div>
          <div class="stat-label">Kelas Rombel</div>
        </div>
        <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
          <div class="stat-number" data-target="95">0</div>
          <div class="stat-label">Tingkat Keberhasilan</div>
        </div>
      </div>
    </div>
    <div class="hero-image" data-aos="fade-left" data-aos-delay="200">
      <img src="<?= BASE_URL ?>assets/img/permata-min.png" alt="Program Permata Klepu" loading="lazy" />
    </div>
  </div>
</section>

<section class="profile-section" id="profile">
  <div class="container">
    <h2 class="section-title" data-aos="fade-up">Profil Desa Klepu</h2>
    <div class="profile-grid">
      <div class="card profile-card" data-aos="fade-up" data-aos-delay="100">
        <h3><i class="fas fa-map-marker-alt"></i> Tentang Desa</h3>
        <p>Desa Klepu merupakan sebuah desa di Kecamatan Pringapus, Kabupaten Semarang, Jawa Tengah. Desa ini memiliki
          potensi besar dalam pemberdayaan masyarakat, khususnya perempuan.</p>
        <ul>
          <li><i class="fas fa-check-circle"></i> 6 Dusun Utama</li>
          <li><i class="fas fa-check-circle"></i> Masing-masing 1 RW per Dusun</li>
          <li><i class="fas fa-check-circle"></i> Komunitas yang Aktif</li>
        </ul>
      </div>
      <div class="card profile-card" data-aos="fade-up" data-aos-delay="200">
        <h3><i class="fas fa-home"></i> Dusun di Desa Klepu</h3>
        <ul>
          <li><i class="fas fa-map-pin"></i> Dusun Krajan</li>
          <li><i class="fas fa-map-pin"></i> Dusun Macanmati</li>
          <li><i class="fas fa-map-pin"></i> Dusun Bodean</li>
          <li><i class="fas fa-map-pin"></i> Dusun Duwet</li>
          <li><i class="fas fa-map-pin"></i> Dusun Kemasan</li>
          <li><i class="fas fa-map-pin"></i> Dusun Kaliulo</li>
        </ul>
      </div>
      <div class="card profile-card" data-aos="fade-up" data-aos-delay="400">
        <h3><i class="fas fa-star"></i> Produk Unggulan</h3>
        <div class="feature-item">
          <div class="feature-icon"><i class="fas fa-leaf"></i></div>
          <div>
            <h4>Pertanian Organik</h4>
            <p>Pengembangan pertanian organik dengan berbagai jenis sayuran dan buah-buahan.</p>
          </div>
        </div>
        <div class="feature-item">
          <div class="feature-icon"><i class="fas fa-palette"></i></div>
          <div>
            <h4>Kerajinan Tangan</h4>
            <p>Produksi kerajinan tangan dari bahan daur ulang yang ramah lingkungan.</p>
          </div>
        </div>
        <div class="feature-item">
          <div class="feature-icon"><i class="fas fa-utensils"></i></div>
          <div>
            <h4>Kuliner Lokal</h4>
            <p>Pengembangan kuliner lokal dengan bahan-bahan dari hasil pertanian desa.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="classes" class="classes-section">
  <div class="container">
    <h2 class="section-title" data-aos="fade-up">Program Kelas</h2>
    <div class="classes-grid">

      <?php
      // Query mengambil data kelas
      $query_kelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY id ASC");

      while ($row = mysqli_fetch_assoc($query_kelas)) {
        // Logika Gambar
        $path_upload = "assets/uploads/" . $row['gambar'];
        $gambar = BASE_URL . "assets/img/" . $row['gambar'];

        if (file_exists($path_upload) && !empty($row['gambar'])) {
          $gambar = BASE_URL . "assets/uploads/" . $row['gambar'];
        }
        ?>

        <div class="card class-card" data-aos="fade-up">
          <img src="<?= $gambar ?>" alt="<?= $row['nama_kelas'] ?>" loading="lazy" />
          <div class="class-content">
            <h3><?= $row['nama_kelas'] ?></h3>
            <p><?= $row['deskripsi'] ?></p>

            <ul>
              <?php if ($row['nama_kelas'] == 'Ibu Cakap Usaha'): ?>
                <li><i class="fas fa-check"></i> Pengelolaan Manajemen dan Keuangan Usaha</li>
                <li><i class="fas fa-check"></i> Penguatan Potensi melalui pembuatan produk olahan lokal</li>
                <li><i class="fas fa-check"></i> Digital marketing meliputi pelatihan foto produk</li>
              <?php elseif ($row['nama_kelas'] == 'Ibu Rawat Bumi'): ?>
                <li><i class="fas fa-check"></i> Pengenalan jenis dan pengelolaan sampah rumah tangga</li>
                <li><i class="fas fa-check"></i> Inovasi daur ulang sampah anorganik bernilai ekonomis</li>
                <li><i class="fas fa-check"></i> Inovasi daur ulang sampah organik menjadi kompos</li>
              <?php elseif ($row['nama_kelas'] == 'Ibu Sejahtera'): ?>
                <li><i class="fas fa-check"></i> Manajemen keluarga sejahtera</li>
                <li><i class="fas fa-check"></i> Parenting menuju anak berkarakter</li>
              <?php endif; ?>
            </ul>
          </div>
        </div>

      <?php } ?>

    </div>
  </div>
</section>

<section class="results-section" id="results">
  <div class="container">
    <h2 class="section-title" data-aos="fade-up">Hasil Capaian Program</h2>
    <div class="chart-controls" data-aos="fade-up">
      <button class="chart-type-btn active" data-type="bar"><i class="fas fa-chart-bar"></i> Bar</button>
      <button class="chart-type-btn" data-type="line"><i class="fas fa-chart-line"></i> Line</button>
      <button class="chart-type-btn" data-type="pie"><i class="fas fa-chart-pie"></i> Pie</button>
    </div>
    <div class="chart-container" data-aos="fade-up" data-aos-delay="100">
      <canvas id="newMainChart"></canvas>
    </div>
    <div class="summary-cards" data-aos="fade-up" data-aos-delay="200">
      <div class="card summary-card cakap">
        <h4><i class="fas fa-money-bill"></i> Ibu Cakap Usaha</h4>
        <div class="metric"><span>Pre Test</span><span class="metric-value metric-pre">60.5</span></div>
        <div class="metric"><span>Post Test</span><span class="metric-value metric-post">95.0</span></div>
        <div class="metric"><span>Peningkatan</span><span class="metric-value metric-improvement">+34.5</span></div>
      </div>
      <div class="card summary-card bumi">
        <h4><i class="fas fa-seedling"></i> Ibu Rawat Bumi</h4>
        <div class="metric"><span>Pre Test</span><span class="metric-value metric-pre">55.5</span></div>
        <div class="metric"><span>Post Test</span><span class="metric-value metric-post">92.5</span></div>
        <div class="metric"><span>Peningkatan</span><span class="metric-value metric-improvement">+37.0</span></div>
      </div>
      <div class="card summary-card sejahtera">
        <h4><i class="fas fa-heart"></i> Ibu Sejahtera</h4>
        <div class="metric"><span>Pre Test</span><span class="metric-value metric-pre">65.0</span></div>
        <div class="metric"><span>Post Test</span><span class="metric-value metric-post">95.0</span></div>
        <div class="metric"><span>Peningkatan</span><span class="metric-value metric-improvement">+35.0</span></div>
      </div>
    </div>
  </div>
</section>

<section class="literacy-section" id="literacy">
  <div class="container">
    <h2 class="section-title" data-aos="fade-up">Literasi</h2>
    <div class="literacy-grid">

      <?php
      // Query Artikel Dinamis
      $query_artikel = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY tanggal DESC LIMIT 6");
      while ($row = mysqli_fetch_assoc($query_artikel)) {
        // Logika Gambar (Upload vs Asset)
        $path_upload = "assets/uploads/" . $row['gambar'];
        $gambar = BASE_URL . "assets/img/" . $row['gambar']; // Default asset
      
        if (file_exists($path_upload) && !empty($row['gambar'])) {
          $gambar = BASE_URL . "assets/uploads/" . $row['gambar'];
        }
        ?>

        <div class="card literacy-card" data-aos="fade-up" data-aos-delay="100">
          <img src="<?= $gambar ?>" alt="<?= $row['judul'] ?>" loading="lazy" />
          <div class="literacy-content">
            <span class="literacy-category"><?= $row['kategori'] ?></span>
            <h3><?= $row['judul'] ?></h3>
            <p><?= substr(strip_tags($row['isi']), 0, 100) ?>...</p>
            <div class="literacy-meta">
              <span class="literacy-date"><i class="fas fa-calendar"></i>
                <?= date('d M Y', strtotime($row['tanggal'])) ?></span>
              <a href="<?= $row['link_drive'] ?>" target="_blank" class="literacy-link">Baca Selengkapnya <i
                  class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

      <?php } ?>

    </div>
  </div>
</section>

<section class="gallery-section" id="gallery">
  <div class="container">
    <h2 class="section-title" data-aos="fade-up">Galeri Kegiatan</h2>
    <div class="gallery-grid">

      <?php
      // Query Galeri Dinamis
      $query_galeri = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY tanggal DESC");
      while ($foto = mysqli_fetch_assoc($query_galeri)) {
        $path_upload = "assets/uploads/" . $foto['gambar'];
        $img_src = BASE_URL . "assets/img/" . $foto['gambar'];

        if (file_exists($path_upload) && !empty($foto['gambar'])) {
          $img_src = BASE_URL . "assets/uploads/" . $foto['gambar'];
        }
        ?>

        <div class="gallery-item" data-aos="fade-up" data-aos-delay="100">
          <img src="<?= $img_src ?>" alt="<?= $foto['judul'] ?>" loading="lazy" />
          <div class="gallery-overlay">
            <i class="fas fa-search-plus"></i>
          </div>
        </div>

      <?php } ?>

    </div>
  </div>
</section>

<!-- SECTION VIDEO PROFIL -->
<section id="video-profil" class="video-section">
  <div class="container">
    <h2 class="section-title" data-aos="fade-up">Video Profil</h2>
    <div class="video-wrapper" data-aos="zoom-in">
      <iframe src="https://www.youtube.com/embed/qtVLqz-LZKE?si=-RN1sL0IHfSAB4Z7" title="YouTube video player"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
      </iframe>
    </div>
  </div>
</section>

<section class="attendance-section" id="attendance">
  <div class="container">
    <h2 class="section-title" data-aos="fade-up">Presensi Kehadiran</h2>
    <div class="attendance-container">
      <div class="card attendance-form" data-aos="fade-right">
        <h3><i class="fas fa-user-check"></i> Form Presensi</h3>

        <?php
        $q_status = mysqli_query($koneksi, "SELECT nilai FROM pengaturan WHERE kunci='presensi_status'");
        $d_status = mysqli_fetch_array($q_status);
        $status_presensi = $d_status['nilai'] ?? 'tutup';

        if ($status_presensi == 'buka') {
          ?>
          <p class="form-description">
            Silahkan isi form presensi kehadiran Anda pada program yang diikuti.
          </p>
          <form id="attendanceForm" novalidate>
          <?php } else { ?>
            <div style="text-align: center; padding: 2rem 0; color: #64748b;">
              <i class="fas fa-lock" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
              <h4 style="color: #475569;">Form Presensi Ditutup</h4>
              <p>Mohon maaf, presensi saat ini sedang tidak menerima tanggapan.</p>
            </div>
            <form id="attendanceForm" novalidate style="display:none;">
            <?php } ?>
            <div class="form-group">
              <label for="name">Nama Lengkap <span class="required">*</span></label>
              <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama lengkap"
                required />
              <span class="form-error" id="nameError"></span>
            </div>
            <div class="form-group">
              <label for="address">Alamat<span class="required">*</span></label>
              <textarea id="address" name="address" class="form-control" rows="3" placeholder="Masukkan alamat"
                required></textarea>
              <span class="form-error" id="addressError"></span>
            </div>
            <div class="form-group">
              <label>Program Kelas <span class="required">*</span></label>
              <div class="program-options">
                <div class="program-option">
                  <input type="radio" id="cakap" name="program" value="Ibu Cakap Usaha" required />
                  <label for="cakap" class="program-label">
                    <div class="program-icon"><i class="fas fa-money-bill"></i></div>
                    <div class="program-info">
                      <h4>Ibu Cakap Usaha</h4>
                      <p>Kewirausahaan & Literasi Keuangan</p>
                    </div>
                  </label>
                </div>
                <div class="program-option">
                  <input type="radio" id="rawat" name="program" value="Ibu Rawat Bumi" required />
                  <label for="rawat" class="program-label">
                    <div class="program-icon"><i class="fas fa-seedling"></i></div>
                    <div class="program-info">
                      <h4>Ibu Rawat Bumi</h4>
                      <p>Pengelolaan Lingkungan & Pertanian</p>
                    </div>
                  </label>
                </div>
                <div class="program-option">
                  <input type="radio" id="sejahtera" name="program" value="Ibu Sejahtera" required />
                  <label for="sejahtera" class="program-label">
                    <div class="program-icon"><i class="fas fa-heart"></i></div>
                    <div class="program-info">
                      <h4>Ibu Sejahtera</h4>
                      <p>Kesehatan & Kesejahteraan Keluarga</p>
                    </div>
                  </label>
                </div>
              </div>
              <span class="form-error" id="programError"></span>
            </div>
            <button type="submit" class="btn btn-primary btn-block">
              <i class="fas fa-check-circle"></i> Submit Presensi
            </button>
            <?php if ($status_presensi == 'buka') { ?>
            </form>
          <?php } else { ?>
          </form>
        <?php } ?>
      </div>
      <div class="card location-map" data-aos="fade-left">
        <h3><i class="fas fa-map-marked-alt"></i> Info Lebih Lanjut</h3>
        <div class="map-container">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15835.234567!2d110.4605!3d-7.1814!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708c6c1c1c1c1c%3A0x1c1c1c1c1c1c1c1c!2sKlepu%2C%20Pringapus%2C%20Semarang%20Regency%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1696288400000!5m2!1sen!2sid"
            width="100%" height="350" style="border: 0" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="location-info">
          <div class="location-item">
            <div class="location-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div>
              <h4>Alamat</h4>
              <p>Desa Klepu, Kecamatan Pringapus<br />Kabupaten Semarang, Jawa Tengah</p>
            </div>
          </div>
          <div class="location-item">
            <div class="location-icon"><i class="fas fa-envelope"></i></div>
            <div>
              <h4>Email</h4>
              <p><a href="mailto:ppkokamadiksi25@gmail.com">ppkokamadiksi25@gmail.com</a></p>
            </div>
          </div>
          <div class="location-item">
            <div class="location-icon"><i class="fas fa-phone"></i></div>
            <div>
              <h4>Telepon</h4>
              <p><a href="https://wa.me/6285179663623">+62 851-7966-3623</a></p>
            </div>
          </div>
          <div class="location-item">
            <div class="location-icon"><i class="fas fa-clock"></i></div>
            <div>
              <h4>Waktu Pelaksanaan</h4>
              <p>Jumat - Minggu</p>
            </div>
          </div>

          <div class="location-item">
            <div class="location-icon"><i class="fab fa-instagram"></i></div>
            <div>
              <h4>Instagram</h4>
              <p><a href="https://www.instagram.com/ppko_kamadiksiudinus/" target="_blank">@ppko_kamadiksiudinus</a></p>
            </div>
          </div>

          <div class="location-item">
            <div class="location-icon"><i class="fab fa-youtube"></i></div>
            <div>
              <h4>YouTube</h4>
              <p><a href="https://youtube.com/@kamadiksiudinus?si=KQBajDhMXuITIGbV" target="_blank">Kamadiksi KIP
                  Udinus</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION MITRA KAMI -->
<section class="partners-section" id="partners">
  <div class="container">
    <h2 class="section-title" data-aos="fade-up">Mitra Kami</h2>
    <div class="partners-slider" data-aos="fade-up" data-aos-delay="100">
      <div class="partners-track">
        <!-- Original Logos -->
        <div class="partner-slide"><img src="assets/img/DLH.jpeg" alt="Dinas Lingkungan Hidup Kabupaten Semarang"></div>
        <div class="partner-slide"><img src="assets/img/disdikbudpora.png" alt="Dinas Pendidikan Kabupaten Semarang">
        </div>
        <div class="partner-slide"><img src="assets/img/diskumperindag.jpeg"
            alt="Dinas Kumpulan Pemerintah Daerah Kabupaten Semarang"></div>
        <div class="partner-slide"><img src="assets/img/cimory.png" alt="PT. Macroprima Panganutama"></div>
        <div class="partner-slide"><img src="" alt="Mitra 5"></div>
        <div class="partner-slide"><img src="" alt="Mitra 6"></div>
        <div class="partner-slide"><img src="" alt="Mitra 7"></div>

        <!-- Duplicate Logos for Infinite Scroll -->
        <div class="partner-slide"><img src="assets/img/DLH.jpeg" alt="Dinas Lingkungan Hidup Kabupaten Semarang"></div>
        <div class="partner-slide"><img src="assets/img/disdikbudpora.png" alt="Dinas Pendidikan Kabupaten Semarang">
        </div>
        <div class="partner-slide"><img src="assets/img/diskumperindag.jpeg"
            alt="Dinas Kumpulan Pemerintah Daerah Kabupaten Semarang"></div>
        <div class="partner-slide"><img src="assets/img/cimory.png" alt="PT. Macroprima Panganutama"></div>
        <div class="partner-slide"><img src="" alt="Mitra 5"></div>
        <div class="partner-slide"><img src="" alt="Mitra 6"></div>
        <div class="partner-slide"><img src="" alt="Mitra 7"></div>
      </div>
    </div>
  </div>
</section>

<?php include 'layout/footer.php'; ?>