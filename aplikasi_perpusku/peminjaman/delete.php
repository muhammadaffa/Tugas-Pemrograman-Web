<?php
session_start();
require_once("../config.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data yang akan dihapus
$queryPeminjaman = "SELECT peminjaman.id, peminjaman.nama, peminjaman.alamat, peminjaman.no_telepon, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali, buku.judul as nama_buku 
                    FROM peminjaman 
                    JOIN buku ON peminjaman.id_buku = buku.id 
                    WHERE peminjaman.id=$id";
$resultPeminjaman = $conn->query($queryPeminjaman);

if ($resultPeminjaman->num_rows > 0) {
    $rowPeminjaman = $resultPeminjaman->fetch_assoc();
} else {
    echo "Data peminjaman tidak ditemukan.";
    exit();
}

} else {
    echo "ID peminjaman tidak valid.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $query = "DELETE FROM peminjaman WHERE id=$id";
    $conn->query($query);

    header("Location: peminjaman.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Peminjaman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Hapus Peminjaman</h2>
        <p>Anda yakin ingin menghapus peminjaman berikut?</p>
        <p><strong>Nama Buku:</strong> <?php echo $rowPeminjaman['nama_buku']; ?></p>
        <p><strong>Nama Peminjam:</strong> <?php echo $rowPeminjaman['nama']; ?></p>
        <form action="" method="post">
            <button type="submit" class="btn btn-danger">Hapus</button>
            <a href="peminjaman.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
