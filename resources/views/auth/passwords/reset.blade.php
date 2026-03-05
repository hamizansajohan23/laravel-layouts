<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tukar Kata Laluan - {{ config('app.name', 'Sistem Permohonan Pengguna') }}</title>

  {{-- Favicon --}}
  <link rel="icon" type="image/png" href="{{ asset('img/jata.png') }}">

  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  {{-- Custom CSS --}}
  <link rel="stylesheet" href="{{ asset('css/layout.css') }}">

  <style>
    body {
      font-family: 'Space Grotesk', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .login-container {
      width: 100%;
      max-width: 420px;
      padding: 20px;
    }

    .login-card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      padding: 40px;
    }

    .login-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .login-logo {
      width: 80px;
      height: 80px;
      margin: 0 auto 20px;
    }

    .login-title {
      font-size: 24px;
      font-weight: 700;
      color: #1f2937;
      margin: 0 0 8px;
    }

    .login-subtitle {
      font-size: 14px;
      color: #6b7280;
      margin: 0;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      font-size: 14px;
      font-weight: 600;
      color: #374151;
      margin-bottom: 8px;
    }

    .form-input {
      width: 100%;
      padding: 12px 16px;
      font-size: 14px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      transition: all 0.2s;
      box-sizing: border-box;
    }

    .form-input:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-input.is-invalid {
      border-color: #ef4444;
    }

    .invalid-feedback {
      color: #ef4444;
      font-size: 13px;
      margin-top: 6px;
      display: block;
    }

    .btn-login {
      width: 100%;
      padding: 12px;
      font-size: 15px;
      font-weight: 600;
      color: white;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-login:active {
      transform: translateY(0);
    }

    .login-footer {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: #6b7280;
    }

    .login-footer a {
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
    }

    .login-footer a:hover {
      text-decoration: underline;
    }

    .alert {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .alert-danger {
      background-color: #fee2e2;
      border: 1px solid #fecaca;
      color: #991b1b;
    }

    .alert-success {
      background-color: #dcfce7;
      border: 1px solid #bbf7d0;
      color: #166534;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <div class="login-header">
        <img src="{{ asset('img/jata.png') }}" alt="Logo" class="login-logo">
        <h1 class="login-title">Tukar Kata Laluan</h1>
        <p class="login-subtitle">Masukkan kata laluan baru anda</p>
      </div>

      @if ($errors->any())
        <div class="alert alert-danger">
          <strong>Ralat!</strong> Sila semak maklumat yang diisi.
        </div>
      @endif

      <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
          <label for="email" class="form-label">Emel</label>
          <input
            type="email"
            id="email"
            name="email"
            class="form-input @error('email') is-invalid @enderror"
            value="{{ $email ?? old('email') }}"
            placeholder="nama@contoh.com"
            required
            autofocus
          >
          @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="password" class="form-label">Kata Laluan Baru</label>
          <input
            type="password"
            id="password"
            name="password"
            class="form-input @error('password') is-invalid @enderror"
            placeholder="••••••••"
            required
          >
          @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="password_confirmation" class="form-label">Sahkan Kata Laluan</label>
          <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            class="form-input"
            placeholder="••••••••"
            required
          >
        </div>

        <button type="submit" class="btn-login">
          <i class="fa-solid fa-key"></i> Tukar Kata Laluan
        </button>
      </form>

      <div class="login-footer">
        <a href="{{ route('login') }}"><i class="fa-solid fa-arrow-left"></i> Kembali ke Log Masuk</a>
      </div>
    </div>
  </div>
</body>
</html>
