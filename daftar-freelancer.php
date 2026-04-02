<?php
require_once __DIR__ . '/config/database.php';
requireClientLogin();

$userId = $_SESSION['user_id'];
$userName = $_SESSION['user_nama'] ?? '';
$userRole = $_SESSION['user_role'] ?? 2;

// Cek sudah freelancer
if ($userRole == 3) {
    header('Location: kelola-jasa.php');
    exit;
}

// Load user data for pre-fill
$stmt = $pdo->prepare("SELECT * FROM pengguna WHERE id_pengguna = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

// Data dropdown
$kategoriList = $pdo->query("SELECT * FROM kategori ORDER BY nama_kategori")->fetchAll();
$jasaList = $pdo->query("SELECT * FROM jasa ORDER BY nama_jasa")->fetchAll();
$satuanList = $pdo->query("SELECT * FROM satuan ORDER BY nama_satuan")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Freelancer | WorkLance</title>
  <meta name="description" content="Daftar sebagai freelancer di WorkLance. Isi data diri dan mulai tawarkan jasamu." />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style type="text/tailwindcss">
    @theme {
      --color-primary: #96B3BF;
      --color-dark: #121843;
      --color-accent: #C1572A;
      --color-secondary: #CC7A55;
      --font-sans: "Inter", ui-sans-serif, system-ui, sans-serif;
    }
    @layer utilities {
      .glass-effect { @apply bg-white/80 backdrop-blur-md border border-white/20 shadow-lg; }
    }
  </style>
</head>
<body class="bg-gray-50 min-h-screen font-sans flex flex-col antialiased">

  <!-- Navbar -->
  <nav class="sticky top-0 z-50 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-20 items-center">
        <a href="index.php" class="flex items-center gap-2 group">
          <div class="w-10 h-10 bg-dark text-white rounded-xl flex items-center justify-center font-bold text-xl">W</div>
          <span class="text-2xl font-bold text-dark tracking-tight">Work<span class="text-accent">Lance</span></span>
        </a>
        <div class="flex items-center gap-3">
          <span class="text-sm font-medium text-gray-500 hidden sm:block">Pendaftaran Freelancer</span>
          <div class="w-10 h-10 bg-primary/20 text-primary rounded-full flex items-center justify-center font-bold"><?= getInitials($userName) ?></div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Progress Bar -->
  <div class="bg-white border-b border-gray-100">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
      <div class="flex items-center gap-4 text-sm font-medium">
        <div class="flex items-center gap-2 text-accent">
          <div class="w-8 h-8 bg-accent text-white rounded-full flex items-center justify-center font-bold text-xs">1</div>
          <span class="hidden sm:inline">Data Diri</span>
        </div>
        <div class="flex-1 h-0.5 bg-gray-200 rounded"></div>
        <div class="flex items-center gap-2 text-gray-400">
          <div class="w-8 h-8 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center font-bold text-xs">2</div>
          <span class="hidden sm:inline">Keahlian & Jasa</span>
        </div>
        <div class="flex-1 h-0.5 bg-gray-200 rounded"></div>
        <div class="flex items-center gap-2 text-gray-400">
          <div class="w-8 h-8 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center font-bold text-xs">3</div>
          <span class="hidden sm:inline">Verifikasi</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Form -->
  <main class="flex-grow py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
      <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Header -->
        <div class="bg-dark p-8 md:p-10 text-white relative overflow-hidden">
          <div class="absolute top-0 right-0 w-64 h-64 bg-primary/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
          <div class="absolute bottom-0 left-0 w-48 h-48 bg-accent/15 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
          <div class="relative z-10">
            <h1 class="text-3xl font-bold mb-2">Pendaftaran Freelancer</h1>
            <p class="text-gray-300">Setiap keahlian layak diapresiasi. Beritahu kami siapa Anda dan apa spesialisasi Anda.</p>
          </div>
        </div>

        <form class="p-8 md:p-10 space-y-8" id="formDaftarFreelancer">

          <!-- Section 1: Identitas Diri -->
          <div>
            <h2 class="text-xl font-bold text-dark mb-1 flex items-center gap-2">
              <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
              Identitas Diri
            </h2>
            <p class="text-sm text-gray-500 mb-5">Informasi dasar tentang diri Anda.</p>
            <div class="grid md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-bold text-dark mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" value="<?= htmlspecialchars($user['nama_pengguna'] ?? '') ?>" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white text-sm font-medium text-dark" readonly>
              </div>
              <div>
                <label class="block text-sm font-bold text-dark mb-2">Email <span class="text-red-500">*</span></label>
                <input type="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white text-sm font-medium text-dark" readonly>
              </div>
              <div>
                <label class="block text-sm font-bold text-dark mb-2">No. Telepon / WhatsApp <span class="text-red-500">*</span></label>
                <input type="tel" name="no_telp" value="<?= htmlspecialchars($user['no_telp'] ?? '') ?>" placeholder="0812xxxxxxxx" required class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white text-sm font-medium text-dark">
              </div>
              <div>
                <label class="block text-sm font-bold text-dark mb-2">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="<?= $user['tanggal_lahir'] ?? '' ?>" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white text-sm font-medium text-dark">
              </div>
              <div class="md:col-span-2">
                <label class="block text-sm font-bold text-dark mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                <textarea name="alamat_lengkap" rows="2" placeholder="Alamat domisili Anda saat ini..." required class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white text-sm font-medium text-dark resize-none"><?= htmlspecialchars($user['alamat_lengkap'] ?? '') ?></textarea>
              </div>
            </div>
          </div>

          <hr class="border-gray-100">

          <!-- Section 2: Keahlian & Layanan -->
          <div>
            <h2 class="text-xl font-bold text-dark mb-1 flex items-center gap-2">
              <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
              Keahlian & Layanan
            </h2>
            <p class="text-sm text-gray-500 mb-5">Pilih kategori dan jasa yang ingin Anda tawarkan.</p>
            <div class="grid md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-bold text-dark mb-2">Kategori Utama <span class="text-red-500">*</span></label>
                <select name="id_kategori" id="selectKategori" required class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white text-sm font-medium text-dark">
                  <option value="">-- Pilih Kategori --</option>
                  <?php foreach ($kategoriList as $kat): ?>
                  <option value="<?= $kat['id_kategori'] ?>"><?= htmlspecialchars($kat['nama_kategori']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div>
                <label class="block text-sm font-bold text-dark mb-2">Jasa / Profesi <span class="text-red-500">*</span></label>
                <select name="id_jasa" id="selectJasa" required class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white text-sm font-medium text-dark">
                  <option value="">-- Pilih Jasa --</option>
                  <?php foreach ($jasaList as $js): ?>
                  <option value="<?= $js['id_jasa'] ?>" data-kategori="<?= $js['id_kategori'] ?>"><?= htmlspecialchars($js['nama_jasa']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>

          <hr class="border-gray-100">

          <!-- Section 3: Deskripsi & Tarif -->
          <div>
            <h2 class="text-xl font-bold text-dark mb-1 flex items-center gap-2">
              <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
              Deskripsi & Tarif
            </h2>
            <p class="text-sm text-gray-500 mb-5">Tentukan harga dan deskripsikan keahlian Anda.</p>
            <div class="space-y-6">
              <div>
                <label class="block text-sm font-bold text-dark mb-2">Tarif Dasar / Mulai Dari <span class="text-red-500">*</span></label>
                <div class="flex">
                  <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-gray-200 bg-gray-100 text-gray-500 font-bold text-sm">Rp</span>
                  <input type="number" name="tarif" placeholder="150000" required class="w-full border border-gray-200 px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white text-sm font-medium text-dark">
                  <span class="inline-flex items-center px-3 border border-l-0 border-r-0 border-gray-200 bg-gray-100 text-gray-400 text-sm">/</span>
                  <select name="id_satuan" class="rounded-r-xl border border-gray-200 px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white text-sm font-medium text-dark min-w-[120px]">
                    <option value="">Satuan</option>
                    <?php foreach ($satuanList as $st): ?>
                    <option value="<?= $st['id_satuan'] ?>"><?= htmlspecialchars($st['nama_satuan']) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div>
                <label class="block text-sm font-bold text-dark mb-2">Deskripsi Singkat Keahlian</label>
                <textarea name="deskripsi" rows="4" placeholder="Ceritakan singkat tentang pengalaman, metode kerja, atau kelebihan layanan Anda dari yang lain..." class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white text-sm font-medium text-dark resize-none"></textarea>
              </div>
            </div>
          </div>

          <hr class="border-gray-100">

          <!-- Section 4: Verifikasi Dokumen -->
          <div class="pb-4">
            <h2 class="text-xl font-bold text-dark mb-1 flex items-center gap-2">
              <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
              Verifikasi Dokumen
            </h2>
            <p class="text-sm text-gray-500 mb-5">Unggah dokumen untuk verifikasi identitas Anda.</p>
            <div class="grid md:grid-cols-2 gap-6">
              <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 text-center bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer group">
                <svg class="w-10 h-10 mx-auto text-gray-400 mb-3 group-hover:text-accent transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                <p class="text-dark font-bold text-sm">Foto KTP</p>
                <p class="text-gray-500 text-xs mt-1">Maks 5MB (JPG, PNG)</p>
              </div>
              <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 text-center bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer group">
                <svg class="w-10 h-10 mx-auto text-gray-400 mb-3 group-hover:text-accent transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <p class="text-dark font-bold text-sm">Foto Portofolio <span class="text-gray-400 font-normal">(Opsional)</span></p>
                <p class="text-gray-500 text-xs mt-1">Maks 5MB (JPG, PNG, PDF)</p>
              </div>
            </div>
          </div>

          <!-- Agreement -->
          <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl border border-gray-100">
            <input type="checkbox" id="agree" required class="mt-1 w-4 h-4 accent-accent">
            <label for="agree" class="text-sm text-gray-600">
              Dengan mendaftar, saya menyetujui <a href="#" class="text-accent font-bold hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-accent font-bold hover:underline">Kebijakan Privasi</a> WorkLance. Data yang saya berikan adalah benar dan dapat dipertanggungjawabkan.
            </label>
          </div>

          <!-- Action Buttons -->
          <div class="pt-4 flex flex-col sm:flex-row items-center gap-4">
            <a href="mulai-freelancer.php" class="px-8 py-3.5 text-gray-600 font-bold hover:text-dark transition-colors text-center">Kembali</a>
            <button type="submit" class="flex-1 w-full sm:w-auto bg-accent hover:bg-orange-600 text-white font-bold py-3.5 rounded-xl shadow-[0_8px_20px_-6px_rgba(193,87,42,0.5)] hover:shadow-xl transition-all transform hover:-translate-y-0.5 text-lg cursor-pointer">
              Daftar Sebagai Freelancer
            </button>
          </div>
        </form>
      </div>

      <!-- Info Note -->
      <div class="mt-6 flex items-start gap-3 p-4 bg-blue-50 rounded-xl border border-blue-100 text-sm">
        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <p class="text-blue-700">Setelah mendaftar, profil Anda akan langsung aktif dan dapat ditemukan oleh calon klien di WorkLance. Anda dapat menambahkan atau mengelola jasa tambahan kapan saja melalui menu <strong>Kelola Jasa</strong>.</p>
      </div>
    </div>
  </main>

  <script>
    // Cascade kategori -> jasa
    document.getElementById('selectKategori').addEventListener('change', function() {
      const katId = this.value;
      const jasaSel = document.getElementById('selectJasa');
      jasaSel.value = '';
      jasaSel.querySelectorAll('option[data-kategori]').forEach(opt => {
        opt.style.display = (!katId || opt.dataset.kategori === katId) ? '' : 'none';
      });
    });

    // Frontend-only submit handler (placeholder)
    document.getElementById('formDaftarFreelancer').addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Fitur pendaftaran freelancer akan segera diproses. Halaman ini saat ini hanya frontend.');
    });
  </script>
</body>
</html>
