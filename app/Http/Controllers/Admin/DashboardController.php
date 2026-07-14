<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count();
        $totalBuku = Buku::sum('stok');
        $pinjamanAktif = Transaksi::where('status_transaksi', 'Dipinjam')->count();
        $totalDenda = Transaksi::where('denda', '>', 0)->sum('denda');

        $transaksiTerbaru = Transaksi::with(['anggota', 'buku'])
            ->latest('id_transaksi')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('totalAnggota', 'totalBuku', 'pinjamanAktif', 'totalDenda', 'transaksiTerbaru'));
    }
}