<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Login - LIMAS Nusantara</title>
@include('partials.tailwind-head')
</head>
<body class="bg-background text-on-background antialiased min-h-screen flex">
<div class="flex w-full min-h-screen">
  <div class="hidden lg:flex lg:w-1/2 relative bg-surface-container-high flex-col justify-end p-xl overflow-hidden">
    <div class="absolute inset-0 z-0">
      <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCUsNPDkvomXtze_uixWQm-vtMFJL1BdnDFLqHqTP97V0iYu1cR4PYgF8MtvmFMip0t0jxocPJJ7v6D_zUhdRT-6noRnxVfhaP9IhuUNH23m6hPm54p9gitMuHls8U1VXEUwnNyarsuz7Tvs7lLK0ld3jgM3KDbnsv0Zz6sxKCWt-53ktJcE8yqEl1gnpDi0Tm9xpjoaz3OfKu2-ERwvMncf81kafvb_a4XjZ_4wXWrCJ-7NN-3sAxxvKUjLuo9xd4FrinY2jDSAzw')"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/40 to-transparent"></div>
    </div>
    <div class="relative z-10 text-on-primary max-w-lg mb-md">
      <h1 class="font-display text-display mb-sm text-on-primary">LIMAS Nusantara</h1>
      <p class="font-body-lg text-body-lg text-primary-fixed opacity-90">Empowering Knowledge for Institutional Excellence</p>
    </div>
  </div>

  <div class="w-full lg:w-1/2 flex items-center justify-center p-gutter md:p-xl bg-background">
    <div class="w-full max-w-[420px] bg-surface-container-lowest rounded-xl shadow-[0px_12px_24px_rgba(0,0,0,0.1)] p-lg border border-outline-variant/30">
      <div class="lg:hidden text-center mb-lg">
        <h1 class="font-headline-lg-mobile text-headline-lg-mobile font-bold text-primary mb-xs">LIMAS Nusantara</h1>
        <p class="font-body-sm text-body-sm text-on-surface-variant">Empowering Knowledge for Institutional Excellence</p>
      </div>
      <div class="mb-lg">
        <h2 class="font-headline-md text-headline-md text-on-surface mb-xs">Sign In Admin</h2>
        <p class="font-body-sm text-body-sm text-on-surface-variant">Akses katalog dan layanan peminjaman perpustakaan.</p>
      </div>

      @if ($errors->any())
        <div class="mb-md p-sm bg-error-container text-on-error-container rounded-lg text-body-sm">
          {{ $errors->first() }}
        </div>
      @endif

      <form class="space-y-md" method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <div>
          <label class="block font-label-md text-label-md text-on-surface-variant mb-xs" for="username">Username</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none text-outline">
              <span class="material-symbols-outlined text-[20px]">person</span>
            </div>
            <input class="block w-full pl-10 pr-sm py-[10px] bg-surface-container-low border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface placeholder-outline focus:ring-2 focus:ring-primary focus:border-primary transition-shadow duration-200" id="username" name="username" placeholder="username admin" required type="text" value="{{ old('username') }}"/>
          </div>
        </div>
        <div>
          <label class="block font-label-md text-label-md text-on-surface-variant mb-xs" for="password">Password</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none text-outline">
              <span class="material-symbols-outlined text-[20px]">lock</span>
            </div>
            <input class="block w-full pl-10 pr-sm py-[10px] bg-surface-container-low border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface placeholder-outline focus:ring-2 focus:ring-primary focus:border-primary transition-shadow duration-200" id="password" name="password" placeholder="••••••••" required type="password"/>
          </div>
        </div>
        <div class="pt-sm">
          <button class="w-full flex justify-center py-[12px] px-md border border-transparent rounded-lg shadow-sm font-label-md text-label-md text-on-primary bg-primary hover:bg-primary/90 transition-colors duration-200" type="submit">Sign In</button>
        </div>
        <p class="text-center text-body-sm text-on-surface-variant pt-sm">
          Anggota? <a href="{{ route('anggota.login') }}" class="text-primary hover:underline">Login di sini</a>
        </p>
      </form>
    </div>
  </div>
</div>
</body>
</html>