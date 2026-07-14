<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function riwayat()
    {
        $anggota = Auth::guard('web')->user();

        $riwayat = $anggota->transaksis()
            ->with('buku')
            ->orderByDesc('id_transaksi')
            ->paginate(10);

        return view('member.riwayat', compact('riwayat'));
    }
}