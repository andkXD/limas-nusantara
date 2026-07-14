<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('q');

        $bukus = Buku::when($keyword, function ($query) use ($keyword) {
                $query->where('judul_buku', 'like', "%{$keyword}%")
                      ->orWhere('pengarang', 'like', "%{$keyword}%")
                      ->orWhere('kategori', 'like', "%{$keyword}%");
            })
            ->orderBy('judul_buku')
            ->paginate(12)
            ->withQueryString();

        return view('member.katalog.index', compact('bukus', 'keyword'));
    }

    public function pinjam(Buku $buku)
    {
        $anggota = Auth::guard('web')->user();

        if ($anggota->status_keanggotaan !== 'Aktif') {
            return back()->with('error', 'Akun kamu sedang nonaktif, tidak bisa meminjam buku. Hubungi admin.');
        }

        if ($buku->stok < 1) {
            return back()->with('error', 'Stok buku ini sedang kosong.');
        }

        $sedangDipinjam = Transaksi::where('id_anggota', $anggota->id_anggota)
            ->where('id_buku', $buku->id_buku)
            ->whereIn('status_transaksi', ['Dipinjam', 'Terlambat'])
            ->exists();

        if ($sedangDipinjam) {
            return back()->with('error', 'Kamu masih meminjam buku ini, kembalikan dulu sebelum pinjam lagi.');
        }

        Transaksi::create([
            'id_anggota' => $anggota->id_anggota,
            'id_buku' => $buku->id_buku,
            'tanggal_pinjam' => Carbon::today(),
            'tanggal_jatuh_tempo' => Carbon::today()->addDays(7),
            'status_transaksi' => 'Dipinjam',
        ]);

        $buku->decrement('stok');

        return redirect()->route('member.dashboard')->with('success', 'Peminjaman "' . $buku->judul_buku . '" berhasil diajukan. Jatuh tempo 7 hari dari sekarang.');
    }
}