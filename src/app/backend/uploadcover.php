<?php
// Izinkan CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

// Cek apakah file diunggah
if (isset($_FILES['cover'])) {
    $target_dir = "uploads/";
    
    // Buat folder uploads jika belum ada
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $filename = basename($_FILES["cover"]["name"]);
    $target_file = $target_dir . time() . "_" . $filename;

    if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
        echo json_encode([
            "status" => "success",
            "message" => "Upload berhasil",
            "file_path" => $target_file
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal memindahkan file"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Tidak ada file yang diunggah"
    ]);
}
?>
