<?php
session_start();
require_once("../config.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$query = "DELETE FROM buku WHERE id=$id";
$conn->query($query);

header("Location: buku.php");
exit();
?>
