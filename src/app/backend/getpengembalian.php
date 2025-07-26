<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status='dikembalikan'");
$data = [];

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);
?>
