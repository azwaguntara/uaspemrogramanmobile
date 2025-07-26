<?php
ob_clean();
error_reporting(0);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan']);
    exit();
}

$input = json_decode(file_get_contents("php://input"), true);

if (
    !isset($input['judul']) || 
    !isset($input['penulis']) || 
    !isset($input['penerbit']) || 
    !isset($input['stok'])
) {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
    exit();
}

$judul    = $input['judul'];
$penulis  = $input['penulis'];
$penerbit = $input['penerbit'];
$stok     = (int)$input['stok'];

include 'koneksi.php';

$stmt = $koneksi->prepare("INSERT INTO buku (judul, penulis, penerbit, stok) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal mempersiapkan pernyataan SQL',
        'sql_error' => $koneksi->error
    ]);
    exit();
}

$stmt->bind_param("sssi", $judul, $penulis, $penerbit, $stok);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal menyimpan data ke database',
        'sql_error' => $stmt->error
    ]);
}

$stmt->close();
$koneksi->close();
?>
