<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', config('app.name', 'Sistem Permohonan Pengguna'))</title>

  {{-- Favicon --}}
  <link rel="icon" type="image/png" href="{{ asset('img/jata.png') }}">

  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  {{-- Your custom overrides --}}
  <link rel="stylesheet" href="{{ asset('css/layout.css') }}">

  @stack('styles')
</head>

@php
  $user = auth()->user();
  $userName = $user->first_name ?? 'Guest';
  $userBahagian = $user->bahagian->nama_pendek ?? '-';
  $userRole = ucfirst($user->role ?? 'Pengguna');
  $userInitials = strtoupper(substr($userName, 0, 2));
  $isActive = fn (array|string $patterns) => request()->routeIs($patterns);
@endphp

<body class="app-body">

<div class="app">
  <div id="overlay" class="overlay" aria-hidden="true"></div>

  <aside id="sidebar" class="sidebar">
    <div class="brand">
      <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('img/jata.png') }}" alt="{{ config('app.name', 'Sistem Permohonan Pengguna') }} logo" class="brand-mark">
        <span class="brand-name">{{ config('app.name', 'Sistem Permohonan Pengguna') }}</span>
      </a>
    </div>

    <div class="profile-card">
      <div class="avatar"><img src="{{ asset('img/user.jpg') }}" alt="User Avatar" class="avatar-image"></div>
      <div class="profile-meta">
        <div class="profile-name">{{ $userName }}</div>
        <div class="profile-role">{{ $userBahagian }}</div>
      </div>
    </div>

    <nav class="menu">
      <div class="menu-block">
        <div class="menu-label">UTAMA</div>
        <a href="{{ route('dashboard') }}" class="menu-item {{ $isActive('dashboard') ? 'active' : '' }}" data-tooltip="Dashboard">
          <span class="menu-icon"><i class="fa-solid fa-house"></i></span>
          <span class="menu-text">Dashboard</span>
        </a>
      </div>

      @if (strtolower(auth()->user()->role) === 'admin')
      <div class="menu-block">
        <div class="menu-label">PENGURUSAN</div>
        <a href="{{ route('admin.pengguna.index') }}" class="menu-item" data-tooltip="Senarai Pengguna">
          <span class="menu-icon"><i class="fa-solid fa-users"></i></span>
          <span class="menu-text">Senarai Pengguna</span>
        </a>
      </div>
      @endif
    </nav>
  </aside>

  <main class="main">
    <header class="topbar">
      <div class="topbar-left">
        <button type="button" id="mobileMenuBtn" class="icon-btn" aria-label="Toggle sidebar">
          <i class="fa-solid fa-bars"></i>
        </button>
        {{-- <div class="search">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="search" placeholder="Search..." aria-label="Search">
        </div> --}}
      </div>
      <div class="topbar-right">
        <button type="button" id="themeBtn" class="icon-btn" aria-label="Toggle theme" aria-pressed="false">
          <i class="fa-regular fa-moon"></i>
        </button>
        <div class="profile-dropdown">
          <button type="button" class="profile-pill" aria-haspopup="true" aria-expanded="false" aria-controls="profileMenu">
            <div class="avatar"><img src="{{ asset('img/user.jpg') }}" alt="User Avatar" class="avatar-image"></div>
            <div>
              <div class="profile-name">{{ $userName }}</div>
              <div class="profile-role">{{ $userRole }}</div>
            </div>
            <i class="fa-solid fa-angle-down"></i>
          </button>
          <div id="profileMenu" class="profile-menu" role="menu">
            <a href="{{ route('profile.edit') }}" class="profile-menu-item" role="menuitem">
              <i class="fa-regular fa-user"></i>
              Profil Pengguna
            </a>
            <a href="{{ route('password.change') }}" class="profile-menu-item" role="menuitem">
              <i class="fa-solid fa-key"></i>
              Tukar Kata Laluan
            </a>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
              @csrf
              <button type="submit" class="profile-menu-item" role="menuitem" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; font: inherit; padding: 12px 16px;">
                <i class="fa-solid fa-right-from-bracket"></i>
                Log Keluar
              </button>
            </form>
          </div>
        </div>
      </div>
    </header>

    <section class="page">
      <div class="page-header">
        <div>
          <h1>@yield('header_title', 'Dashboard')</h1>
          <p>@yield('header_subtitle', 'Sistem Permohonan Pengguna Baru')</p>
        </div>
      </div>

      <div class="page-body">
        @yield('content')
      </div>
    </section>
  </main>
</div>

<script src="{{ asset('js/layout.js') }}"></script>
@stack('scripts')

</body>
</html>
