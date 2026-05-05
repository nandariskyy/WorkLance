<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function dashboard()
    {
        $data = [
            'currentPage' => 'dashboard',
            'adminNama' => 'Admin WorkLance',
            'adminInitials' => 'AW',
            'totalUser' => 150,
            'totalFreelancer' => 45,
            'totalBooking' => 320,
            'totalSelesai' => 290,
            'bookingTerbaru' => [
                ['nama_client' => 'Budi Santoso', 'nama_jasa' => 'Desain Logo', 'tanggal_booking' => '2026-04-28 10:00:00', 'status_booking' => 'DIPROSES'],
                ['nama_client' => 'Siti Aminah', 'nama_jasa' => 'Pembuatan Website', 'tanggal_booking' => '2026-04-27 14:30:00', 'status_booking' => 'MENUNGGU'],
                ['nama_client' => 'Andi Wijaya', 'nama_jasa' => 'Video Editing', 'tanggal_booking' => '2026-04-26 09:15:00', 'status_booking' => 'SELESAI'],
            ],
            'kategoriPopuler' => [
                ['nama_kategori' => 'Desain Grafis', 'total' => 20],
                ['nama_kategori' => 'Pemrograman', 'total' => 15],
                ['nama_kategori' => 'Multimedia', 'total' => 10],
            ],
            'newPengajuan' => [
                ['nama_pengguna' => 'Joko Suprianto', 'status' => 'MENUNGGU'],
                ['nama_pengguna' => 'Rina Melati', 'status' => 'MENUNGGU'],
            ],
            'maxKategori' => 20
        ];

        return view('admin.dashboard', $data);
    }

    public function pengguna()
    {
        $data = [
            'currentPage' => 'pengguna',
            'adminNama' => 'Admin WorkLance',
            'adminInitials' => 'AW',
            'penggunaList' => [
                ['id_pengguna' => 1, 'nama_pengguna' => 'Budi Santoso', 'email' => 'budi@example.com', 'no_telp' => '081234567890', 'role' => 'Klien', 'tanggal_daftar' => '2026-01-15'],
                ['id_pengguna' => 2, 'nama_pengguna' => 'Joko Suprianto', 'email' => 'joko@example.com', 'no_telp' => '081298765432', 'role' => 'Freelancer', 'tanggal_daftar' => '2026-02-10'],
            ]
        ];

        return view('admin.pengguna', $data);
    }

    public function freelancer()
    {
        $data = [
            'currentPage' => 'freelancer',
            'adminNama' => 'Admin WorkLance',
            'adminInitials' => 'AW',
            'freelancerList' => [
                ['id_pengguna' => 2, 'nama_pengguna' => 'Joko Suprianto', 'email' => 'joko@example.com', 'no_telp' => '081298765432', 'kategori' => 'Pemrograman', 'status' => 'Aktif'],
                ['id_pengguna' => 3, 'nama_pengguna' => 'Rina Melati', 'email' => 'rina@example.com', 'no_telp' => '081211112222', 'kategori' => 'Desain Grafis', 'status' => 'Aktif'],
            ]
        ];

        return view('admin.freelancer', $data);
    }

    public function booking()
    {
        $data = [
            'currentPage' => 'booking',
            'adminNama' => 'Admin WorkLance',
            'adminInitials' => 'AW',
            'bookingList' => [
                ['id_booking' => 'BK-1001', 'nama_client' => 'Budi Santoso', 'nama_freelancer' => 'Joko Suprianto', 'nama_jasa' => 'Pembuatan Website', 'tanggal_booking' => '2026-04-27', 'status_booking' => 'MENUNGGU'],
                ['id_booking' => 'BK-1002', 'nama_client' => 'Andi Wijaya', 'nama_freelancer' => 'Rina Melati', 'nama_jasa' => 'Desain Logo', 'tanggal_booking' => '2026-04-26', 'status_booking' => 'SELESAI'],
            ]
        ];

        return view('admin.booking', $data);
    }

    public function pengajuan()
    {
        $data = [
            'currentPage' => 'pengajuan',
            'adminNama' => 'Admin WorkLance',
            'adminInitials' => 'AW',
            'pengajuanList' => [
                ['id_pengajuan' => 1, 'nama_pengguna' => 'Joko Suprianto', 'kategori_diajukan' => 'Pemrograman', 'tanggal_pengajuan' => '2026-04-28', 'status' => 'MENUNGGU'],
                ['id_pengajuan' => 2, 'nama_pengguna' => 'Rina Melati', 'kategori_diajukan' => 'Desain Grafis', 'tanggal_pengajuan' => '2026-04-28', 'status' => 'MENUNGGU'],
            ]
        ];

        return view('admin.pengajuan', $data);
    }

    public function kelola()
    {
        $data = [
            'currentPage' => 'kelola',
            'adminNama' => 'Admin WorkLance',
            'adminInitials' => 'AW',
            'kategoriList' => [
                ['id_kategori' => 1, 'nama_kategori' => 'Desain Grafis'],
                ['id_kategori' => 2, 'nama_kategori' => 'Pemrograman'],
            ],
            'jasaList' => [
                ['id_jasa' => 1, 'nama_jasa' => 'Desain Logo', 'kategori' => 'Desain Grafis'],
                ['id_jasa' => 2, 'nama_jasa' => 'Pembuatan Website', 'kategori' => 'Pemrograman'],
            ]
        ];

        return view('admin.kelola', $data);
    }
}
