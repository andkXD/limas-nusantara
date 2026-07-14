<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['anggota', 'buku'])
            ->whereIn('status_transaksi', ['Dipinjam', 'Terlambat'])
            ->orderBy('tanggal_jatuh_tempo')
            ->paginate(10);

        // riwayat yang sudah selesai, buat referensi/laporan
        $riwayatSelesai = Transaksi::with(['anggota', 'buku'])
            ->where('status_transaksi', 'Dikembalikan')
            ->orderByDesc('id_transaksi')
            ->limit(10)
            ->get();

        return view('admin.transaksi.index', compact('transaksis', 'riwayatSelesai'));
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['anggota', 'buku']);

        $keterlambatanHari = Carbon::today()->gt($transaksi->tanggal_jatuh_tempo)
            ? Carbon::parse($transaksi->tanggal_jatuh_tempo)->diffInDays(Carbon::today())
            : 0;

        $estimasiDenda = $keterlambatanHari * 2000;

        return view('admin.transaksi.proses', compact('transaksi', 'keterlambatanHari', 'estimasiDenda'));
    }

    // Admin memvalidasi fisik buku diterima kembali
    public function prosesPengembalian(Transaksi $transaksi)
    {
        $admin = Auth::guard('admin')->user();

        $transaksi->update([
            'tanggal_kembali' => Carbon::today(),
            'id_admin' => $admin->id_admin,
        ]);

        $denda = $transaksi->hitungDenda();

        $transaksi->update([
            'denda' => $denda,
            'status_transaksi' => $denda > 0 ? 'Terlambat' : 'Dikembalikan',
        ]);

        // stok kembali bertambah
        $transaksi->buku()->increment('stok');

        $pesan = $denda > 0
            ? 'Pengembalian dicatat. Anggota terkena denda Rp ' . number_format($denda, 0, ',', '.') . '.'
            : 'Pengembalian berhasil dicatat, tidak ada keterlambatan.';

        return redirect()->route('admin.transaksi.index')->with('success', $pesan);
    }

    // Konfirmasi setelah anggota membayar denda tunai ke admin
    public function konfirmasiLunas(Transaksi $transaksi)
    {
        $transaksi->update(['status_transaksi' => 'Dikembalikan']);

        return redirect()->route('admin.transaksi.index')->with('success', 'Denda dinyatakan lunas, transaksi selesai.');
    }
}