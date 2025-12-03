<?php

date_default_timezone_set('Asia/Makassar');

/**
 * Ambil IP klien dengan prioritas header proxy (jika ada),
 * namun tetap validasi agar hanya IP yang sah yang dicatat.
 */
function get_client_ip(): string {
    $candidates = [];

    // Jika pakai Cloudflare
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        $candidates[] = $_SERVER['HTTP_CF_CONNECTING_IP'];
    }

    // Jika di belakang reverse proxy / load balancer
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Ambil IP pertama (origin) dari daftar
        $forwarded = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $candidates[] = trim($forwarded[0]);
    }

    if (!empty($_SERVER['HTTP_X_REAL_IP'])) {
        $candidates[] = $_SERVER['HTTP_X_REAL_IP'];
    }

    // Fallback ke REMOTE_ADDR
    if (!empty($_SERVER['REMOTE_ADDR'])) {
        $candidates[] = $_SERVER['REMOTE_ADDR'];
    }

    // Validasi dan kembalikan kandidat pertama yang valid (IPv4/IPv6)
    foreach ($candidates as $ip) {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return $ip; // IP publik yang valid
        }
    }
    // Jika tidak ada IP publik, izinkan IP privat (LAN) terakhir
    foreach ($candidates as $ip) {
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return $ip;
        }
    }
    return '0.0.0.0';
}

$ip = get_client_ip();
// ISO 8601 dgn offset zona waktu (mis. 2025-11-12T10:15:30+08:00)
$ts = date('c');

// Lokasi file log (di folder yg sama dengan skrip)
$logFile = __DIR__ . DIRECTORY_SEPARATOR . 'access_ips.log';

// Buat baris log (format: timestamp \t ip \n)
// Ganti menjadi CSV jika mau: "$ts,$ip\n"
$line = $ts . "\t" . $ip . PHP_EOL;

// Tulis ke file dengan locking agar aman pada traffic paralel
$fh = fopen($logFile, 'ab');
if ($fh === false) {
    http_response_code(500);
    exit('Gagal membuka file log.');
}

if (flock($fh, LOCK_EX)) {
    fwrite($fh, $line);
    fflush($fh);
    flock($fh, LOCK_UN);
} else {
    http_response_code(500);
    fclose($fh);
    exit('Gagal mengunci file log.');
}

fclose($fh);

// (Opsional) tampilkan respons sederhana
header('Content-Type: text/plain; charset=UTF-8');
echo "OK: $ip @ $ts\n";



// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
