<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $totalAlat = Alat::count();
        $totalKategori = Kategori::count();
        $totalPeminjaman = Peminjaman::count();
        $peminjamanAktif = Peminjaman::where('status', 'dipinjam')->count();
        $peminjamanMenunggu = Peminjaman::where('status', 'menunggu')->count();
        
        $stokTotal = Alat::sum('stok');
        $stokTersedia = Alat::sum('stok_tersedia');
        $stokRusak = Alat::where('kondisi', 'rusak')->orWhere('kondisi', 'perlu perbaikan')->sum('stok');
        
        $alatTerbaru = Alat::with('kategori')
            ->latest()
            ->take(5)
            ->get();
        
        $peminjamanTerbaru = Peminjaman::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalAlat',
            'totalKategori',
            'totalPeminjaman',
            'peminjamanAktif',
            'peminjamanMenunggu',
            'stokTotal',
            'stokTersedia',
            'stokRusak',
            'alatTerbaru',
            'peminjamanTerbaru'
        ));
    }

    /**
     * Display dashboard for admin.
     */
    public function admin()
    {
        $stats = [
            'total_alat' => Alat::count(),
            'total_kategori' => Kategori::count(),
            'total_peminjaman' => Peminjaman::count(),
            'peminjaman_aktif' => Peminjaman::where('status', 'dipinjam')->count(),
            'peminjaman_menunggu' => Peminjaman::where('status', 'menunggu')->count(),
            'peminjaman_terlambat' => Peminjaman::where('status', 'terlambat')->count(),
        ];

        $peminjamanMenunggu = Peminjaman::with(['user', 'details.alat'])
            ->where('status', 'menunggu')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'peminjamanMenunggu'));
    }

    /**
     * Display dashboard for user.
     */
    public function user()
    {
        $user = Auth::user();
        
        $peminjamanAktif = Peminjaman::with(['details.alat'])
            ->where('user_id', $user->id)
            ->whereIn('status', ['disetujui', 'dipinjam'])
            ->latest()
            ->get();

        $riwayatPeminjaman = Peminjaman::with(['details.alat'])
            ->where('user_id', $user->id)
            ->whereIn('status', ['dikembalikan', 'ditolak'])
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact('peminjamanAktif', 'riwayatPeminjaman'));
    }
}
