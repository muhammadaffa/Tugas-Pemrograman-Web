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
    $id_buku = $_POST['id_buku'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $query = "INSERT INTO peminjaman (id_buku, nama, alamat, no_telepon, tanggal_pinjam, tanggal_kembali) 
              VALUES ('$id_buku', '$nama', '$alamat', '$no_telepon', '$tanggal_pinjam', '$tanggal_kembali')";
    $conn->query($query);

    header("Location: peminjaman.php");
    exit();
}


$queryBuku = "SELECT id, judul FROM buku";
$resultBuku = $conn->query($queryBuku);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Peminjaman</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="id_buku">Buku:</label>
                <select class="form-control" id="id_buku" name="id_buku" required>
                    <?php
                    while ($rowBuku = $resultBuku->fetch_assoc()) {
                        echo "<option value='" . $rowBuku['id'] . "'>" . $rowBuku['judul'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama">Nama Peminjam:</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Peminjam" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>
            </div>
            <div class="form-group">
                <label for="no_telepon">No. Telepon:</label>
                <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="Masukkan Nomor Telepon" required>
            </div>
            <div class="form-group">
                <label for="tanggal_pinjam">Tanggal Pinjam:</label>
                <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
            </div>
            <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali:</label>
                <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="peminjaman.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
