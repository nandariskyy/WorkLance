@extends('layouts.admin')

@section('title', 'Kelola Booking | Admin WorkLance')

@section('content')
<!-- Page Title & Action -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-dark mb-1">Kelola Booking</h1>
    <p class="text-gray-500">Pantau dan kelola semua booking yang masuk.</p>
</div>

<!-- Status Stats (Mock Data) -->
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
    <a href="#" class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow text-center ring-2 ring-accent">
        <p class="text-2xl font-bold text-dark">{{ count($bookingList ?? []) }}</p>
        <p class="text-xs text-gray-500 font-medium mt-1">Semua</p>
    </a>
    <a href="#" class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow text-center">
        <p class="text-2xl font-bold text-yellow-600">1</p>
        <p class="text-xs text-gray-500 font-medium mt-1">Diproses</p>
    </a>
    <a href="#" class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow text-center">
        <p class="text-2xl font-bold text-green-600">1</p>
        <p class="text-xs text-gray-500 font-medium mt-1">Selesai</p>
    </a>
    <a href="#" class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow text-center">
        <p class="text-2xl font-bold text-red-600">0</p>
        <p class="text-xs text-gray-500 font-medium mt-1">Dibatalkan</p>
    </a>
</div>

<!-- Filter Tabs -->
<div class="flex gap-2 mb-6 flex-wrap">
    <a href="#" class="px-4 py-2 rounded-lg text-sm font-bold transition-colors bg-dark text-white">Semua</a>
    <a href="#" class="px-4 py-2 rounded-lg text-sm font-bold transition-colors bg-white text-gray-600 border border-gray-200 hover:bg-gray-50">Menunggu</a>
    <a href="#" class="px-4 py-2 rounded-lg text-sm font-bold transition-colors bg-white text-gray-600 border border-gray-200 hover:bg-gray-50">Diproses</a>
    <a href="#" class="px-4 py-2 rounded-lg text-sm font-bold transition-colors bg-white text-gray-600 border border-gray-200 hover:bg-gray-50">Selesai</a>
    <a href="#" class="px-4 py-2 rounded-lg text-sm font-bold transition-colors bg-white text-gray-600 border border-gray-200 hover:bg-gray-50">Dibatalkan</a>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[800px]">
        <thead>
            <tr class="bg-gray-50/50 text-gray-500 text-xs uppercase tracking-wider">
            <th class="p-4 pl-6 font-semibold">ID</th>
            <th class="p-4 font-semibold">Client</th>
            <th class="p-4 font-semibold">Freelancer</th>
            <th class="p-4 font-semibold">Jasa</th>
            <th class="p-4 font-semibold">Tanggal</th>
            <th class="p-4 font-semibold">Status</th>
            <th class="p-4 font-semibold pr-6 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($bookingList ?? [] as $bk)
            <tr class="hover:bg-gray-50/50 transition-colors">
            <td class="p-4 pl-6 text-sm text-gray-500">{{ $bk['id_booking'] }}</td>
            <td class="p-4">
                <p class="font-bold text-dark text-sm whitespace-nowrap">{{ $bk['nama_client'] }}</p>
            </td>
            <td class="p-4 text-sm font-semibold text-accent whitespace-nowrap">{{ $bk['nama_freelancer'] }}</td>
            <td class="p-4 text-sm text-gray-600">{{ $bk['nama_jasa'] }}</td>
            <td class="p-4 text-sm text-gray-500 whitespace-nowrap">{{ $bk['tanggal_booking'] }}</td>
            <td class="p-4">
                @php
                $statusBadge = 'bg-gray-100 text-gray-600 border-gray-200';
                if (($bk['status_booking'] ?? '') == 'MENUNGGU') $statusBadge = 'bg-gray-100 text-gray-600 border-gray-200';
                if (($bk['status_booking'] ?? '') == 'DIPROSES') $statusBadge = 'bg-yellow-50 text-yellow-600 border-yellow-200';
                if (($bk['status_booking'] ?? '') == 'SELESAI') $statusBadge = 'bg-green-50 text-green-600 border-green-200';
                if (($bk['status_booking'] ?? '') == 'DIBATALKAN') $statusBadge = 'bg-red-50 text-red-600 border-red-200';
                @endphp
                <span class="px-3 py-1 {{ $statusBadge }} rounded-full text-[11px] font-bold border inline-block whitespace-nowrap">{{ $bk['status_booking'] }}</span>
            </td>
            <td class="p-4 pr-6 text-right">
                <div class="flex items-center justify-end gap-2">
                <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Detail">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </button>
                <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
                </div>
            </td>
            </tr>
            @empty
            <tr><td colspan="7" class="p-8 text-center text-gray-400">Tidak ada data booking.</td></tr>
            @endforelse
        </tbody>
        </table>
    </div>
</div>
@endsection
