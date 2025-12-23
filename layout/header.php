<?php
// layout/header.php
if (!defined('BASE_URL')) {
  include_once(__DIR__ . '/../config/koneksi.php');
}
// Helper untuk menandai menu aktif
$page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- =======================
         SEO META TAGS
    ======================== -->
  <title>PPKO KAMADIKSI UDINUS – Sekolah Perempuan Desa Klepu</title>
  <meta name="description"
    content="Program PPK Ormawa KAMADIKSI UDINUS: Sekolah Perempuan Desa Klepu. Pemberdayaan perempuan melalui pendidikan, keterampilan, dan literasi." />
  <meta name="robots" content="index,follow" />
  <meta name="author" content="PPKO KAMADIKSI UDINUS" />
  <meta name="theme-color" content="#6d28d9" />

  <!-- Canonical URL -->
  <link rel="canonical" href="https://permataklepu.com/" />

  <!-- Open Graph / Facebook -->
  <meta property="og:locale" content="id_ID" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Sekolah Perempuan Permata Klepu – PPKO KAMADIKSI UDINUS" />
  <meta property="og:description"
    content="Pemberdayaan perempuan Desa Klepu: Ibu Cakap Usaha, Ibu Rawat Bumi, dan Ibu Sejahtera." />
  <meta property="og:url" content="https://permataklepu.com/" />
  <meta property="og:site_name" content="PPK ORMAWA KAMADIKSI UDINUS" />
  <meta property="og:image" content="<?= BASE_URL ?>assets/img/permata-min.png" />
  <meta property="og:image:alt" content="Logo Permata Klepu" />

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Sekolah Perempuan Permata Klepu – PPKO KAMADIKSI UDINUS" />
  <meta name="twitter:description" content="Memberdayakan perempuan Desa Klepu melalui pendidikan & keterampilan." />
  <meta name="twitter:image" content="<?= BASE_URL ?>assets/img/permata-min.png" />

  <!-- =======================
         FAVICONS & MANIFEST
    ======================== -->
  <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>assets/img/favicon-32.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="<?= BASE_URL ?>assets/img/favicon-180.png" />
  <link rel="manifest" href="site.webmanifest" />

  <!-- =======================
         FONTS & STYLES
    ======================== -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=REM:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet" />

  <!-- Libraries -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="print"
    onload="this.media='all'" />
  <noscript>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  </noscript>

  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" media="print" onload="this.media='all'" />
  <noscript>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
  </noscript>

  <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css" />

  <!-- =======================
         SCHEMA MARKUP (JSON-LD)
    ======================== -->
  <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@graph": [
          {
            "@type": "Organization",
            "name": "PPK Ormawa KAMADIKSI UDINUS",
            "url": "https://permataklepu.com",
            "logo": "https://permataklepu.com/img/logo-512.png",
            "sameAs": [
              "https://www.instagram.com/ppko_kamadiksiudinus/",
              "https://www.youtube.com/@KamadiksiKIPUdinus"
            ]
          },
          {
            "@type": "WebSite",
            "name": "Sekolah Perempuan Permata Klepu",
            "url": "https://permataklepu.com/",
            "inLanguage": "id-ID",
            "potentialAction": {
              "@type": "SearchAction",
              "target": "https://permataklepu.com/?q={search_term_string}",
              "query-input": "required name=search_term_string"
            }
          }
        ]
      }
    </script>
</head>

<body>
  <button class="scroll-to-top" id="scrollToTop"><i class="fas fa-arrow-up"></i></button>

  <header>
    <div class="container header-container">
      <div class="logo-container">
        <div class="logo-group">
          <div class="logo-circle"><img src="<?= BASE_URL ?>assets/img/LogoUdinus-min.png" alt="Logo"></div>
          <div class="logo-circle"><img src="<?= BASE_URL ?>assets/img/desa-min.jpg" alt="Logo"></div>
          <div class="logo-circle"><img src="<?= BASE_URL ?>assets/img/kamadiksi-min.jpg" alt="Logo"></div>
          <div class="logo-circle"><img src="<?= BASE_URL ?>assets/img/permata-min.jpg" alt="Logo"></div>
        </div>
      </div>
      <nav class="desktop-nav">
        <a href="<?= BASE_URL ?>index.php#home" class="nav-link">Beranda</a>
        <a href="<?= BASE_URL ?>index.php#profile" class="nav-link">Profil</a>
        <a href="<?= BASE_URL ?>index.php#classes" class="nav-link">Kelas</a>
        <a href="<?= BASE_URL ?>index.php#results" class="nav-link">Hasil</a>
        <a href="<?= BASE_URL ?>index.php#literacy" class="nav-link">Literasi</a>
        <a href="<?= BASE_URL ?>index.php#gallery" class="nav-link">Galeri</a>
        <a href="<?= BASE_URL ?>nilai_ijazah.php"
          class="nav-link <?= ($page == 'nilai_ijazah.php') ? 'active' : '' ?>">Nilai & Ijazah</a>
        <a href="<?= BASE_URL ?>index.php#attendance" class="nav-link">Presensi</a>
      </nav>
    </div>
  </header>
  <main>