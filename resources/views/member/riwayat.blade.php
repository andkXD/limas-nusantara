@extends('layouts.member')

@section('title', 'Riwayat Peminjaman')

@section('content')
<h1 class="font-headline-lg text-headline-lg text-primary mb-lg">Riwayat Peminjaman</h1>

<div class="bg-surface rounded-lg shadow-[0px_4px_12px_rgba(0,0,0,0.05)] border border-surface-variant overflow-hidden">
  <table class="w-full text-left border-collapse">
    <thead>
      <tr class="bg-surface-container-low border-b border-surface-variant">
        <th class="p-md font-label-sm text-label-sm text-on-surface-variant uppercase">Buku</th>
        <th class="p-md font-label-sm text-label-sm text-on-surface-variant uppercase">Tgl Pinjam</th>
        <th class="p-md font-label-sm text-label-sm text-on-surface-variant uppercase">Jatuh Tempo</th>
        <th class="p-md font-label-sm text-label-sm text-on-surface-variant uppercase">Tgl Kembali</th>
        <th class="p-md font-label-sm text-label-sm text-on-surface-variant uppercase">Status</th>
        <th class="p-md font-label-sm text-label-sm text-on-surface-variant uppercase">Denda</th>
      </tr>
    </thead>
    <tbody class="font-body-sm text-body-sm text-on-surface">
      @forelse ($riwayat as $t)
        <tr class="border-b border-surface-variant">
          <td class="p-md">{{ $t->buku->judul_buku }}</td>
          <td class="p-md">{{ $t->tanggal_pinjam->format('d M Y') }}</td>
          <td class="p-md">{{ $t->tanggal_jatuh_tempo->format('d M Y') }}</td>
          <td class="p-md">{{ $t->tanggal_kembali?->format('d M Y') ?? '-' }}</td>
          <td class="p-md">
            <span class="inline-flex items-center px-sm py-xs rounded-full font-label-sm text-label-sm
              {{ $t->status_transaksi === 'Dipinjam' ? 'bg-tertiary-fixed text-on-tertiary-fixed-variant' : ($t->status_transaksi === 'Terlambat' ? 'bg-error-container text-on-error-container' : 'bg-primary-container text-on-primary-container') }}">
              {{ $t->status_transaksi }}
            </span>
          </td>
          <td class="p-md">{{ $t->denda > 0 ? 'Rp ' . number_format($t->denda, 0, ',', '.') : '-' }}</td>
        </tr>
      @empty
        <tr><td colspan="6" class="p-md text-center text-on-surface-variant">Belum ada riwayat peminjaman.</td></tr>
      @endforelse
    </tbody>
  </table>
  <div class="p-md border-t border-surface-variant">
    {{ $riwayat->links() }}
  </div>
</div>
@endsection