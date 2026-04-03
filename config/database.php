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

// Cek apakah client sudah login
function isClientLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Redirect ke login jika belum login
function requireClientLogin() {
    if (!isClientLoggedIn()) {
        header('Location: /WorkLance/login.php');
        exit;
    }
}

// Cek apakah admin sudah login
function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']);
}

// Redirect ke login jika belum login
function requireAdminLogin() {
    if (!isAdminLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

// Format tanggal Indonesia
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

// Inisial nama
function getInitials($nama) {
    $words = explode(' ', $nama);
    $initials = '';
    foreach (array_slice($words, 0, 2) as $word) {
        $initials .= strtoupper(substr($word, 0, 1));
    }
    return $initials;
}
?>
