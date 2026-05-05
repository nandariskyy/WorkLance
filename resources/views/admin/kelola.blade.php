@extends('layouts.admin')

@section('title', 'Kelola Kategori & Jasa | Admin WorkLance')

@section('content')
<!-- Page Title & Action -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-dark mb-1">Kelola Kategori & Jasa</h1>
    <p class="text-gray-500">Atur kategori layanan, jasa, dan satuan tarif.</p>
</div>

<!-- Tabs -->
@php
    $activeTab = request('tab', 'kategori');
@endphp
<div class="flex gap-1 mb-8 bg-gray-100 rounded-xl p-1 w-fit">
    <a href="{{ route('admin.kelola', ['tab' => 'kategori']) }}" class="px-5 py-2.5 rounded-lg text-sm font-bold transition-colors {{ $activeTab === 'kategori' ? 'bg-white text-dark shadow-sm' : 'text-gray-500 hover:text-dark' }}">Kategori</a>
    <a href="{{ route('admin.kelola', ['tab' => 'jasa']) }}" class="px-5 py-2.5 rounded-lg text-sm font-bold transition-colors {{ $activeTab === 'jasa' ? 'bg-white text-dark shadow-sm' : 'text-gray-500 hover:text-dark' }}">Jasa</a>
</div>

@if ($activeTab === 'kategori')
<!-- ============ KATEGORI TAB ============ -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-dark text-lg mb-4">Tambah Kategori</h3>
        <form class="space-y-4">
        <div>
            <label class="block text-sm font-bold text-dark mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
            <input type="text" name="nama_kategori" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-accent focus:bg-white text-sm text-dark font-medium" placeholder="cth: Desain & Kreatif">
        </div>
        <div class="flex gap-3">
            <button type="button" class="flex-1 py-2.5 bg-accent text-white text-sm font-bold rounded-xl shadow-md hover:bg-orange-700 transition-colors cursor-pointer">Simpan</button>
        </div>
        </form>
    </div>

    <!-- List -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
        <h3 class="font-bold text-dark text-lg">Daftar Kategori ({{ count($kategoriList ?? []) }})</h3>
        </div>
        <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
            <tr class="bg-gray-50/50 text-gray-500 text-xs uppercase tracking-wider">
                <th class="p-4 pl-6 font-semibold">ID</th>
                <th class="p-4 font-semibold">Nama Kategori</th>
                <th class="p-4 font-semibold pr-6 text-right">Aksi</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @forelse ($kategoriList ?? [] as $kat)
            <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="p-4 pl-6 text-sm text-gray-500">{{ $kat['id_kategori'] }}</td>
                <td class="p-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    </div>
                    <p class="font-bold text-dark text-sm">{{ $kat['nama_kategori'] }}</p>
                </div>
                </td>
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
            <tr><td colspan="3" class="p-8 text-center text-gray-400">Belum ada data kategori.</td></tr>
            @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@elseif ($activeTab === 'jasa')
<!-- ============ JASA TAB ============ -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-dark text-lg mb-4">Tambah Jasa</h3>
        <form class="space-y-4">
        <div>
            <label class="block text-sm font-bold text-dark mb-1.5">Kategori <span class="text-red-500">*</span></label>
            <select name="id_kategori_jasa" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-accent focus:bg-white text-sm text-dark font-medium">
            <option value="">-- Pilih Kategori --</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-bold text-dark mb-1.5">Nama Jasa <span class="text-red-500">*</span></label>
            <input type="text" name="nama_jasa" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-accent focus:bg-white text-sm text-dark font-medium" placeholder="cth: Desain Logo">
        </div>
        <div class="flex gap-3">
            <button type="submit" class="flex-1 py-2.5 bg-accent text-white text-sm font-bold rounded-xl shadow-md hover:bg-orange-700 transition-colors cursor-pointer">Simpan</button>
        </div>
        </form>
    </div>

    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
        <h3 class="font-bold text-dark text-lg">Daftar Jasa ({{ count($jasaList ?? []) }})</h3>
        </div>
        <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
            <tr class="bg-gray-50/50 text-gray-500 text-xs uppercase tracking-wider">
                <th class="p-4 pl-6 font-semibold">ID</th>
                <th class="p-4 font-semibold">Nama Jasa</th>
                <th class="p-4 font-semibold">Kategori</th>
                <th class="p-4 font-semibold pr-6 text-right">Aksi</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @forelse ($jasaList ?? [] as $js)
            <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="p-4 pl-6 text-sm text-gray-500">{{ $js['id_jasa'] }}</td>
                <td class="p-4 font-bold text-dark text-sm">{{ $js['nama_jasa'] }}</td>
                <td class="p-4">
                <span class="px-3 py-1 bg-blue-50 text-blue-600 border border-blue-200 rounded-full text-[11px] font-bold inline-block">{{ $js['kategori'] ?? '-' }}</span>
                </td>
                <td class="p-4 pr-6 text-right">
                <div class="flex items-center justify-end gap-2">
                    <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="p-8 text-center text-gray-400">Belum ada data jasa.</td></tr>
            @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endif

@endsection
