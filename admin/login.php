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
include '../config/koneksi.php';

// Jika sudah login, lempar ke dashboard
if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    header("Location: " . BASE_URL . "admin/index.php");
    exit;
}

// Proses Login saat tombol ditekan
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Cek database
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM admin WHERE username=? AND password=?");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // Set Session
        $_SESSION['username'] = $username;
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        $_SESSION['status'] = "login";

        header("Location: " . BASE_URL . "admin/index.php");
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Permata Klepu</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="login-body">
    <!-- Animated Background -->
    <div class="login-bg-animation">
        <div class="gradient-orb orb-1"></div>
        <div class="gradient-orb orb-2"></div>
        <div class="gradient-orb orb-3"></div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-wrapper">
                    <img src="../assets/img/permata-min.jpg" alt="Logo Permata Klepu">
                </div>
                <h3>Admin Dashboard</h3>
                <p class="subtitle">Masuk untuk mengelola website</p>
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
                        Username
                    </label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required
                        autofocus>
                </div>

                <div class="input-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Password
                    </label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
                </div>

                <button type="submit" name="login" class="btn-login">
                    <span>Masuk Dashboard</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="login-footer">
                <a href="../index.php" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Website
                </a>
            </div>
        </div>
    </div>

</body>

</html>