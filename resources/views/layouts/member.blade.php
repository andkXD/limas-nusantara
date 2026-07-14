<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>@yield('title', 'Beranda') - LIMAS Nusantara</title>
@include('partials.tailwind-head')
</head>
<body class="bg-background text-on-surface font-body-md antialiased min-h-screen flex flex-col">

<header class="bg-surface shadow-sm sticky top-0 z-50 flex justify-between items-center w-full px-4 md:px-xl h-20 max-w-container-max mx-auto">
  <span class="font-headline-md text-headline-md font-bold text-primary">LIMAS Nusantara</span>
  <nav class="hidden md:flex items-center gap-lg">
    <a class="{{ request()->routeIs('member.dashboard') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary' }} font-label-md text-label-md transition-all" href="{{ route('member.dashboard') }}">Home</a>
    <a class="{{ request()->routeIs('member.katalog.*') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary' }} font-label-md text-label-md transition-all" href="{{ route('member.katalog.index') }}">Katalog</a>
    <a class="{{ request()->routeIs('member.riwayat') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary' }} font-label-md text-label-md transition-all" href="{{ route('member.riwayat') }}">Riwayat Peminjaman</a>
  </nav>
  <div class="flex items-center gap-md">
    <span class="font-label-md text-label-md text-on-surface-variant hidden md:inline">{{ auth('web')->user()->nama_anggota }}</span>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="bg-primary text-on-primary font-label-md text-label-md px-4 py-2 rounded-lg hover:bg-primary-container hover:text-on-primary-container transition-colors">
        Logout
      </button>
    </form>
  </div>
</header>

<main class="flex-grow max-w-container-max mx-auto w-full px-4 md:px-xl py-xl">
  @if (session('success'))
    <div class="mb-md p-sm bg-primary-container text-on-primary-container rounded-lg text-body-sm">
      {{ session('success') }}
    </div>
  @endif
  @if (session('error'))
    <div class="mb-md p-sm bg-error-container text-on-error-container rounded-lg text-body-sm">
      {{ session('error') }}
    </div>
  @endif
  @yield('content')
</main>

</body>
</html>