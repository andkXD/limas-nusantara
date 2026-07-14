@extends('layouts.member')

@section('title', 'Katalog Buku')

@section('content')
<div class="flex justify-between items-end mb-lg flex-wrap gap-md">
  <div>
    <h1 class="font-headline-lg text-headline-lg text-primary">Katalog Buku</h1>
    <p class="font-body-sm text-body-sm text-on-surface-variant mt-xs">{{ $bukus->total() }} judul tersedia di perpustakaan.</p>
  </div>
  <form method="GET" class="relative w-full sm:w-80">
    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
    <input name="q" value="{{ $keyword }}" class="w-full pl-10 pr-3 py-2 bg-surface-container-low border border-outline-variant rounded-lg font-body-sm text-body-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Cari judul, pengarang, kategori..." type="text"/>
  </form>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-md">
  @forelse ($bukus as $buku)
    <article class="bg-surface-container-lowest rounded-lg overflow-hidden shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-outline-variant flex flex-col">
      <div class="p-md flex flex-col flex-grow">
        <div class="flex justify-between items-start mb-xs">
          <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-surface-variant text-on-surface-variant border border-outline-variant">{{ $buku->kategori }}</span>
          @if ($buku->stok > 0)
            <span class="bg-[rgba(34,197,94,0.1)] text-green-700 font-label-sm text-label-sm px-sm py-xs rounded-full border border-green-200">Tersedia ({{ $buku->stok }})</span>
          @else
            <span class="bg-[rgba(239,68,68,0.1)] text-red-700 font-label-sm text-label-sm px-sm py-xs rounded-full border border-red-200">Stok Habis</span>
          @endif
        </div>
        <h3 class="font-headline-sm text-headline-sm text-primary mb-xs line-clamp-2">{{ $buku->judul_buku }}</h3>
        <p class="font-body-sm text-body-sm text-on-surface-variant mb-md">{{ $buku->pengarang }} &middot; {{ $buku->tahun_terbit }}</p>

        <form method="POST" action="{{ route('member.katalog.pinjam', $buku) }}" class="mt-auto">
          @csrf
          <button type="submit" {{ $buku->stok < 1 ? 'disabled' : '' }}
            class="w-full font-label-md text-label-md py-2 rounded-lg transition-colors
            {{ $buku->stok < 1 ? 'bg-surface-variant text-on-surface-variant cursor-not-allowed' : 'bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container' }}">
            {{ $buku->stok < 1 ? 'Tidak Tersedia' : 'Ajukan Peminjaman' }}
          </button>
        </form>
      </div>
    </article>
  @empty
    <p class="col-span-full text-center text-on-surface-variant py-xl">Buku tidak ditemukan.</p>
  @endforelse
</div>

<div class="mt-lg">
  {{ $bukus->links() }}
</div>
@endsection