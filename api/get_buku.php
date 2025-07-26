<?php
include 'koneksi.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$result = mysqli_query($koneksi, "SELECT id, judul FROM buku");
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
