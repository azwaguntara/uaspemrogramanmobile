<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include 'koneksi.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $data = json_decode(file_get_contents("php://input"), true);

    if (
        !isset($data['id_buku']) || !isset($data['nama']) || !isset($data['nim']) ||
        !isset($data['prodi']) || !isset($data['semester']) || 
        !isset($data['nohp']) || !isset($data['email']) ||
        !isset($data['judul_buku']) || !isset($data['pengembalian'])
    ) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
        exit();
    }


    $id_buku = $data['id_buku'];
    $nama = $data['nama'];
    $nim = $data['nim'];
    $prodi = $data['prodi'];
    $semester = $data['semester'];
    $nohp = $data['nohp'];
    $email = $data['email'];
    $judul_buku = $data['judul_buku'];
    $pengembalian = $data['pengembalian'];
    $status = 'dipinjam';

    $stmt = $koneksi->prepare("INSERT INTO peminjaman (id_buku, nama, nim, prodi, semester, nohp, email, judul_buku, pengembalian, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssss", $id_buku, $nama, $nim, $prodi, $semester, $nohp, $email, $judul_buku, $pengembalian, $status);
    $stmt->execute();
    $stmt->close();

    $updateStok = $koneksi->prepare("UPDATE buku SET stok = stok - 1 WHERE id = ?");
    $updateStok->bind_param("i", $id_buku);
    $updateStok->execute();
    $updateStok->close();

    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
