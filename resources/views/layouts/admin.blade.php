<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>@yield('title', 'Admin') - LIMAS Nusantara</title>
@include('partials.tailwind-head')
</head>
<body class="bg-background text-on-surface antialiased min-h-screen flex">

<nav class="fixed left-0 top-0 h-full w-[280px] flex flex-col py-lg bg-surface-container-low border-r border-outline-variant z-40">
  <div class="px-md mb-lg flex items-center gap-sm">
    <div class="w-10 h-10 rounded-full overflow-hidden bg-primary-container flex items-center justify-center text-on-primary-container">
      <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">local_library</span>
    </div>
    <div>
      <div class="font-headline-sm text-headline-sm font-bold text-primary">LIMAS</div>
      <div class="font-label-sm text-label-sm text-on-surface-variant">Nusantara Admin</div>
    </div>
  </div>

  <div class="px-md mb-lg">
    <div class="flex items-center gap-sm mb-sm">
      <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-label-md">
        {{ strtoupper(substr(auth('admin')->user()->nama_admin, 0, 2)) }}
      </div>
      <div>
        <div class="font-label-md text-label-md text-on-surface">{{ auth('admin')->user()->nama_admin }}</div>
        <div class="font-body-sm text-body-sm text-on-surface-variant">Institutional Access</div>
      </div>
    </div>
  </div>

  <div class="flex flex-col gap-xs flex-grow overflow-y-auto">
    @php
      $navItems = [
        ['route' => 'admin.dashboard', 'icon' => 'dashboard', 'label' => 'Dashboard'],
        ['route' => 'admin.buku.index', 'icon' => 'menu_book', 'label' => 'Data Buku'],
        ['route' => 'admin.anggota.index', 'icon' => 'group', 'label' => 'Data Anggota'],
        ['route' => 'admin.transaksi.index', 'icon' => 'receipt_long', 'label' => 'Transaksi'],
        ['route' => 'admin.konten.index', 'icon' => 'article', 'label' => 'Konten'],
      ];
    @endphp
    @foreach ($navItems as $item)
      @php $active = request()->routeIs($item['route'].'*'); @endphp
      <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
         class="flex items-center gap-md px-md py-sm transition-all
         {{ $active ? 'bg-primary-container text-on-primary-container border-l-4 border-primary scale-95' : 'text-on-surface-variant hover:bg-surface-variant' }}">
        <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
        <span class="font-label-md text-label-md">{{ $item['label'] }}</span>
      </a>
    @endforeach
  </div>

  <div class="mt-auto flex flex-col gap-xs px-md pt-lg border-t border-outline-variant">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="w-full flex items-center gap-md text-on-surface-variant py-sm hover:bg-surface-variant transition-all rounded-md px-sm">
        <span class="material-symbols-outlined">logout</span>
        <span class="font-label-md text-label-md">Logout</span>
      </button>
    </form>
  </div>
</nav>

<main class="ml-[280px] flex-1 flex flex-col min-h-screen">
  <header class="bg-surface border-b border-outline-variant px-xl py-md flex items-center justify-between sticky top-0 z-30">
    <h1 class="font-headline-lg text-headline-lg text-on-surface">@yield('page-title', 'Dashboard')</h1>
    <div>@yield('header-action')</div>
  </header>

  <div class="flex-1 p-xl overflow-y-auto bg-surface-bright">
    @if (session('success'))
      <div class="mb-md p-sm bg-primary-container text-on-primary-container rounded-lg text-body-sm">
        {{ session('success') }}
      </div>
    @endif
    @yield('content')
  </div>
</main>

</body>
</html>