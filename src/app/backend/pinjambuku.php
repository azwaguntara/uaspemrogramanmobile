<?php
include 'koneksi.php';
$id_buku = $_POST['id_buku'];
$nama = $_POST['nama'];
$nim = $_POST['nim'];
$prodi = $_POST['prodi'];
$semester = $_POST['semester'];
$judul_buku = $_POST['judul_buku'];
$pengembalian = $_POST['pengembalian'];

mysqli_query($koneksi, "INSERT INTO peminjaman (id_buku, nama, nim, prodi, semester, judul_buku, pengembalian, status) VALUES ('$id_buku', '$nama', '$nim', '$prodi', '$semester', '$judul_buku', '$pengembalian', 'dipinjam')");

mysqli_query($koneksi, "UPDATE buku SET stok = stok - 1 WHERE id = '$id_buku'");

echo json_encode(['status' => 'success']);
?>
