@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="mb-lg">
  <p class="font-body-md text-body-md text-on-surface-variant">Ringkasan kondisi perpustakaan hari ini.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-md mb-xl">
  <div class="bg-surface rounded-lg p-md shadow-[0px_4px_12px_rgba(0,0,0,0.05)] border border-surface-variant flex items-start gap-md">
    <div class="w-12 h-12 rounded bg-primary-container text-on-primary-container flex items-center justify-center shrink-0">
      <span class="material-symbols-outlined text-2xl">group</span>
    </div>
    <div>
      <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-xs">Total Anggota</p>
      <p class="font-display text-display text-primary">{{ $totalAnggota }}</p>
    </div>
  </div>

  <div class="bg-surface rounded-lg p-md shadow-[0px_4px_12px_rgba(0,0,0,0.05)] border border-surface-variant flex items-start gap-md">
    <div class="w-12 h-12 rounded bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center shrink-0">
      <span class="material-symbols-outlined text-2xl">menu_book</span>
    </div>
    <div>
      <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-xs">Total Stok Buku</p>
      <p class="font-display text-display text-primary">{{ $totalBuku }}</p>
      <p class="font-body-sm text-body-sm text-on-surface-variant mt-sm">{{ $pinjamanAktif }} sedang dipinjam</p>
    </div>
  </div>

  <div class="bg-surface rounded-lg p-md shadow-[0px_4px_12px_rgba(0,0,0,0.05)] border border-surface-variant flex items-start gap-md">
    <div class="w-12 h-12 rounded bg-error-container text-on-error-container flex items-center justify-center shrink-0">
      <span class="material-symbols-outlined text-2xl">account_balance_wallet</span>
    </div>
    <div>
      <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-xs">Total Denda</p>
      <p class="font-display text-display text-primary">Rp {{ number_format($totalDenda, 0, ',', '.') }}</p>
    </div>
  </div>
</div>

<div class="bg-surface rounded-lg shadow-[0px_4px_12px_rgba(0,0,0,0.05)] border border-surface-variant overflow-hidden">
  <div class="p-md border-b border-surface-variant bg-surface-container-lowest">
    <h2 class="font-headline-sm text-headline-sm text-primary">Transaksi Terbaru</h2>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
      <thead>
        <tr class="bg-surface-container-low border-b border-surface-variant">
          <th class="p-md font-label-sm text-label-sm text-on-surface-variant uppercase">ID</th>
          <th class="p-md font-label-sm text-label-sm text-on-surface-variant uppercase">Anggota</th>
          <th class="p-md font-label-sm text-label-sm text-on-surface-variant uppercase">Buku</th>
          <th class="p-md font-label-sm text-label-sm text-on-surface-variant uppercase">Jatuh Tempo</th>
          <th class="p-md font-label-sm text-label-sm text-on-surface-variant uppercase">Status</th>
        </tr>
      </thead>
      <tbody class="font-body-sm text-body-sm text-on-surface">
        @forelse ($transaksiTerbaru as $t)
          <tr class="border-b border-surface-variant hover:bg-surface-container-lowest transition-colors">
            <td class="p-md font-label-md text-label-md">#TRX-{{ $t->id_transaksi }}</td>
            <td class="p-md">{{ $t->anggota->nama_anggota ?? '-' }}</td>
            <td class="p-md">{{ $t->buku->judul_buku ?? '-' }}</td>
            <td class="p-md">{{ $t->tanggal_jatuh_tempo?->format('d M Y') }}</td>
            <td class="p-md">
              <span class="inline-flex items-center px-sm py-xs rounded-full font-label-sm text-label-sm
                {{ $t->status_transaksi === 'Dipinjam' ? 'bg-tertiary-fixed text-on-tertiary-fixed-variant' : ($t->status_transaksi === 'Terlambat' ? 'bg-error-container text-on-error-container' : 'bg-primary-container text-on-primary-container') }}">
                {{ $t->status_transaksi }}
              </span>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="p-md text-center text-on-surface-variant">Belum ada transaksi.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection