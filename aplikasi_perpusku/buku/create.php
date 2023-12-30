<?php
include('../header.php');
include('../footer.php');

session_start();
require_once("../config.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun_terbit = $_POST['tahun_terbit'];

    $query  = "INSERT INTO buku (judul, penulis, tahun_terbit) VALUES ('$judul', '$penulis', '$tahun_terbit')";
    $result = $conn->query($query);

    if ($result) {
        $new_id = $conn->insert_id;
        echo "Data berhasil ditambahkan. ID baru: $new_id";
    } else {
        echo "Gagal menambahkan data: " . $conn->error;
    }

    header("Location: buku.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Buku</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="judul">Judul:</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul" required>
            </div>
            <div class="form-group">
                <label for="penulis">Penulis:</label>
                <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Masukkan Nama penulis" required>
            </div>
            <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit:</label>
                <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" placeholder="Masukkan tahun terbit" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="buku.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
