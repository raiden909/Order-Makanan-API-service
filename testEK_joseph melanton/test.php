<?php
include 'db.php';

header('Content-Type: application/json');

// Mengecek koneksi
if ($conn->connect_error) {
    echo json_encode(['error' => 'Koneksi gagal: ' . $conn->connect_error]);
} else {
    echo json_encode(['success' => 'Koneksi berhasil']);
}

$conn->close();
?>
