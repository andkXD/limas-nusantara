@extends('layouts.admin')

@section('title', 'Proses Transaksi')
@section('page-title', 'Validasi Pengembalian Buku')

@section('content')
<div class="max-w-2xl bg-surface rounded-xl shadow-[0px_12px_24px_rgba(0,0,0,0.1)] border border-outline-variant/20 p-lg">
  <p class="font-label-sm text-label-sm text-on-surface-variant mb-lg">ID: TRX-{{ str_pad($transaksi->id_transaksi, 4, '0', STR_PAD_LEFT) }}</p>

  <div class="grid grid-cols-2 gap-md mb-lg">
    <div class="bg-surface-container-lowest p-sm rounded-lg border border-outline-variant/30 flex items-start gap-sm">
      <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center shrink-0">
        <span class="material-symbols-outlined text-on-surface-variant">person</span>
      </div>
      <div>
        <p class="font-label-sm text-label-sm text-on-surface-variant mb-xs">Anggota</p>
        <p class="font-body-md text-body-md font-medium text-on-surface">{{ $transaksi->anggota->nama_anggota }}</p>
        <p class="font-label-sm text-label-sm text-on-surface-variant">{{ $transaksi->anggota->email }}</p>
      </div>
    </div>
    <div class="bg-surface-container-lowest p-sm rounded-lg border border-outline-variant/30 flex items-start gap-sm">
      <div class="w-8 h-10 bg-surface-container-high rounded shrink-0 flex items-center justify-center border border-outline-variant/50">
        <span class="material-symbols-outlined text-on-surface-variant text-[16px]">book</span>
      </div>
      <div>
        <p class="font-label-sm text-label-sm text-on-surface-variant mb-xs">Buku</p>
        <p class="font-body-sm text-body-sm font-medium text-on-surface">{{ $transaksi->buku->judul_buku }}</p>
      </div>
    </div>
  </div>

  @if ($keterlambatanHari > 0)
    <div class="bg-error/5 rounded-lg border border-error/20 p-md flex flex-col items-center text-center mb-lg">
      <div class="flex items-center gap-sm text-error mb-sm">
        <span class="material-symbols-outlined text-[24px]">warning</span>
        <span class="font-headline-sm text-headline-sm font-bold tracking-tight">TERLAMBAT PENGEMBALIAN</span>
      </div>
      <div class="flex justify-center gap-xl w-full max-w-md mx-auto mb-md border-t border-b border-error/10 py-sm">
        <div>
          <p class="font-label-sm text-label-sm text-error/80 mb-xs">Tenggat Waktu</p>
          <p class="font-body-md text-body-md text-error font-medium">{{ $transaksi->tanggal_jatuh_tempo->format('d M Y') }}</p>
        </div>
        <div class="w-px bg-error/10"></div>
        <div>
          <p class="font-label-sm text-label-sm text-error/80 mb-xs">Keterlambatan</p>
          <p class="font-body-md text-body-md text-error font-medium">{{ $keterlambatanHari }} Hari</p>
        </div>
      </div>
      <div>
        <p class="font-label-sm text-label-sm text-on-surface-variant mb-xs uppercase tracking-wider">Nominal Denda (Rp 2.000/hari)</p>
        <p class="font-display text-display text-error font-bold">Rp {{ number_format($estimasiDenda, 0, ',', '.') }}</p>
      </div>
    </div>
  @else
    <div class="bg-primary-container/40 rounded-lg border border-primary/20 p-md flex items-center gap-sm mb-lg">
      <span class="material-symbols-outlined text-primary">check_circle</span>
      <span class="font-label-md text-label-md text-on-primary-container">Pengembalian tepat waktu, tidak ada denda.</span>
    </div>
  @endif

  <div class="flex gap-sm">
    <form method="POST" action="{{ route('admin.transaksi.proses-pengembalian', $transaksi) }}" onsubmit="return confirm('Konfirmasi buku fisik sudah diterima?');">
      @csrf
      <button type="submit" class="bg-primary text-on-primary rounded-lg py-sm px-lg font-label-md hover:opacity-90">
        Konfirmasi Terima Buku
      </button>
    </form>
    <a href="{{ route('admin.transaksi.index') }}" class="text-on-surface-variant py-sm px-lg font-label-md hover:underline">Batal</a>
  </div>
</div>
@endsection