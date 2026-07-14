@extends('layouts.admin')

@section('title', $konten->exists ? 'Edit Konten' : 'Unggah Konten')
@section('page-title', $konten->exists ? 'Edit Konten' : 'Unggah Konten Baru')

@section('content')
<div class="bg-surface rounded-xl shadow-sm border border-outline-variant p-lg max-w-2xl">
  <form method="POST" action="{{ $konten->exists ? route('admin.konten.update', $konten) : route('admin.konten.store') }}" class="space-y-md">
    @csrf
    @if ($konten->exists) @method('PUT') @endif

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
      <label class="block font-label-md text-label-md text-on-surface-variant mb-xs">Judul Konten</label>
      <input name="judul_konten" value="{{ old('judul_konten', $konten->judul_konten) }}" class="w-full px-sm py-[10px] bg-surface-container-low border border-outline-variant rounded-lg" required/>
    </div>

    <div class="grid grid-cols-2 gap-md">
      <div>
        <label class="block font-label-md text-label-md text-on-surface-variant mb-xs">Jenis Konten</label>
        <select name="jenis_konten" class="w-full px-sm py-[10px] bg-surface-container-low border border-outline-variant rounded-lg" required>
          @foreach (['E-kliping', 'Newsletter', 'Kegiatan'] as $jenis)
            <option value="{{ $jenis }}" {{ old('jenis_konten', $konten->jenis_konten) === $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block font-label-md text-label-md text-on-surface-variant mb-xs">Tanggal Publikasi</label>
        <input type="date" name="tanggal_publikasi" value="{{ old('tanggal_publikasi', optional($konten->tanggal_publikasi)->format('Y-m-d')) }}" class="w-full px-sm py-[10px] bg-surface-container-low border border-outline-variant rounded-lg" required/>
      </div>
    </div>

    <div>
      <label class="block font-label-md text-label-md text-on-surface-variant mb-xs">Isi / Ringkasan Konten</label>
      <textarea name="isi_konten" rows="6" class="w-full px-sm py-[10px] bg-surface-container-low border border-outline-variant rounded-lg">{{ old('isi_konten', $konten->isi_konten) }}</textarea>
    </div>

    <div class="flex gap-sm pt-sm">
      <button type="submit" class="bg-primary text-on-primary rounded-lg py-sm px-lg font-label-md hover:opacity-90">Simpan</button>
      <a href="{{ route('admin.konten.index') }}" class="text-on-surface-variant py-sm px-lg font-label-md hover:underline">Batal</a>
    </div>
  </form>
</div>
@endsection