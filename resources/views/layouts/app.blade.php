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

  {{-- Tom Select for searchable dropdowns --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css">

  {{-- Your custom overrides --}}
  <link rel="stylesheet" href="{{ asset('css/layout.css') }}">

  <style>
    /* Tom Select custom styling */
    .ts-wrapper {
      font-family: inherit;
      margin: 0 !important;
    }
    .ts-wrapper.single .ts-control {
      background: var(--input-bg, #f9fafb) !important;
      border: 1px solid var(--border, #e5e7eb);
      border-radius: var(--radius, 16px);
      padding: 0 14px !important;
      font-size: 14px;
      min-height: 46px;
      height: 46px;
      display: flex;
      align-items: center;
      transition: all 0.2s;
      color: var(--ink, #374151);
      box-sizing: border-box;
    }
    .ts-wrapper.single .ts-control > * {
      margin: 0 !important;
      padding: 0 !important;
    }
    .ts-wrapper .ts-control .item {
      color: var(--ink, #374151);
      padding: 0 !important;
      margin: 0 !important;
    }
    .ts-wrapper .ts-control input {
      color: var(--ink, #374151);
      padding: 0 !important;
      margin: 0 !important;
    }
    .ts-wrapper.focus .ts-control {
      border-color: var(--accent, #667eea);
      background: var(--input-bg, #f9fafb) !important;
      box-shadow: 0 0 0 3px rgba(59, 87, 244, 0.1);
    }
    .ts-wrapper .ts-control input {
      font-size: 14px;
    }
    .ts-dropdown {
      background: var(--panel, white);
      border: 1px solid var(--border, #e5e7eb);
      border-radius: var(--radius, 16px);
      box-shadow: var(--shadow, 0 4px 6px -1px rgba(0,0,0,0.1));
      margin-top: 4px;
    }
    .ts-dropdown .option {
      padding: 12px 14px;
      font-size: 14px;
      color: var(--ink, #374151);
    }
    .ts-dropdown .option.active {
      background: var(--accent, #667eea);
      color: white;
    }
    .ts-dropdown .option:hover {
      background: var(--hover, #f3f4f6);
      color: var(--ink, #374151);
    }
    .ts-dropdown .option.active:hover {
      background: var(--accent, #667eea);
      color: white;
    }
    .ts-wrapper.is-invalid .ts-control {
      border-color: #ef4444;
      background: #fef2f2;
    }
    
    /* Dark mode overrides for Tom Select */
    body.theme-dark .ts-wrapper .ts-control {
      background: var(--input-bg) !important;
      border-color: var(--border);
      color: var(--ink);
    }
    body.theme-dark .ts-wrapper .ts-control .item {
      color: var(--ink) !important;
    }
    body.theme-dark .ts-wrapper .ts-control > input {
      color: var(--ink) !important;
    }
    body.theme-dark .ts-wrapper .ts-control > input::placeholder {
      color: var(--muted) !important;
    }
    body.theme-dark .ts-wrapper.focus .ts-control {
      background: var(--input-bg) !important;
      border-color: var(--accent);
    }
    body.theme-dark .ts-dropdown {
      background: var(--panel) !important;
      border-color: var(--border);
    }
    body.theme-dark .ts-dropdown .option {
      color: var(--ink) !important;
    }
    body.theme-dark .ts-dropdown .option:hover {
      background: var(--hover) !important;
      color: var(--ink) !important;
    }
    body.theme-dark .ts-dropdown .option.active {
      background: var(--accent) !important;
      color: white !important;
    }
  </style>

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
      @php
        $pendingCount = \App\Models\User::where('status', 'baru')->whereNull('email_verified_at')->count();
      @endphp
      <div class="menu-block">
        <div class="menu-label">PENGURUSAN</div>
        <a href="{{ route('admin.pendaftaran.index') }}" class="menu-item {{ $isActive('admin.pendaftaran.*') ? 'active' : '' }}" data-tooltip="Senarai Permohonan">
          <span class="menu-icon"><i class="fa-solid fa-user-clock"></i></span>
          <span class="menu-text">Senarai Permohonan</span>
          @if ($pendingCount > 0)
            <span class="menu-badge">{{ $pendingCount }}</span>
          @endif
        </a>
        <a href="{{ route('admin.pengguna.index') }}" class="menu-item {{ $isActive('admin.pengguna.*') ? 'active' : '' }}" data-tooltip="Senarai Pengguna">
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
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize Tom Select on bahagian_id dropdown if exists
    const bahagianSelect = document.getElementById('bahagian_id');
    if (bahagianSelect && !bahagianSelect.tomselect) {
      new TomSelect('#bahagian_id', {
        placeholder: '-- Pilih Bahagian --',
        allowEmptyOption: true,
        create: false,
        sortField: { field: 'text', direction: 'asc' }
      });

      // Transfer invalid class to Tom Select wrapper
      if (bahagianSelect.classList.contains('is-invalid')) {
        bahagianSelect.closest('.ts-wrapper')?.classList.add('is-invalid');
      }
    }
  });
</script>
@stack('scripts')

</body>
</html>
