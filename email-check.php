<?php

// Set header JSON di awal
header('Content-Type: application/json');

// Pastikan request menggunakan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Request harus menggunakan POST";
    exit;
}

// Baca raw body (JSON) dari request
$rawBody = file_get_contents('php://input');

// Ubah JSON menjadi array asosiatif
$data = json_decode($rawBody, true);

// Cek apakah JSON valid dan punya key "email"
if (!is_array($data) || !isset($data['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'Email tidak valid']);
    exit;
}

// Ambil nilai email dan buang spasi di kiri/kanan
$email = trim($data['email']);

// Cek apakah email valid
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'success', 'message' => 'ok']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Email tidak valid']);
}

exit;