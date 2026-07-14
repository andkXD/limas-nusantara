@extends('layouts.admin')

@section('title', 'Data Anggota')
@section('page-title', 'Manajemen Anggota')

@section('header-action')
<div class="flex items-center gap-md">
  <form method="GET" class="relative w-72">
    <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
    <input name="q" value="{{ $keyword }}" class="w-full bg-surface-container-low border border-outline-variant rounded-lg py-sm pl-10 pr-sm font-body-sm text-body-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Cari nama atau email..." type="text"/>
  </form>
  <a href="{{ route('admin.anggota.create') }}" class="bg-primary text-on-primary rounded-lg py-sm px-md flex items-center gap-xs font-label-md text-label-md hover:opacity-90 shadow-sm whitespace-nowrap">
    <span class="material-symbols-outlined text-sm">add</span>
    Tambah Anggota
  </a>
</div>
@endsection

@section('content')
<div class="bg-surface-container-lowest rounded-xl shadow-[0px_4px_12px_rgba(0,0,0,0.05)] border border-outline-variant overflow-hidden">
  <table class="w-full text-left border-collapse">
    <thead>
      <tr class="bg-surface-container-low border-b border-outline-variant">
        <th class="font-label-sm text-label-sm text-on-surface-variant py-sm px-md uppercase">ID Anggota</th>
        <th class="font-label-sm text-label-sm text-on-surface-variant py-sm px-md uppercase">Nama Lengkap</th>
        <th class="font-label-sm text-label-sm text-on-surface-variant py-sm px-md uppercase">Email</th>
        <th class="font-label-sm text-label-sm text-on-surface-variant py-sm px-md uppercase">Status</th>
        <th class="font-label-sm text-label-sm text-on-surface-variant py-sm px-md uppercase text-center">Aksi</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-outline-variant">
      @forelse ($anggotas as $anggota)
        <tr class="hover:bg-surface-container transition-colors group {{ $anggota->status_keanggotaan === 'Nonaktif' ? 'opacity-60' : '' }}">
          <td class="py-md px-md font-body-sm text-body-sm text-on-surface">MBR-{{ str_pad($anggota->id_anggota, 4, '0', STR_PAD_LEFT) }}</td>
          <td class="py-md px-md">
            <div class="flex items-center gap-sm">
              <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center flex-shrink-0">
                <span class="font-label-sm text-label-sm text-on-secondary-container">{{ strtoupper(substr($anggota->nama_anggota, 0, 2)) }}</span>
              </div>
              <span class="font-label-md text-label-md text-primary font-medium">{{ $anggota->nama_anggota }}</span>
            </div>
          </td>
          <td class="py-md px-md font-body-sm text-body-sm text-on-surface-variant">{{ $anggota->email }}</td>
          <td class="py-md px-md">
            @if ($anggota->status_keanggotaan === 'Aktif')
              <span class="inline-flex items-center px-sm py-1 rounded-full bg-green-100 text-green-800 font-label-sm text-label-sm">Aktif</span>
            @else
              <span class="inline-flex items-center px-sm py-1 rounded-full bg-gray-100 text-gray-600 font-label-sm text-label-sm border border-gray-200">Nonaktif</span>
            @endif
          </td>
          <td class="py-md px-md text-center">
            <div class="flex justify-center gap-sm">
              <a href="{{ route('admin.anggota.edit', $anggota) }}" class="text-on-surface-variant hover:text-primary p-1 rounded hover:bg-surface-variant" title="Edit">
                <span class="material-symbols-outlined text-[20px]">edit</span>
              </a>
              <form method="POST" action="{{ route('admin.anggota.toggle-status', $anggota) }}" onsubmit="return confirm('{{ $anggota->status_keanggotaan === 'Aktif' ? 'Nonaktifkan' : 'Aktifkan kembali' }} akun ini?');">
                @csrf @method('PATCH')
                @if ($anggota->status_keanggotaan === 'Aktif')
                  <button type="submit" class="text-on-surface-variant hover:text-error p-1 rounded hover:bg-error-container" title="Lock Account">
                    <span class="material-symbols-outlined text-[20px]">lock</span>
                  </button>
                @else
                  <button type="submit" class="text-primary hover:text-on-primary-container p-1 rounded hover:bg-primary-fixed" title="Unlock Account">
                    <span class="material-symbols-outlined text-[20px]">lock_open_right</span>
                  </button>
                @endif
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="p-md text-center text-on-surface-variant">Belum ada anggota terdaftar.</td></tr>
      @endforelse
    </tbody>
  </table>
  <div class="bg-surface-container-lowest px-md py-sm border-t border-outline-variant">
    {{ $anggotas->links() }}
  </div>
</div>
@endsection