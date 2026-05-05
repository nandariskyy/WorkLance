@extends('layouts.admin')

@section('title', 'Kelola Freelancer | Admin WorkLance')

@section('content')
<!-- Page Title & Action -->
<div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold text-dark mb-1">Kelola Freelancer</h1>
        <p class="text-gray-500">Total {{ count($freelancerList ?? []) }} freelancer terdaftar.</p>
    </div>
    <button onclick="document.getElementById('modalForm').classList.remove('hidden')" class="px-5 py-2.5 bg-accent text-white rounded-xl text-sm font-bold shadow-md hover:bg-orange-700 transition-colors flex items-center gap-2 cursor-pointer">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Freelancer
    </button>
</div>

<!-- Filter Tabs -->
<div class="flex gap-2 mb-6 flex-wrap">
    <a href="#" class="px-4 py-2 rounded-lg text-sm font-bold transition-colors bg-dark text-white">Semua</a>
    <a href="#" class="px-4 py-2 rounded-lg text-sm font-bold transition-colors bg-white text-gray-600 border border-gray-200 hover:bg-gray-50">Desain Grafis</a>
    <a href="#" class="px-4 py-2 rounded-lg text-sm font-bold transition-colors bg-white text-gray-600 border border-gray-200 hover:bg-gray-50">Pemrograman</a>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[900px]">
        <thead>
            <tr class="bg-gray-50/50 text-gray-500 text-xs uppercase tracking-wider">
            <th class="p-4 pl-6 font-semibold">ID</th>
            <th class="p-4 font-semibold">Nama</th>
            <th class="p-4 font-semibold">Kategori</th>
            <th class="p-4 font-semibold">Status</th>
            <th class="p-4 font-semibold pr-6 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($freelancerList ?? [] as $fl)
            <tr class="hover:bg-gray-50/50 transition-colors">
            <td class="p-4 pl-6 text-sm text-gray-500">{{ $fl['id_pengguna'] }}</td>
            <td class="p-4">
                <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-accent/10 text-accent flex items-center justify-center font-bold text-xs">{{ substr($fl['nama_pengguna'], 0, 1) }}</div>
                <div>
                    <p class="font-bold text-dark text-sm whitespace-nowrap">{{ $fl['nama_pengguna'] }}</p>
                    <p class="text-xs text-gray-400">{{ $fl['email'] }}</p>
                </div>
                </div>
            </td>
            <td class="p-4">
                <span class="px-3 py-1 bg-blue-50 text-blue-600 border border-blue-200 rounded-full text-[11px] font-bold inline-block">{{ $fl['kategori'] }}</span>
            </td>
            <td class="p-4 text-sm font-bold text-green-600">{{ $fl['status'] ?? 'Aktif' }}</td>
            <td class="p-4 pr-6 text-right">
                <div class="flex items-center justify-end gap-2">
                <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </button>
                <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
                </div>
            </td>
            </tr>
            @empty
            <tr><td colspan="5" class="p-8 text-center text-gray-400">Tidak ada data freelancer.</td></tr>
            @endforelse
        </tbody>
        </table>
    </div>
</div>

<!-- Modal Form -->
<div id="modalForm" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
<div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
    <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
    <h3 class="font-bold text-dark text-lg">Tambah Freelancer Baru</h3>
    <button onclick="document.getElementById('modalForm').classList.add('hidden')" class="p-2 text-gray-400 hover:text-dark hover:bg-gray-100 rounded-lg transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
    </div>
    <form class="p-6 space-y-4">
    <div>
        <label class="block text-sm font-bold text-dark mb-1.5">Pengguna (Role Freelancer) <span class="text-red-500">*</span></label>
        <select name="id_pengguna" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-accent focus:bg-white text-sm text-dark font-medium">
        <option value="">-- Pilih Pengguna --</option>
        </select>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
        <label class="block text-sm font-bold text-dark mb-1.5">Kategori <span class="text-red-500">*</span></label>
        <select name="id_kategori" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-accent focus:bg-white text-sm text-dark font-medium">
            <option value="">-- Pilih --</option>
        </select>
        </div>
        <div>
        <label class="block text-sm font-bold text-dark mb-1.5">Jasa <span class="text-red-500">*</span></label>
        <select name="id_jasa" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-accent focus:bg-white text-sm text-dark font-medium">
            <option value="">-- Pilih --</option>
        </select>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
        <label class="block text-sm font-bold text-dark mb-1.5">Tarif</label>
        <input type="text" name="tarif" placeholder="cth: 150000" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-accent focus:bg-white text-sm text-dark font-medium">
        </div>
        <div>
        <label class="block text-sm font-bold text-dark mb-1.5">Satuan</label>
        <select name="id_satuan" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-accent focus:bg-white text-sm text-dark font-medium">
            <option value="">-- Pilih --</option>
        </select>
        </div>
    </div>

    <div>
        <label class="block text-sm font-bold text-dark mb-1.5">Deskripsi</label>
        <textarea name="deskripsi" rows="3" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-accent focus:bg-white text-sm text-dark font-medium resize-none"></textarea>
    </div>

    <div class="flex gap-3 pt-4">
        <button type="button" onclick="document.getElementById('modalForm').classList.add('hidden')" class="flex-1 py-2.5 text-center text-sm font-bold text-gray-500 hover:bg-gray-50 rounded-xl border border-gray-200 transition-colors">Batal</button>
        <button type="button" class="flex-1 py-2.5 bg-accent text-white text-sm font-bold rounded-xl shadow-md hover:bg-orange-700 transition-colors cursor-pointer">Simpan</button>
    </div>
    </form>
</div>
</div>
@endsection
