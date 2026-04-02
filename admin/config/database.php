<?php
session_start();

$host = 'localhost';
$dbname = 'worklance';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

// Fungsi cek apakah admin sudah login
function isLoggedIn() {
    return isset($_SESSION['admin_id']);
}

// Redirect ke login jika belum login
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

// Fungsi helper untuk format tanggal Indonesia
function formatTanggal($tanggal) {
    $bulan = [
        1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
        5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agt',
        9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
    ];
    $timestamp = strtotime($tanggal);
    $d = date('d', $timestamp);
    $m = $bulan[(int)date('m', $timestamp)];
    $y = date('Y', $timestamp);
    return "$d $m $y";
}

// Fungsi untuk mendapatkan inisial nama
function getInitials($nama) {
    $words = explode(' ', $nama);
    $initials = '';
    foreach (array_slice($words, 0, 2) as $word) {
        $initials .= strtoupper(substr($word, 0, 1));
    }
    return $initials;
}
?>
