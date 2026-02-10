<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', config('app.name', 'Laravel AdminLTE'))</title>

  {{-- Favicon --}}
  <link rel="icon" href="{{ asset('favicon.ico') }}">

  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  {{-- Your custom overrides --}}
  <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
</head>

@php
  $userName = auth()->user()->name ?? 'Guest User';
  $userRole = auth()->user()->role ?? 'Member';
  $userInitials = strtoupper(substr($userName, 0, 2));
  $isActive = fn (array|string $patterns) => request()->routeIs($patterns);
  $menu1Active = $isActive('submenu.*');
@endphp

<body class="app-body">

<div class="app">
  <div id="overlay" class="overlay" aria-hidden="true"></div>

  <aside id="sidebar" class="sidebar">
    <div class="brand">
      <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('img/jata.png') }}" alt="{{ config('app.name', 'JIDOX') }} logo" class="brand-mark">
        <span class="brand-name">{{ config('app.name', 'JIDOX') }}</span>
      </a>
    </div>

    <div class="profile-card">
      {{-- <div class="avatar">{{ $userInitials }}</div> --}}
      <div class="avatar"><img src="{{ asset('img/user.jpg') }}" alt="User Avatar" class="avatar-image"></div>
      <div class="profile-meta">
        <div class="profile-name">{{ $userName }}</div>
        <div class="profile-role">{{ $userRole }}</div>
      </div>
    </div>

    {{-- TEST KOMEN --}}
    {{-- TEST KOMEN --}}

    <nav class="menu">
      <div class="menu-block">
        <div class="menu-label">MAIN</div>
        <a href="{{ route('dashboard') }}" class="menu-item {{ $isActive('dashboard') ? 'active' : '' }}" data-tooltip="Dashboard">
          <span class="menu-icon"><i class="fa-regular fa-circle-dot"></i></span>
          <span class="menu-text">Dashboard</span>
          <span class="badge">9+</span>
        </a>
        <a href="{{ route('menu.two') }}" class="menu-item {{ $isActive('menu.two') ? 'active' : '' }}" data-tooltip="Calendar">
          <span class="menu-icon"><i class="fa-regular fa-calendar"></i></span>
          <span class="menu-text">Calendar</span>
        </a>
        <a href="{{ route('menu.three') }}" class="menu-item {{ $isActive('menu.three') ? 'active' : '' }}" data-tooltip="Chat">
          <span class="menu-icon"><i class="fa-regular fa-comment-dots"></i></span>
          <span class="menu-text">Chat</span>
          <span class="badge soft">1 File</span>
        </a>

        <a href="#" class="menu-item" data-tooltip="File Manager">
          <span class="menu-icon"><i class="fa-regular fa-folder-open"></i></span>
          <span class="menu-text">File Manager</span>
          <span class="badge purple">1 File</span>
        </a>
      </div>

      <div class="menu-block">
        <div class="menu-label">CUSTOM</div>
        <button
          type="button"
          id="menu1Toggle"
          class="menu-item menu-toggle {{ $menu1Active ? 'active' : '' }}"
          data-has-active-child="{{ $menu1Active ? '1' : '0' }}"
          aria-expanded="{{ $menu1Active ? 'true' : 'false' }}"
          data-tooltip="Sub Menu"
        >
          <span class="menu-icon"><i class="fa-solid fa-layer-group"></i></span>
          <span class="menu-text">SUB MENU</span>
          <span class="menu-chevron"><i class="fa-solid fa-angle-right"></i></span>
        </button>
        <div id="menu1Sub" class="submenu {{ $menu1Active ? 'open' : '' }}">
          <a href="{{ route('submenu.one') }}" class="submenu-item {{ $isActive('submenu.one') ? 'active' : '' }}">
            Submenu 1
          </a>
          <a href="{{ route('submenu.two') }}" class="submenu-item {{ $isActive('submenu.two') ? 'active' : '' }}">
            Submenu 2
          </a>
          <a href="{{ route('submenu.three') }}" class="submenu-item {{ $isActive('submenu.three') ? 'active' : '' }}">
            Submenu 3
          </a>
        </div>
        <a href="#" class="menu-item" data-tooltip="Pages">
          <span class="menu-icon"><i class="fa-regular fa-square"></i></span>
          <span class="menu-text">Pages</span>
        </a>
        <a href="#" class="menu-item" data-tooltip="Auth Pages">
          <span class="menu-icon"><i class="fa-regular fa-address-card"></i></span>
          <span class="menu-text">Auth Pages</span>
        </a>

      </div>
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
        {{-- <button type="button" class="icon-btn" aria-label="Language">
          <i class="fa-solid fa-flag-usa"></i>
        </button> --}}

        {{-- <button type="button" class="icon-btn" aria-label="Apps">
          <i class="fa-solid fa-table-cells"></i>
        </button> --}}
        <button type="button" class="icon-btn" aria-label="Settings">
          <i class="fa-solid fa-gear"></i>
        </button>
        <button type="button" id="themeBtn" class="icon-btn" aria-label="Toggle theme" aria-pressed="false">
          <i class="fa-regular fa-moon"></i>
        </button>
        <div class="notification-dropdown">
          <button type="button" class="icon-btn" aria-label="Notifications" aria-haspopup="true" aria-expanded="false" aria-controls="notificationMenu">
            <i class="fa-regular fa-bell"></i>
            <span class="dot"></span>
          </button>
          <div id="notificationMenu" class="notification-menu" role="menu">
            <div class="notification-header">
              <span>Notifications</span>
              <span class="notification-count">3</span>
            </div>
            <a href="#" class="notification-item" role="menuitem">
              <span class="notification-icon"><i class="fa-solid fa-bolt"></i></span>
              <span>
                <span class="notification-title">System Update</span>
                <span class="notification-time">Just now</span>
              </span>
            </a>
            <a href="#" class="notification-item" role="menuitem">
              <span class="notification-icon soft"><i class="fa-regular fa-user"></i></span>
              <span>
                <span class="notification-title">New user registered</span>
                <span class="notification-time">10 minutes ago</span>
              </span>
            </a>
            <a href="#" class="notification-item" role="menuitem">
              <span class="notification-icon warn"><i class="fa-solid fa-circle-exclamation"></i></span>
              <span>
                <span class="notification-title">Storage almost full</span>
                <span class="notification-time">1 hour ago</span>
              </span>
            </a>
            <div class="notification-footer">
              <a href="#">View all notifications</a>
            </div>
          </div>
        </div>
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
            <a href="#" class="profile-menu-item" role="menuitem">
              <i class="fa-regular fa-user"></i>
              Update Account
            </a>
            <a href="#" class="profile-menu-item" role="menuitem">
              <i class="fa-solid fa-key"></i>
              Change Password
            </a>
          </div>
        </div>
      </div>
    </header>

    <section class="page">
      <div class="page-header">
        <div>
          <h1>@yield('header_title', 'Dashboard')</h1>
          <p>@yield('header_subtitle', 'Modern admin experience')</p>
        </div>
        <div class="page-actions">
          <input type="text" class="date-input" value="02/10/2026" aria-label="Date">
          <button type="button" class="btn primary"><i class="fa-regular fa-calendar"></i></button>
          <button type="button" class="btn"><i class="fa-solid fa-rotate"></i></button>
        </div>
      </div>

      <div class="page-body">
        @yield('content')
      </div>
    </section>
  </main>
</div>

<script src="{{ asset('js/layout.js') }}"></script>

</body>
</html>
