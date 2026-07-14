@extends('layouts.admin')

@section('title', $anggota->exists ? 'Edit Anggota' : 'Tambah Anggota')
@section('page-title', $anggota->exists ? 'Edit Data Anggota' : 'Daftarkan Anggota Baru')

@section('content')
<div class="bg-surface rounded-xl shadow-sm border border-outline-variant p-lg max-w-xl">
  <form method="POST" action="{{ $anggota->exists ? route('admin.anggota.update', $anggota) : route('admin.anggota.store') }}" class="space-y-md">
    @csrf
    @if ($anggota->exists) @method('PUT') @endif

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
      <label class="block font-label-md text-label-md text-on-surface-variant mb-xs">Nama Lengkap</label>
      <input name="nama_anggota" value="{{ old('nama_anggota', $anggota->nama_anggota) }}" class="w-full px-sm py-[10px] bg-surface-container-low border border-outline-variant rounded-lg" required/>
    </div>
    <div>
      <label class="block font-label-md text-label-md text-on-surface-variant mb-xs">Email</label>
      <input type="email" name="email" value="{{ old('email', $anggota->email) }}" class="w-full px-sm py-[10px] bg-surface-container-low border border-outline-variant rounded-lg" required/>
    </div>
    <div>
      <label class="block font-label-md text-label-md text-on-surface-variant mb-xs">
        Password {{ $anggota->exists ? '(kosongkan jika tidak diubah)' : '' }}
      </label>
      <input type="password" name="password" class="w-full px-sm py-[10px] bg-surface-container-low border border-outline-variant rounded-lg" {{ $anggota->exists ? '' : 'required' }}/>
    </div>

    <div class="flex gap-sm pt-sm">
      <button type="submit" class="bg-primary text-on-primary rounded-lg py-sm px-lg font-label-md hover:opacity-90">Simpan</button>
      <a href="{{ route('admin.anggota.index') }}" class="text-on-surface-variant py-sm px-lg font-label-md hover:underline">Batal</a>
    </div>
  </form>
</div>
@endsection