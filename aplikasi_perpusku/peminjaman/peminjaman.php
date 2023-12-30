<?php
include('../header.php');
include('../footer.php');

session_start();
require_once("../config.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil data peminjaman db
$query = "SELECT * FROM peminjaman";
$result = $conn->query($query);

//session timeout
if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > $session_timeout)) {
    session_unset();
    session_destroy();
    header("Location: ../login.php?timeout=true");
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
    <title>Manajemen Peminjaman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Manajemen Peminjaman</h2>
        <a href="create.php" class="btn btn-success mb-3">Tambah Peminjam</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Buku</th>
                    <th>Nama Peminjam</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    
                    // Ambil data buku berdasarkan ID buku
                    $idBuku = $row['id_buku'];
                    $queryBuku = "SELECT judul FROM buku WHERE id=$idBuku";
                    $resultBuku = $conn->query($queryBuku);
                    $rowBuku = $resultBuku->fetch_assoc();
                    
                    echo "<td>" . $rowBuku['judul'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['alamat'] . "</td>";
                    echo "<td>" . $row['no_telepon'] . "</td>";
                    echo "<td>" . $row['tanggal_pinjam'] . "</td>";
                    echo "<td>" . $row['tanggal_kembali'] . "</td>";
                    echo "<td>
                            <a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a>
                            <a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
