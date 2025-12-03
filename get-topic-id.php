<?php 

// ==============================================================================
// CEK METHOD POST
// ==============================================================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Hanya method POST yang diizinkan.']);
    exit;
}

header('Content-Type: application/json');


// 1. Definisikan INCLUDE_DIR terlebih dahulu
// INCLUDE_DIR seharusnya adalah jalur absolut ke folder 'include/' osTicket.
// Jika skrip ini ada di root osTicket, ini adalah jalur yang benar.
define('INCLUDE_DIR', __DIR__ . '/include/');

// 2. Tentukan jalur file konfigurasi
$osticket_config_path = INCLUDE_DIR . 'ost-config.php';

// Pastikan file konfigurasi osTicket dapat diakses
if (!file_exists($osticket_config_path)) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => "File konfigurasi osTicket tidak ditemukan!"]);
    exit;
}
// Muat konfigurasi osTicket (Variabel DBHOST, DBUSER, DBNAME, DBPASS akan terdefinisi)
require_once($osticket_config_path);

// Ambil variabel dari konfigurasi osTicket
$servername = DBHOST; 
$username = DBUSER;
$password = DBPASS;
$dbname = DBNAME;

// Dapatkan prefix tabel (default: ost_)
$table_prefix = defined('TABLE_PREFIX') ? TABLE_PREFIX : 'ost_';
$topic_table = $table_prefix . "help_topic";


// ==============================================================================
// CEK APAKAH INPUT TOPIC_NAME DISEDIAKAN DALAM PAYLOAD JSON
// ==============================================================================
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if (empty($data['topic_name'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Field "topic_name" harus disediakan dalam payload JSON.']);
    exit;
}

$topic_name_input = trim($data['topic_name']);

// ==============================================================================
// KONEKSI KE DATABASE MENGGUNAKAN PDO
// ==============================================================================
try {
    $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
    $conn = new PDO($dsn, $username, $password);
    
    // Set mode error PDO ke Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Koneksi database gagal: ' . $e->getMessage()]);
    exit;
}

// ==============================================================================
// QUERY DATABASE MENGGUNAKAN PDO PREPARED STATEMENT
// ==============================================================================

// Pastikan nama kolom database (topic_name dan topic_id) sesuai dengan osTicket
$sql = "SELECT topic_id FROM $topic_table WHERE LOWER(topic) = LOWER(:topic_name) LIMIT 1";

try {
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':topic_name', $topic_name_input, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch();

    $response = [];

    if ($row) {
        $response = [
            'status' => 'success',
            'topic_name' => $topic_name_input,
            'topicId' => (int)$row['topic_id']
        ];
    } else {
        http_response_code(404);
        $response = [
            'status' => 'error',
            'topic_name' => $topic_name_input,
            'message' => 'Topic ID tidak ditemukan untuk nama yang diberikan.'
        ];
    }

} catch (PDOException $e) {
    http_response_code(500);
    $response = ['status' => 'error', 'message' => 'Query database gagal: ' . $e->getMessage()];
}

// ==============================================================================
// KEMBALIKAN RESPON JSON
// ==============================================================================

echo json_encode($response);