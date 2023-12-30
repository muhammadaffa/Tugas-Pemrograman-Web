<?php
session_start();
require_once("config.php");


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

//session timeout
if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > $session_timeout)) {
    session_unset();
    session_destroy();
    header("Location: login.php?timeout=true");
    exit();
} else {
    $_SESSION['login_time'] = time();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpusku App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('header.php');?>
    <div class="container mt-5">
        <div class="jumbotron text-center">
            <h2 class="display-4">Selamat Datang, <?php echo $_SESSION['username']; ?>!</h2>
            <p class="lead">Anda telah berhasil login. Nikmati pengalaman menggunakan aplikasi Perpusku.</p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manajemen buku</h5>
                        <p class="card-text">Kelola dan tambahkan buku baru ke dalam buku.</p>
                        <a href="buku/buku.php" class="btn btn-primary">Ke Manajemen buku</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Peminjaman</h5>
                        <p class="card-text">Lihat dan kelola daftar peminjaman buku.</p>
                        <a href="peminjaman/peminjaman.php" class="btn btn-primary">Ke Peminjaman</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Logout</h5>
                        <p class="card-text">Keluar dari akun Anda.</p>
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php');?>
</body>
</html>
