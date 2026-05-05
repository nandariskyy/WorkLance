@extends('layouts.admin')

@section('title', 'Verifikasi Pengajuan | Admin WorkLance')

@section('content')
<!-- Page Title & Action -->
<div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold text-dark mb-1">Verifikasi Pendaftaran Freelancer</h1>
        <p class="text-gray-500">Total {{ count($pengajuanList ?? []) }} pengajuan telah diinput masuk.</p>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[900px]">
        <thead>
            <tr class="bg-gray-50/50 text-gray-500 text-xs uppercase tracking-wider">
            <th class="p-4 pl-6 font-semibold">Tanggal</th>
            <th class="p-4 font-semibold">Nama Pengguna</th>
            <th class="p-4 font-semibold">Kategori Diajukan</th>
            <th class="p-4 font-semibold">Status</th>
            <th class="p-4 font-semibold pr-6 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($pengajuanList ?? [] as $pj)
            <tr class="hover:bg-gray-50/50 transition-colors">
            <td class="p-4 pl-6 text-sm text-gray-500 whitespace-nowrap">
                {{ $pj['tanggal_pengajuan'] }}
            </td>
            <td class="p-4">
                <div class="font-bold text-dark text-sm">{{ $pj['nama_pengguna'] }}</div>
            </td>
            <td class="p-4 text-sm font-medium text-dark whitespace-nowrap">
                {{ $pj['kategori_diajukan'] ?? '-' }}
            </td>
            <td class="p-4">
                @if (($pj['status'] ?? '') === 'MENUNGGU')
                <span class="px-2.5 py-1 bg-yellow-50 text-yellow-600 border border-yellow-200 rounded-md text-[11px] font-bold tracking-wide">MENUNGGU</span>
                @elseif (($pj['status'] ?? '') === 'DITERIMA')
                <span class="px-2.5 py-1 bg-green-50 text-green-600 border border-green-200 rounded-md text-[11px] font-bold tracking-wide">DITERIMA</span>
                @else
                <span class="px-2.5 py-1 bg-red-50 text-red-600 border border-red-200 rounded-md text-[11px] font-bold tracking-wide">DITOLAK</span>
                @endif
            </td>
            <td class="p-4 pr-6 text-right">
                <div class="flex items-center justify-end gap-2">
                @if (($pj['status'] ?? '') === 'MENUNGGU')
                    <button type="button" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors cursor-pointer" title="Terima">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </button>
                    <button type="button" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors cursor-pointer" title="Tolak">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                @endif
                <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Detail">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </button>
                </div>
            </td>
            </tr>
            @empty
            <tr><td colspan="5" class="p-8 text-center text-gray-400">Belum ada data pengajuan freelancer.</td></tr>
            @endforelse
        </tbody>
        </table>
    </div>
</div>
@endsection
