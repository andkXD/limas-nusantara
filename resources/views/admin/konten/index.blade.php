@extends('layouts.admin')

@section('title', 'Kelola Konten')
@section('page-title', 'Konten & Publikasi')

@section('header-action')
<a href="{{ route('admin.konten.create') }}" class="bg-primary text-on-primary rounded-lg py-sm px-md flex items-center gap-xs font-label-md text-label-md hover:opacity-90 shadow-sm whitespace-nowrap">
  <span class="material-symbols-outlined text-sm">add</span>
  Unggah Konten
</a>
@endsection

@section('content')
<div class="bg-surface-container-lowest rounded-xl shadow-[0px_4px_12px_rgba(0,0,0,0.05)] border border-outline-variant overflow-hidden">
  <table class="w-full text-left border-collapse">
    <thead>
      <tr class="border-b border-outline-variant/50 bg-surface-container-low text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
        <th class="p-md font-semibold">Judul Konten</th>
        <th class="p-md font-semibold">Jenis Konten</th>
        <th class="p-md font-semibold">Tanggal Publikasi</th>
        <th class="p-md font-semibold">Penulis/Admin</th>
        <th class="p-md font-semibold text-right">Aksi</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-outline-variant/30">
      @forelse ($kontens as $konten)
        @php
          $badgeColor = match($konten->jenis_konten) {
            'E-kliping' => 'bg-[#e0f2fe] text-[#0369a1]',
            'Newsletter' => 'bg-[#f3e8ff] text-[#7e22ce]',
            default => 'bg-[#dcfce7] text-[#15803d]',
          };
        @endphp
        <tr class="hover:bg-surface-container-low/50 transition-colors group">
          <td class="p-md">
            <div class="font-label-md text-label-md text-primary font-semibold">{{ $konten->judul_konten }}</div>
            @if ($konten->isi_konten)
              <div class="font-body-sm text-body-sm text-on-surface-variant mt-xs line-clamp-1">{{ Str::limit($konten->isi_konten, 80) }}</div>
            @endif
          </td>
          <td class="p-md">
            <span class="inline-flex items-center px-sm py-[2px] rounded-full font-label-sm text-label-sm {{ $badgeColor }}">{{ $konten->jenis_konten }}</span>
          </td>
          <td class="p-md font-body-sm text-body-sm text-on-surface">{{ \Carbon\Carbon::parse($konten->tanggal_publikasi)->translatedFormat('d M Y') }}</td>
          <td class="p-md font-body-sm text-body-sm text-on-surface">{{ $konten->admin->nama_admin }}</td>
          <td class="p-md text-right">
            <div class="flex justify-end gap-sm">
              <a href="{{ route('admin.konten.show', $konten) }}" class="text-on-surface-variant hover:text-primary transition-colors p-sm rounded hover:bg-surface-variant" title="View">
                <span class="material-symbols-outlined text-[20px]">visibility</span>
              </a>
              <a href="{{ route('admin.konten.edit', $konten) }}" class="text-on-surface-variant hover:text-primary transition-colors p-sm rounded hover:bg-surface-variant" title="Edit">
                <span class="material-symbols-outlined text-[20px]">edit</span>
              </a>
              <form method="POST" action="{{ route('admin.konten.destroy', $konten) }}" onsubmit="return confirm('Hapus konten ini?');">
                @csrf @method('DELETE')
                <button type="submit" class="text-on-surface-variant hover:text-error transition-colors p-sm rounded hover:bg-error-container" title="Delete">
                  <span class="material-symbols-outlined text-[20px]">delete</span>
                </button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="p-md text-center text-on-surface-variant">Belum ada konten dipublikasikan.</td></tr>
      @endforelse
    </tbody>
  </table>
  <div class="p-md border-t border-outline-variant">{{ $kontens->links() }}</div>
</div>
@endsection