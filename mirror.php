<?php
// Set header untuk JSON response
header('Content-Type: application/json');

// Pastikan request menggunakan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Request harus menggunakan POST']);
    exit;
}

// Ambil data POST
$postData = $_POST['message'] ?? "";

// Jika data dikirim sebagai raw JSON, ambil dari php://input
$rawBody = file_get_contents('php://input');
// Cek apakah ada data JSON
if (!empty($rawBody)) {
    // Jika data JSON valid, gunakan data tersebut
    $jsonData = json_decode($rawBody, true);
    // Jika ada key 'message', gunakan itu
    if (is_array($jsonData) && isset($jsonData['message'])) {
        $postData = $jsonData['message'];
    }
}

// Siapkan response
$response = [
    'status' => 'success',
    'message' => $postData,
];

// Kirim response dalam format JSON
echo json_encode($response, JSON_PRETTY_PRINT);
exit;