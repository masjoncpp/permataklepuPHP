<?php
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_start();
include 'config/koneksi.php';

if (isset($_SESSION['siswa_login'])) {
    header("Location: nilai_ijazah.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($koneksi, "SELECT * FROM nilai WHERE username=? OR nama_peserta=?");
    mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['siswa_login'] = true;
            $_SESSION['siswa_id'] = $row['id'];
            $_SESSION['siswa_nama'] = $row['nama_peserta'];
            header("Location: nilai_ijazah.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username atau Nama tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - Permata Klepu</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/admin.css"> <!-- Menggunakan style admin untuk form login -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="login-body">
    <div class="login-bg-animation">
        <div class="gradient-orb orb-1"></div>
        <div class="gradient-orb orb-2"></div>
        <div class="gradient-orb orb-3"></div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-wrapper">
                    <img src="assets/img/permata-min.jpg" alt="Logo Permata Klepu">
                </div>
                <h3>Login Siswa</h3>
                <p class="subtitle">Masuk untuk melihat nilai dan ijazah</p>
            </div>

            <?php if (isset($error)): ?>
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?= $error ?></span>
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="login-form">
                <div class="input-group">
                    <label for="username">
                        <i class="fas fa-user"></i>
                        Username / Nama Peserta
                    </label>
                    <input type="text" id="username" name="username" placeholder="Masukkan Username atau Nama Lengkap"
                        required autofocus>
                </div>

                <div class="input-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Password
                    </label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" name="login" class="btn-login">
                    <span>Masuk</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="login-footer">
                <a href="index.php" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>

</html>