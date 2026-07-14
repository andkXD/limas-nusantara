@extends('layouts.admin')

@section('title', 'Data Buku')
@section('page-title', 'Inventaris Koleksi Buku')

@section('header-action')
<div class="flex items-center gap-md">
  <form method="GET" class="relative w-72">
    <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
    <input name="q" value="{{ $keyword }}" class="w-full bg-surface-container-low border border-outline-variant rounded-lg py-sm pl-10 pr-sm font-body-sm text-body-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Cari judul atau pengarang..." type="text"/>
  </form>
  <a href="{{ route('admin.buku.create') }}" class="bg-primary text-on-primary rounded-lg py-sm px-md flex items-center gap-xs font-label-md text-label-md hover:opacity-90 shadow-sm whitespace-nowrap">
    <span class="material-symbols-outlined text-sm">add</span>
    Tambah Buku
  </a>
</div>
@endsection

@section('content')
<div class="bg-surface rounded-xl shadow-sm border border-outline-variant overflow-hidden">
  <table class="w-full text-left border-collapse">
    <thead class="bg-surface-container-low border-b border-outline-variant">
      <tr>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant uppercase">Judul Buku</th>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant uppercase">Pengarang</th>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant uppercase">Kategori</th>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant uppercase">Tahun</th>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant uppercase">Stok</th>
        <th class="py-sm px-md font-label-sm text-label-sm text-on-surface-variant uppercase text-right">Aksi</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-outline-variant">
      @forelse ($bukus as $buku)
        <tr class="hover:bg-surface-container-low transition-colors group">
          <td class="py-sm px-md">
            <div class="font-label-md text-label-md text-on-surface">{{ $buku->judul_buku }}</div>
            <div class="font-body-sm text-body-sm text-on-surface-variant">{{ $buku->penerbit }}</div>
          </td>
          <td class="py-sm px-md font-body-sm text-body-sm text-on-surface">{{ $buku->pengarang }}</td>
          <td class="py-sm px-md">
            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-surface-variant text-on-surface-variant border border-outline-variant">{{ $buku->kategori }}</span>
          </td>
          <td class="py-sm px-md font-body-sm text-body-sm text-on-surface">{{ $buku->tahun_terbit }}</td>
          <td class="py-sm px-md">
            @if ($buku->stok == 0)
              <span class="font-label-md text-label-md text-error flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">warning</span> 0
              </span>
            @else
              <span class="font-label-md text-label-md text-on-surface">{{ $buku->stok }}</span>
            @endif
          </td>
          <td class="py-sm px-md text-right">
            <div class="flex items-center justify-end gap-sm">
              <a href="{{ route('admin.buku.edit', $buku) }}" class="text-on-surface-variant hover:text-primary transition-colors" title="Edit">
                <span class="material-symbols-outlined text-xl">edit</span>
              </a>
              <form method="POST" action="{{ route('admin.buku.destroy', $buku) }}" onsubmit="return confirm('Hapus buku ini?');">
                @csrf @method('DELETE')
                <button type="submit" class="text-on-surface-variant hover:text-error transition-colors" title="Delete">
                  <span class="material-symbols-outlined text-xl">delete</span>
                </button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="p-md text-center text-on-surface-variant">Belum ada data buku.</td></tr>
      @endforelse
    </tbody>
  </table>
  <div class="bg-surface-container-lowest px-md py-sm border-t border-outline-variant">
    {{ $bukus->links() }}
  </div>
</div>
@endsection