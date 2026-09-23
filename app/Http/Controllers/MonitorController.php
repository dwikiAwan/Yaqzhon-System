<?php

namespace App\Http\Controllers;

use App\Models\Monitor; // <-- PASTIKAN BARIS INI ADA
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index()
    {
        $monitors = Monitor::latest()->get();

        $stats = [
            'total' => $monitors->count(),
            'up' => $monitors->where('status', 'up')->count(),
            'down' => $monitors->where('status', 'down')->count(),
            'paused' => $monitors->where('status', 'paused')->count(),
            'avg_response' => round($monitors->avg('last_response_time') ?? 0),
        ];

        return view('dashboard', compact('monitors', 'stats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url_or_ip' => 'required|url',
            'type' => 'required|in:http,ping,port,keyword',
            'check_interval' => 'required|integer|min:1',
        ]);

        Monitor::create($validated);

        return redirect()->route('dashboard')->with('success', 'Monitor berhasil ditambahkan!');
    }
}