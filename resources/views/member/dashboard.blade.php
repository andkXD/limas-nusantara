@extends('layouts.member')

@section('title', 'Beranda')

@section('content')
<h1 class="font-headline-lg text-headline-lg text-primary mb-sm">Halo, {{ $anggota->nama_anggota }} 👋</h1>
<p class="font-body-md text-body-md text-on-surface-variant mb-lg">Berikut ringkasan aktivitas peminjaman kamu.</p>

<div class="grid grid-cols-1 md:grid-cols-2 gap-md mb-xl">
  <div class="bg-surface rounded-lg p-md shadow-[0px_4px_12px_rgba(0,0,0,0.05)] border border-surface-variant flex items-center gap-md">
    <div class="w-12 h-12 rounded bg-primary-container text-on-primary-container flex items-center justify-center">
      <span class="material-symbols-outlined text-2xl">menu_book</span>
    </div>
    <div>
      <p class="font-label-sm text-label-sm text-on-surface-variant uppercase mb-xs">Sedang Dipinjam</p>
      <p class="font-display text-display text-primary">{{ $pinjamanAktif }}</p>
    </div>
  </div>
  <div class="bg-surface rounded-lg p-md shadow-[0px_4px_12px_rgba(0,0,0,0.05)] border border-surface-variant flex items-center gap-md">
    <div class="w-12 h-12 rounded bg-error-container text-on-error-container flex items-center justify-center">
      <span class="material-symbols-outlined text-2xl">account_balance_wallet</span>
    </div>
    <div>
      <p class="font-label-sm text-label-sm text-on-surface-variant uppercase mb-xs">Denda Belum Lunas</p>
      <p class="font-display text-display text-primary">Rp {{ number_format($totalDenda, 0, ',', '.') }}</p>
    </div>
  </div>
</div>

<div class="bg-surface rounded-lg shadow-[0px_4px_12px_rgba(0,0,0,0.05)] border border-surface-variant overflow-hidden">
  <div class="p-md border-b border-surface-variant bg-surface-container-lowest flex justify-between items-center">
    <h2 class="font-headline-sm text-headline-sm text-primary">Peminjaman Berjalan</h2>
    <a href="{{ route('member.katalog.index') }}" class="font-label-md text-label-md text-primary hover:underline">+ Pinjam Buku Baru</a>
  </div>
  <div class="divide-y divide-outline-variant">
    @forelse ($pinjamanBerjalan as $t)
      <div class="p-md flex justify-between items-center">
        <div>
          <p class="font-label-md text-label-md text-on-surface">{{ $t->buku->judul_buku }}</p>
          <p class="font-body-sm text-body-sm text-on-surface-variant">Jatuh tempo: {{ $t->tanggal_jatuh_tempo->format('d M Y') }}</p>
        </div>
        <span class="inline-flex items-center px-sm py-xs rounded-full font-label-sm text-label-sm
          {{ $t->status_transaksi === 'Terlambat' ? 'bg-error-container text-on-error-container' : 'bg-tertiary-fixed text-on-tertiary-fixed-variant' }}">
          {{ $t->status_transaksi }}
        </span>
      </div>
    @empty
      <p class="p-md text-center text-on-surface-variant">Tidak ada peminjaman aktif saat ini.</p>
    @endforelse
  </div>
</div>
@endsection