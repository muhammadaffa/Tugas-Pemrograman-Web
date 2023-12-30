<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "db_perpusku";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$session_timeout = 120;

?>
