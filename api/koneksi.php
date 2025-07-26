<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

$hostname = 'localhost';
$username = 'xwbxkukt_azwa';
$password = 'azwa@ti2025';
$database = 'xwbxkukt_azwa';

$koneksi = mysqli_connect($hostname, $username, $password, $database);

if (!$koneksi) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Koneksi database gagal: " . mysqli_connect_error()
    ]);
    exit;
}
?>
