<?php
include 'koneksi.php';
$query = mysqli_query($koneksi, "
  SELECT b.*, p.id AS id_pinjam
  FROM buku b
  LEFT JOIN peminjaman p ON b.id = p.id_buku AND p.status = 'dipinjam'
");
$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}
echo json_encode($data);
?>
