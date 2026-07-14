@extends('layouts.admin')

@section('title', 'Transaksi')
@section('page-title', 'Validasi Peminjaman & Pengembalian')

@section('content')
<div class="bg-surface-container-lowest rounded-xl shadow-[0px_4px_12px_rgba(0,0,0,0.05)] border border-outline-variant overflow-hidden mb-xl">
  <div class="p-md border-b border-outline-variant bg-surface-container-low">
    <h2 class="font-headline-sm text-headline-sm text-primary">Sedang Dipinjam / Terlambat</h2>
  </div>
  <table class="w-full text-left border-collapse">
    <thead class="bg-surface-container-low border-b border-outline-variant">
      <tr>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant">ID Transaksi</th>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant">Anggota</th>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant">Buku</th>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant">Tgl Pinjam</th>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant">Tenggat</th>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant">Status</th>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant text-right">Aksi</th>
      </tr>
    </thead>
    <tbody class="font-body-sm text-body-sm">
      @forelse ($transaksis as $t)
        @php $telat = \Carbon\Carbon::today()->gt($t->tanggal_jatuh_tempo); @endphp
        <tr class="border-b border-outline-variant/50 hover:bg-surface-container-lowest">
          <td class="py-sm px-md font-medium">TRX-{{ str_pad($t->id_transaksi, 4, '0', STR_PAD_LEFT) }}</td>
          <td class="py-sm px-md">{{ $t->anggota->nama_anggota }}</td>
          <td class="py-sm px-md">{{ \Illuminate\Support\Str::limit($t->buku->judul_buku, 30) }}</td>
          <td class="py-sm px-md">{{ $t->tanggal_pinjam->format('d M Y') }}</td>
          <td class="py-sm px-md {{ $telat ? 'text-error font-medium' : '' }}">{{ $t->tanggal_jatuh_tempo->format('d M Y') }}</td>
          <td class="py-sm px-md">
            @if ($telat)
              <span class="inline-flex items-center px-2 py-1 rounded bg-error/10 text-error font-label-sm text-label-sm">Terlambat</span>
            @else
              <span class="inline-flex items-center px-2 py-1 rounded bg-tertiary-fixed text-on-tertiary-fixed-variant font-label-sm text-label-sm">Dipinjam</span>
            @endif
          </td>
          <td class="py-sm px-md text-right">
            @if ($t->status_transaksi === 'Terlambat' && $t->tanggal_kembali)
             <form method="POST" action="{{ route('admin.transaksi.lunas', $t) }}" onsubmit="return confirm('Konfirmasi denda sudah dibayar tunai?');" class="inline">
                 @csrf
                 <button type="submit" class="text-primary hover:underline font-label-md">Konfirmasi Lunas</button>
                </form>
             @else
                 <a href="{{ route('admin.transaksi.show', $t) }}" class="text-primary hover:underline font-label-md">Proses</a>
            @endif
          </td>
        </tr>
      @empty
        <tr><td colspan="7" class="p-md text-center text-on-surface-variant">Tidak ada peminjaman aktif.</td></tr>
      @endforelse
    </tbody>
  </table>
  <div class="p-md border-t border-outline-variant">{{ $transaksis->links() }}</div>
</div>

<div class="bg-surface-container-lowest rounded-xl shadow-[0px_4px_12px_rgba(0,0,0,0.05)] border border-outline-variant overflow-hidden">
  <div class="p-md border-b border-outline-variant bg-surface-container-low">
    <h2 class="font-headline-sm text-headline-sm text-primary">Riwayat Selesai (10 terbaru)</h2>
  </div>
  <table class="w-full text-left border-collapse">
    <thead class="bg-surface-container-low border-b border-outline-variant">
      <tr>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant">ID</th>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant">Anggota</th>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant">Buku</th>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant">Tgl Kembali</th>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant">Denda</th>
      </tr>
    </thead>
    <tbody class="font-body-sm text-body-sm">
      @forelse ($riwayatSelesai as $t)
        <tr class="border-b border-outline-variant/50">
          <td class="py-sm px-md">TRX-{{ str_pad($t->id_transaksi, 4, '0', STR_PAD_LEFT) }}</td>
          <td class="py-sm px-md">{{ $t->anggota->nama_anggota }}</td>
          <td class="py-sm px-md">{{ \Illuminate\Support\Str::limit($t->buku->judul_buku, 30) }}</td>
          <td class="py-sm px-md">{{ $t->tanggal_kembali?->format('d M Y') }}</td>
          <td class="py-sm px-md">{{ $t->denda > 0 ? 'Rp ' . number_format($t->denda, 0, ',', '.') . ' (lunas)' : '-' }}</td>
        </tr>
      @empty
        <tr><td colspan="5" class="p-md text-center text-on-surface-variant">Belum ada riwayat.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection