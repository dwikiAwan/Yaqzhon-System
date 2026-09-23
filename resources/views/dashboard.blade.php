@extends('layouts.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto" x-data="{ showModal: false }">
    
    <!-- Header Page & Button Action -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Dashboard Monitoring</h1>
            <p class="text-sm text-gray-400">Pantau ketersediaan dan performa server secara real-time.</p>
        </div>
        <button 
            @click="showModal = true"
            class="bg-emerald-600 hover:bg-emerald-500 text-white font-medium px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Monitor
        </button>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-gray-800 p-4 rounded-xl border border-gray-700">
            <span class="text-xs text-gray-400 font-semibold uppercase">Total Monitor</span>
            <p class="text-2xl font-bold text-white mt-1">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-gray-800 p-4 rounded-xl border border-gray-700">
            <span class="text-xs text-gray-400 font-semibold uppercase">Up</span>
            <p class="text-2xl font-bold text-emerald-400 mt-1">{{ $stats['up'] }}</p>
        </div>
        <div class="bg-gray-800 p-4 rounded-xl border border-gray-700">
            <span class="text-xs text-gray-400 font-semibold uppercase">Down</span>
            <p class="text-2xl font-bold text-rose-500 mt-1">{{ $stats['down'] }}</p>
        </div>
        <div class="bg-gray-800 p-4 rounded-xl border border-gray-700">
            <span class="text-xs text-gray-400 font-semibold uppercase">Paused</span>
            <p class="text-2xl font-bold text-amber-400 mt-1">{{ $stats['paused'] }}</p>
        </div>
        <div class="bg-gray-800 p-4 rounded-xl border border-gray-700">
            <span class="text-xs text-gray-400 font-semibold uppercase">Rata-rata Respon</span>
            <p class="text-2xl font-bold text-blue-400 mt-1">{{ $stats['avg_response'] }} ms</p>
        </div>
    </div>

    <!-- Monitor List Table -->
    <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden shadow-xl">
        <table class="w-full text-left text-sm text-gray-300">
            <thead class="bg-gray-900/50 text-gray-400 uppercase text-xs border-b border-gray-700">
                <tr>
                    <th class="px-6 py-4">Nama Monitor</th>
                    <th class="px-6 py-4">URL / IP</th>
                    <th class="px-6 py-4">Tipe</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Response Time</th>
                    <th class="px-6 py-4">Terakhir Dicek</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($monitors as $monitor)
                <tr class="hover:bg-gray-700/30 transition-colors">
                    <td class="px-6 py-4 font-medium text-white">{{ $monitor->name }}</td>
                    <td class="px-6 py-4 font-mono text-xs text-gray-400">{{ $monitor->url_or_ip }}</td>
                    <td class="px-6 py-4 uppercase text-xs font-semibold text-gray-400">{{ $monitor->type }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold 
                            {{ $monitor->status === 'up' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : '' }}
                            {{ $monitor->status === 'down' ? 'bg-rose-500/10 text-rose-500 border border-rose-500/20' : '' }}
                            {{ $monitor->status === 'paused' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : '' }}">
                            {{ strtoupper($monitor->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-mono">{{ $monitor->last_response_time ?? 0 }} ms</td>
                    <td class="px-6 py-4 text-gray-400">{{ $monitor->last_checked_at?->diffForHumans() ?? 'Belum pernah' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                        Belum ada monitor yang ditambahkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection