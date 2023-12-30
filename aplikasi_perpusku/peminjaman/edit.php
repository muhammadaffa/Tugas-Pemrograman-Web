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
    $id = $_POST['id'];
    $id_buku = $_POST['id_buku'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $query = "UPDATE peminjaman SET 
              id_buku='$id_buku', 
              nama='$nama', 
              alamat='$alamat', 
              no_telepon='$no_telepon', 
              tanggal_pinjam='$tanggal_pinjam', 
              tanggal_kembali='$tanggal_kembali' 
              WHERE id=$id";
    $conn->query($query);

    header("Location: peminjaman.php");
    exit();
}

$id = $_GET['id'];
$queryPeminjaman = "SELECT * FROM peminjaman WHERE id=$id";
$resultPeminjaman = $conn->query($queryPeminjaman);
$rowPeminjaman = $resultPeminjaman->fetch_assoc();

// Ambil data buku untuk dropdown
$queryBuku = "SELECT id, judul FROM buku";
$resultBuku = $conn->query($queryBuku);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Peminjaman</h2>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $rowPeminjaman['id']; ?>">
            <div class="form-group">
                <label for="id_buku">Buku:</label>
                <select class="form-control" id="id_buku" name="id_buku" required>
                    <?php
                    while ($rowBuku = $resultBuku->fetch_assoc()) {
                        $selected = ($rowBuku['id'] == $rowPeminjaman['id_buku']) ? "selected" : "";
                        echo "<option value='" . $rowBuku['id'] . "' $selected>" . $rowBuku['judul'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama">Nama Peminjam:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $rowPeminjaman['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $rowPeminjaman['alamat']; ?>" required>
            </div>
            <div class="form-group">
                <label for="no_telepon">No. Telepon:</label>
                <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?php echo $rowPeminjaman['no_telepon']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_pinjam">Tanggal Pinjam:</label>
                <input type="text" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value="<?php echo $rowPeminjaman['tanggal_pinjam']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali:</label>
                <input type="text" class="form-control" id="tanggal_kembali" name="tanggal_kembali" value="<?php echo $rowPeminjaman['tanggal_kembali']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="peminjaman.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>