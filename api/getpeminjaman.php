<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status='dipinjam'");
$data = [];

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);
?>
