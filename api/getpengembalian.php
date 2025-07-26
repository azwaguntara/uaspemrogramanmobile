<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status = 'dikembalikan' ORDER BY tanggal_kembali DESC");

$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);
?>
