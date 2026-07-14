@extends('layouts.admin')

@section('title', $buku->exists ? 'Edit Buku' : 'Tambah Buku')
@section('page-title', $buku->exists ? 'Edit Buku' : 'Tambah Buku Baru')

@section('content')
<div class="bg-surface rounded-xl shadow-sm border border-outline-variant p-lg max-w-2xl">
  <form method="POST" action="{{ $buku->exists ? route('admin.buku.update', $buku) : route('admin.buku.store') }}" class="space-y-md">
    @csrf
    @if ($buku->exists) @method('PUT') @endif

    @if ($errors->any())
      <div class="p-sm bg-error-container text-on-error-container rounded-lg text-body-sm">
        <ul class="list-disc pl-md">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div>
      <label class="block font-label-md text-label-md text-on-surface-variant mb-xs">Judul Buku</label>
      <input name="judul_buku" value="{{ old('judul_buku', $buku->judul_buku) }}" class="w-full px-sm py-[10px] bg-surface-container-low border border-outline-variant rounded-lg" required/>
    </div>
    <div>
      <label class="block font-label-md text-label-md text-on-surface-variant mb-xs">Pengarang</label>
      <input name="pengarang" value="{{ old('pengarang', $buku->pengarang) }}" class="w-full px-sm py-[10px] bg-surface-container-low border border-outline-variant rounded-lg" required/>
    </div>
    <div class="grid grid-cols-2 gap-md">
      <div>
        <label class="block font-label-md text-label-md text-on-surface-variant mb-xs">Penerbit</label>
        <input name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" class="w-full px-sm py-[10px] bg-surface-container-low border border-outline-variant rounded-lg" required/>
      </div>
      <div>
        <label class="block font-label-md text-label-md text-on-surface-variant mb-xs">Tahun Terbit</label>
        <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" class="w-full px-sm py-[10px] bg-surface-container-low border border-outline-variant rounded-lg" required/>
      </div>
    </div>
    <div class="grid grid-cols-2 gap-md">
      <div>
        <label class="block font-label-md text-label-md text-on-surface-variant mb-xs">Kategori</label>
        <input name="kategori" value="{{ old('kategori', $buku->kategori) }}" class="w-full px-sm py-[10px] bg-surface-container-low border border-outline-variant rounded-lg" required/>
      </div>
      <div>
        <label class="block font-label-md text-label-md text-on-surface-variant mb-xs">Stok</label>
        <input type="number" name="stok" value="{{ old('stok', $buku->stok) }}" class="w-full px-sm py-[10px] bg-surface-container-low border border-outline-variant rounded-lg" required/>
      </div>
    </div>

    <div class="flex gap-sm pt-sm">
      <button type="submit" class="bg-primary text-on-primary rounded-lg py-sm px-lg font-label-md hover:opacity-90">Simpan</button>
      <a href="{{ route('admin.buku.index') }}" class="text-on-surface-variant py-sm px-lg font-label-md hover:underline">Batal</a>
    </div>
  </form>
</div>
@endsection