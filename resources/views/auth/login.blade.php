<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log Masuk - {{ config('app.name', 'Sistem Permohonan Pengguna') }}</title>

  {{-- Favicon --}}
  <link rel="icon" type="image/png" href="{{ asset('img/jata.png') }}">

  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
    *, *::before, *::after {
      box-sizing: border-box;
    }

    body {
      font-family: 'Space Grotesk', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      background: #f8fafc;
    }

    .login-wrapper {
      display: flex;
      min-height: 100vh;
    }

    /* Left Side - Image */
    .login-image {
      flex: 1;
      background: linear-gradient(135deg, rgba(59, 87, 244, 0.85), rgba(118, 75, 162, 0.85)),
                  url('https://lh3.googleusercontent.com/gps-cs-s/AHVAweqG60H7GxudBVZ0Fv2bqVb5Q6KxxwxmnnSOi12ZQP8hdcYRc0nsr4Ni2anH6kyWHdXvCAB7MzGUV2QCLO4ZJVTw-ZHMfeOq51uem89e8q5aV_EHjbqFeMvRlE_9CDNlRiXbySlx=s1360-w1360-h1020-rw') center/cover no-repeat;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 40px;
      position: relative;
      overflow: hidden;
    }

    .login-image::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('https://lh3.googleusercontent.com/gps-cs-s/AHVAweqG60H7GxudBVZ0Fv2bqVb5Q6KxxwxmnnSOi12ZQP8hdcYRc0nsr4Ni2anH6kyWHdXvCAB7MzGUV2QCLO4ZJVTw-ZHMfeOq51uem89e8q5aV_EHjbqFeMvRlE_9CDNlRiXbySlx=s1360-w1360-h1020-rw') center/cover no-repeat;
      z-index: -1;
    }

    .login-image-content {
      text-align: center;
      color: white;
      max-width: 400px;
      z-index: 1;
    }

    .login-image-content img {
      width: 100px;
      height: auto;
      margin-bottom: 24px;
    }

    .login-image-content h2 {
      font-size: 28px;
      font-weight: 700;
      margin: 0 0 16px;
      line-height: 1.3;
    }

    .login-image-content p {
      font-size: 16px;
      opacity: 0.9;
      margin: 0;
      line-height: 1.6;
    }

    .login-image-features {
      margin-top: 40px;
      text-align: left;
    }

    .login-image-features .feature {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 16px;
      font-size: 14px;
      opacity: 0.95;
    }

    .login-image-features .feature i {
      width: 24px;
      text-align: center;
      font-size: 16px;
    }

    /* Right Side - Form */
    .login-form-side {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px;
      background: white;
    }

    .login-container {
      width: 100%;
      max-width: 400px;
    }

    .login-header {
      margin-bottom: 32px;
    }

    .login-header h1 {
      font-size: 28px;
      font-weight: 700;
      color: #1f2937;
      margin: 0 0 8px;
    }

    .login-header p {
      font-size: 15px;
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

    .input-wrapper {
      position: relative;
    }

    .input-wrapper i {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #9ca3af;
      font-size: 16px;
    }

    .form-input {
      width: 100%;
      padding: 14px 14px 14px 44px;
      font-size: 15px;
      font-family: inherit;
      border: 2px solid #e5e7eb;
      border-radius: 10px;
      transition: all 0.2s;
      background: #f9fafb;
    }

    .form-input:focus {
      outline: none;
      border-color: #667eea;
      background: white;
      box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-input.is-invalid {
      border-color: #ef4444;
      background: #fef2f2;
    }

    .form-input::placeholder {
      color: #9ca3af;
    }

    .invalid-feedback {
      color: #ef4444;
      font-size: 13px;
      margin-top: 6px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
    }

    .form-check {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .form-check-input {
      width: 18px;
      height: 18px;
      cursor: pointer;
      accent-color: #667eea;
    }

    .form-check-label {
      font-size: 14px;
      color: #374151;
      cursor: pointer;
      user-select: none;
    }

    .forgot-link {
      font-size: 14px;
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
    }

    .forgot-link:hover {
      text-decoration: underline;
    }

    .btn-login {
      width: 100%;
      padding: 14px;
      font-size: 16px;
      font-weight: 600;
      font-family: inherit;
      color: white;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.3s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-login:active {
      transform: translateY(0);
    }

    .alert {
      padding: 14px 16px;
      border-radius: 10px;
      margin-bottom: 24px;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .alert-danger {
      background-color: #fef2f2;
      border: 1px solid #fecaca;
      color: #991b1b;
    }

    .alert-success {
      background-color: #f0fdf4;
      border: 1px solid #bbf7d0;
      color: #166534;
    }

    .login-footer {
      text-align: center;
      margin-top: 32px;
      padding-top: 24px;
      border-top: 1px solid #e5e7eb;
      font-size: 13px;
      color: #9ca3af;
    }

    /* Responsive */
    @media (max-width: 992px) {
      .login-image {
        display: none;
      }

      .login-form-side {
        flex: 1;
      }
    }

    @media (max-width: 480px) {
      .login-form-side {
        padding: 24px;
      }

      .form-options {
        flex-direction: column;
        gap: 12px;
        align-items: flex-start;
      }
    }
  </style>
</head>
<body>
  <div class="login-wrapper">
    {{-- Left Side - Image & Info --}}
    <div class="login-image">
      <div class="login-image-content">
        <img src="{{ asset('img/jata.png') }}" alt="Jata Malaysia">
        <h2>Sistem Permohonan Pengguna Baru</h2>
        <p>Kementerian Kemajuan Desa dan Wilayah (KKDW)</p>

        <div class="login-image-features">
          <div class="feature">
            <i class="fa-solid fa-shield-check"></i>
            <span>Permohonan ID Pengguna yang selamat</span>
          </div>
          <div class="feature">
            <i class="fa-solid fa-clock"></i>
            <span>Proses kelulusan yang pantas</span>
          </div>
          <div class="feature">
            <i class="fa-solid fa-users"></i>
            <span>Pengurusan pengguna yang efisien</span>
          </div>
        </div>
      </div>
    </div>

    {{-- Right Side - Login Form --}}
    <div class="login-form-side">
      <div class="login-container">
        <div class="login-header">
          <h1>Selamat Kembali!</h1>
          <p>Sila masukkan maklumat akaun anda untuk log masuk</p>
        </div>

        @if (session('status'))
          <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('status') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>Emel atau kata laluan tidak sah. Sila cuba lagi.</span>
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="form-group">
            <label for="email" class="form-label">Alamat Emel</label>
            <div class="input-wrapper">
              <i class="fa-solid fa-envelope"></i>
              <input
                type="email"
                id="email"
                name="email"
                class="form-input @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                placeholder="nama@kkdw.gov.my"
                required
                autofocus
              >
            </div>
            @error('email')
              <span class="invalid-feedback">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="password" class="form-label">Kata Laluan</label>
            <div class="input-wrapper">
              <i class="fa-solid fa-lock"></i>
              <input
                type="password"
                id="password"
                name="password"
                class="form-input @error('password') is-invalid @enderror"
                placeholder="Masukkan kata laluan"
                required
              >
            </div>
            @error('password')
              <span class="invalid-feedback">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
              </span>
            @enderror
          </div>

          <div class="form-options">
            <div class="form-check">
              <input type="checkbox" id="remember" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember" class="form-check-label">Ingat saya</label>
            </div>
            <a href="{{ route('password.request') }}" class="forgot-link">Lupa kata laluan?</a>
          </div>

          <button type="submit" class="btn-login">
            <i class="fa-solid fa-right-to-bracket"></i>
            Log Masuk
          </button>
        </form>

        <div class="login-footer">
          &copy; {{ date('Y') }} KKDW. Hak Cipta Terpelihara.
        </div>
      </div>
    </div>
  </div>
</body>
</html>
