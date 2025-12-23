</main>
<footer>
  <div class="container">
    <div class="footer-content">
      <div class="footer-logo">
        <h3>Permata Klepu</h3>
        <p>Bersinar dari desa, berdampak untuk bangsa!</p>
      </div>
      <div class="footer-links">
        <div class="footer-column">
          <h4>Navigasi</h4>
          <ul>
            <li><a href="<?= BASE_URL ?>index.php#home">Beranda</a></li>
            <li><a href="<?= BASE_URL ?>index.php#profile">Profil</a></li>
            <li><a href="<?= BASE_URL ?>index.php#classes">Kelas</a></li>
            <li><a href="<?= BASE_URL ?>index.php#results">Hasil</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h4>Program</h4>
          <ul>
            <li><a href="<?= BASE_URL ?>index.php#classes">Ibu Cakap Usaha</a></li>
            <li><a href="<?= BASE_URL ?>index.php#classes">Ibu Rawat Bumi</a></li>
            <li><a href="<?= BASE_URL ?>index.php#classes">Ibu Sejahtera</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h4>Informasi</h4>
          <ul>
            <li><a href="<?= BASE_URL ?>index.php#literacy">Literasi</a></li>
            <li><a href="<?= BASE_URL ?>index.php#gallery">Galeri</a></li>
            <li><a href="<?= BASE_URL ?>nilai_ijazah.php">Nilai & Ijazah</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p class="copyright-desktop">© 2025 PPK Ormawa Kamadiksi UDINUS. Hak Cipta Dilindungi.</p>
      <p class="copyright-mobile">© 2025 PPK Ormawa Kamadiksi UDINUS. Hak Cipta Dilindungi.</p>
    </div>
  </div>
</footer>

<nav class="mobile-bottom-nav">
  <ul class="mobile-nav-list">
    <li class="mobile-nav-item">
      <a href="<?= BASE_URL ?>index.php#home" class="mobile-nav-link">
        <i class="fas fa-home"></i><span>Beranda</span>
      </a>
    </li>
    <li class="mobile-nav-item">
      <a href="<?= BASE_URL ?>index.php#classes" class="mobile-nav-link">
        <i class="fas fa-book-open"></i><span>Kelas</span>
      </a>
    </li>
    <li class="mobile-nav-item center-nav">
      <a href="<?= BASE_URL ?>index.php#attendance" class="mobile-nav-link">
        <div class="center-button"><i class="fas fa-user-check"></i></div>
        <span>Presensi</span>
      </a>
    </li>
    <li class="mobile-nav-item">
      <a href="<?= BASE_URL ?>index.php#gallery" class="mobile-nav-link">
        <i class="fas fa-images"></i><span>Galeri</span>
      </a>
    </li>
    <?php $page = basename($_SERVER['PHP_SELF']); ?>
    <li class="mobile-nav-item">
      <a href="<?= BASE_URL ?>nilai_ijazah.php"
        class="mobile-nav-link <?= ($page == 'nilai_ijazah.php') ? 'active' : '' ?>">
        <i class="fas fa-file-alt"></i><span>Nilai</span>
      </a>
    </li>
  </ul>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="<?= BASE_URL ?>assets/js/script.js"></script>
<script src="<?= BASE_URL ?>assets/js/register-sw.js"></script>
</body>

</html>