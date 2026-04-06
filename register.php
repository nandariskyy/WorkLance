<?php
require_once __DIR__ . '/config/database.php';

if (isClientLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $no_telp = trim($_POST['no_telp'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($username) || empty($password)) {
        $error = 'Semua field wajib diisi.';
    } elseif (strlen($password) < 3) {
        $error = 'Password minimal 3 karakter.';
    } else {
        // Cek email unik
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM pengguna WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            $error = 'Email sudah terdaftar.';
        } else {
            // Cek username unik
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM pengguna WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetchColumn() > 0) {
                $error = 'Username sudah digunakan.';
            } else {
                $stmt = $pdo->prepare("INSERT INTO pengguna (id_role, username, nama_pengguna, email, no_telp, password) VALUES (2, ?, ?, ?, ?, ?)");
                $stmt->execute([$username, $username, $email, $no_telp, $password]);
                $newId = $pdo->lastInsertId();

                // Auto-login
                $_SESSION['user_id'] = $newId;
                $_SESSION['user_nama'] = $username;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_role'] = 2;
                $_SESSION['user_username'] = $username;
                header('Location: index.php');
                exit;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar | WorkLance</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/WorkLance/src/output.css">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen font-sans py-10">
  <div class="w-full max-w-xl p-8 bg-white rounded-3xl shadow-xl shadow-primary/10 border border-gray-100 m-4">
    <div class="text-center mb-8">
      <a href="index.php" class="inline-flex items-center gap-2 group mb-6">
        <div class="w-10 h-10 bg-dark text-white rounded-xl flex items-center justify-center font-bold text-xl shadow-md">W</div>
        <span class="text-2xl font-bold text-dark tracking-tight">Work<span class="text-accent">Lance</span></span>
      </a>
      <h2 class="text-2xl font-bold text-dark">Gabung Bersama Kami</h2>
      <p class="text-gray-500 mt-2">Buat akun WorkLance Anda untuk mulai mencari jasa atau mendaftar sebagai freelancer lokal.</p>
    </div>

    <?php if ($error): ?>
    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm font-medium flex items-center gap-2">
      <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
      <?= htmlspecialchars($error) ?>
    </div>
    <?php endif; ?>

    <form method="POST" action="" class="space-y-4">
      <div>
        <label class="block text-sm font-bold text-dark mb-2">Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition-colors" placeholder="nama@email.com" required>
      </div>
      <div>
        <label class="block text-sm font-bold text-dark mb-2">Username</label>
        <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition-colors" placeholder="budisantoso" required>
      </div>
      <div>
        <label class="block text-sm font-bold text-dark mb-2">No Telp</label>
        <input type="tel" name="no_telp" value="<?= htmlspecialchars($_POST['no_telp'] ?? '') ?>" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition-colors" placeholder="081234567890">
      </div>
      <div>
        <label class="block text-sm font-bold text-dark mb-2">Password</label>
        <input type="password" name="password" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition-colors" placeholder="Buat password yang kuat" required>
      </div>
      <button type="submit" class="w-full bg-accent hover:bg-orange-600 text-white font-bold py-3.5 rounded-xl shadow-lg transition-all transform hover:-translate-y-0.5 mt-4 text-lg cursor-pointer">
        Buat Akun
      </button>
    </form>
    <p class="text-center text-gray-600 mt-8 text-sm">
      Sudah punya akun? <a href="login.php" class="text-dark font-bold hover:underline">Masuk di sini</a>
    </p>
  </div>
</body>
</html>