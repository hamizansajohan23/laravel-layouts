<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(): View
    {
        $user = auth()->user();
        $isAdmin = strtolower($user->role) === 'admin';

        // Statistik untuk dashboard (admin sahaja)
        $stats = [];
        $chartData = [];

        if ($isAdmin) {
            $stats = [
                'jumlah_pengguna' => User::count(),
                'pengguna_aktif' => User::where('status', 'aktif')->count(),
                'pengguna_tidak_aktif' => User::where('status', 'tidak_aktif')->count(),
                'permohonan_baru' => User::where('status', 'baru')->count(),
            ];

            // Data untuk graf bulanan (6 bulan terakhir)
            for ($i = 5; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $chartData['labels'][] = $date->translatedFormat('M');
                $chartData['pengguna'][] = User::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();
            }
        }

        return view('pages.dashboard', compact('stats', 'chartData', 'isAdmin'));
    }
}
