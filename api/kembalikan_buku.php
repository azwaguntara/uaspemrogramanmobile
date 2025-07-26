<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, Content-Type, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include 'koneksi.php';

$json = file_get_contents("php://input");
if (!$json) {
    echo json_encode(["status" => "error", "message" => "No JSON data received"]);
    exit();
}

$data = json_decode($json, true);

if (!isset($data['id'])) {
    echo json_encode(["status" => "error", "message" => "ID tidak ditemukan"]);
    exit();
}

$id = intval($data['id']);

$get = mysqli_query($koneksi, "SELECT id_buku FROM peminjaman WHERE id = $id");
if (!$get || mysqli_num_rows($get) == 0) {
    echo json_encode(["status" => "error", "message" => "Data peminjaman tidak ditemukan"]);
    exit();
}

$row = mysqli_fetch_assoc($get);
$id_buku = intval($row['id_buku']);

$update = mysqli_query($koneksi, "UPDATE peminjaman SET status='dikembalikan', tanggal_kembali=NOW() WHERE id=$id");

if ($update) {
    mysqli_query($koneksi, "UPDATE buku SET stok = stok + 1 WHERE id = $id_buku");
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal mengembalikan buku"]);
}
?>
