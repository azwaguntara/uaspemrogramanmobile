<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
include 'koneksi.php';

$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$stok = $_POST['stok'];
$nama_file = $_FILES['cover']['name'];
$tmp_name = $_FILES['cover']['tmp_name'];

$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$target = $upload_dir . basename($nama_file);
move_uploaded_file($tmp_name, $target);

$query = "INSERT INTO buku (judul, penulis, stok, cover) VALUES ('$judul', '$penulis', '$stok', '$nama_file')";
if (mysqli_query($koneksi, $query)) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "error" => mysqli_error($koneksi)]);
}
?>
