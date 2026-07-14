@extends('layouts.admin')

@section('title', $konten->judul_konten)
@section('page-title', 'Detail Konten')

@section('content')
<div class="bg-surface rounded-xl shadow-sm border border-outline-variant p-lg max-w-2xl">
  <span class="inline-flex items-center px-sm py-[2px] rounded-full font-label-sm text-label-sm bg-primary-container text-on-primary-container mb-sm">{{ $konten->jenis_konten }}</span>
  <h1 class="font-headline-lg text-headline-lg text-primary mb-xs">{{ $konten->judul_konten }}</h1>
  <p class="font-body-sm text-body-sm text-on-surface-variant mb-lg">
    Dipublikasikan {{ \Carbon\Carbon::parse($konten->tanggal_publikasi)->translatedFormat('d M Y') }} oleh {{ $konten->admin->nama_admin }}
  </p>
  <div class="font-body-md text-body-md text-on-surface whitespace-pre-line">
    {{ $konten->isi_konten ?: 'Tidak ada isi konten.' }}
  </div>
  <a href="{{ route('admin.konten.index') }}" class="inline-block mt-lg text-primary hover:underline font-label-md">← Kembali ke daftar konten</a>
</div>
@endsection