<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $anggota = Auth::guard('web')->user();

        $pinjamanAktif = $anggota->transaksis()->where('status_transaksi', 'Dipinjam')->count();
        $totalDenda = $anggota->transaksis()->where('denda', '>', 0)
            ->where('status_transaksi', 'Terlambat')->sum('denda');

        $pinjamanBerjalan = $anggota->transaksis()
            ->with('buku')
            ->whereIn('status_transaksi', ['Dipinjam', 'Terlambat'])
            ->orderBy('tanggal_jatuh_tempo')
            ->get();

        return view('member.dashboard', compact('anggota', 'pinjamanAktif', 'totalDenda', 'pinjamanBerjalan'));
    }
}