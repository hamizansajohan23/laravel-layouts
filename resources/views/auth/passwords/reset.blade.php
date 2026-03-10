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

    .password-input-wrapper {
      position: relative;
    }

    .password-input-wrapper .form-input {
      padding-right: 48px;
    }

    .password-toggle {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #9ca3af;
      cursor: pointer;
      padding: 4px;
      font-size: 16px;
      transition: color 0.2s;
    }

    .password-toggle:hover {
      color: #374151;
    }

    .password-tips {
      margin-top: 16px;
      padding: 16px;
      background: #f3f4f6;
      border-radius: 8px;
      border: 1px solid #e5e7eb;
    }

    .password-tips-title {
      font-size: 13px;
      font-weight: 600;
      color: #374151;
      margin-bottom: 12px;
    }

    .password-tips-list {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .password-tips-item {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 13px;
      color: #374151;
      transition: all 0.2s ease;
    }

    .password-tips-item i {
      color: #9ca3af;
      font-size: 8px;
      transition: all 0.2s ease;
      width: 14px;
      text-align: center;
    }

    .password-tips-item.valid i {
      color: #10b981;
      font-size: 14px;
    }

    .password-tips-item.valid span {
      color: #10b981;
    }

    .password-tips-item.invalid i {
      color: #ef4444;
      font-size: 14px;
    }

    .password-tips-item.invalid span {
      color: #ef4444;
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
          <div class="password-input-wrapper">
            <input
              type="password"
              id="password"
              name="password"
              class="form-input @error('password') is-invalid @enderror"
              placeholder="••••••••"
              required
            >
            <button type="button" class="password-toggle" onclick="togglePassword('password', this)">
              <i class="fa-solid fa-eye"></i>
            </button>
          </div>
          @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror

          <div class="password-tips">
            <div class="password-tips-title">Keperluan Kata Laluan</div>
            <div class="password-tips-list">
              <div class="password-tips-item" id="tip-length">
                <i class="fa-solid fa-circle"></i>
                <span>Sekurang-kurangnya 12 aksara</span>
              </div>
              <div class="password-tips-item" id="tip-lowercase">
                <i class="fa-solid fa-circle"></i>
                <span>Satu huruf kecil (a-z)</span>
              </div>
              <div class="password-tips-item" id="tip-uppercase">
                <i class="fa-solid fa-circle"></i>
                <span>Satu huruf besar (A-Z)</span>
              </div>
              <div class="password-tips-item" id="tip-number">
                <i class="fa-solid fa-circle"></i>
                <span>Satu nombor (0-9)</span>
              </div>
              <div class="password-tips-item" id="tip-special">
                <i class="fa-solid fa-circle"></i>
                <span>Satu aksara khas (@$!%*?&)</span>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="password_confirmation" class="form-label">Sahkan Kata Laluan</label>
          <div class="password-input-wrapper">
            <input
              type="password"
              id="password_confirmation"
              name="password_confirmation"
              class="form-input"
              placeholder="••••••••"
              required
            >
            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)">
              <i class="fa-solid fa-eye"></i>
            </button>
          </div>
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

  <script>
    function togglePassword(inputId, button) {
      const input = document.getElementById(inputId);
      const icon = button.querySelector('i');

      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }

    // Real-time password validation
    document.addEventListener('DOMContentLoaded', function() {
      const passwordInput = document.getElementById('password');

      const rules = [
        { id: 'tip-length', test: (pwd) => pwd.length >= 12 },
        { id: 'tip-lowercase', test: (pwd) => /[a-z]/.test(pwd) },
        { id: 'tip-uppercase', test: (pwd) => /[A-Z]/.test(pwd) },
        { id: 'tip-number', test: (pwd) => /[0-9]/.test(pwd) },
        { id: 'tip-special', test: (pwd) => /[@$!%*?&]/.test(pwd) }
      ];

      function validatePassword() {
        const password = passwordInput.value;

        rules.forEach(rule => {
          const element = document.getElementById(rule.id);
          const icon = element.querySelector('i');

          if (password.length === 0) {
            element.classList.remove('valid', 'invalid');
            icon.className = 'fa-solid fa-circle';
          } else if (rule.test(password)) {
            element.classList.remove('invalid');
            element.classList.add('valid');
            icon.className = 'fa-solid fa-check';
          } else {
            element.classList.remove('valid');
            element.classList.add('invalid');
            icon.className = 'fa-solid fa-xmark';
          }
        });
      }

      passwordInput.addEventListener('input', validatePassword);
      passwordInput.addEventListener('focus', validatePassword);
    });
  </script>
</body>
</html>
