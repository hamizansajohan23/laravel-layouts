<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Akaun - {{ config('app.name', 'Sistem Permohonan Pengguna') }}</title>

  {{-- Favicon --}}
  <link rel="icon" type="image/png" href="{{ asset('img/jata.png') }}">

  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  {{-- Tom Select for searchable dropdown --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css">

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

    .register-wrapper {
      display: flex;
      min-height: 100vh;
    }

    /* Left Side - Image */
    .register-image {
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

    .register-image-content {
      text-align: center;
      color: white;
      max-width: 400px;
      z-index: 1;
    }

    .register-image-content img {
      width: 100px;
      height: auto;
      margin-bottom: 24px;
    }

    .register-image-content h2 {
      font-size: 28px;
      font-weight: 700;
      margin: 0 0 16px;
      line-height: 1.3;
    }

    .register-image-content p {
      font-size: 16px;
      opacity: 0.9;
      margin: 0;
      line-height: 1.6;
    }

    .register-image-features {
      margin-top: 40px;
      text-align: left;
    }

    .register-image-features .feature {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 16px;
      font-size: 14px;
      opacity: 0.95;
    }

    .register-image-features .feature i {
      width: 24px;
      text-align: center;
      font-size: 16px;
    }

    /* Right Side - Form */
    .register-form-side {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px;
      background: white;
      overflow-y: auto;
    }

    .register-container {
      width: 100%;
      max-width: 500px;
    }

    .register-header {
      margin-bottom: 32px;
    }

    .register-header h1 {
      font-size: 28px;
      font-weight: 700;
      color: #1f2937;
      margin: 0 0 8px;
    }

    .register-header p {
      font-size: 15px;
      color: #6b7280;
      margin: 0;
    }

    .form-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 16px;
    }

    .form-grid .full-width {
      grid-column: 1 / -1;
    }

    .form-group {
      margin-bottom: 16px;
    }

    .form-label {
      display: block;
      font-size: 14px;
      font-weight: 600;
      color: #374151;
      margin-bottom: 8px;
    }

    .form-label .required {
      color: #ef4444;
    }

    .form-input, .form-select {
      width: 100%;
      padding: 12px 14px;
      font-size: 15px;
      font-family: inherit;
      border: 2px solid #e5e7eb;
      border-radius: 10px;
      transition: all 0.2s;
      background: #f9fafb;
    }

    .form-input:focus, .form-select:focus {
      outline: none;
      border-color: #667eea;
      background: white;
      box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-input.is-invalid, .form-select.is-invalid {
      border-color: #ef4444;
      background: #fef2f2;
    }

    /* Tom Select custom styling */
    .ts-wrapper {
      font-family: inherit;
    }
    .ts-wrapper .ts-control {
      background: #f9fafb;
      border: 2px solid #e5e7eb;
      border-radius: 10px;
      padding: 10px 14px;
      font-size: 15px;
      min-height: 48px;
      transition: all 0.2s;
    }
    .ts-wrapper.focus .ts-control {
      border-color: #667eea;
      background: white;
      box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }
    .ts-wrapper .ts-control input {
      font-size: 15px;
    }
    .ts-dropdown {
      background: white;
      border: 2px solid #e5e7eb;
      border-radius: 10px;
      box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
      margin-top: 4px;
    }
    .ts-dropdown .option {
      padding: 10px 14px;
      font-size: 15px;
    }
    .ts-dropdown .option.active {
      background: #667eea;
      color: white;
    }
    .ts-dropdown .option:hover {
      background: #f3f4f6;
    }
    .ts-dropdown .option.active:hover {
      background: #667eea;
    }
    .ts-wrapper.is-invalid .ts-control {
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
      margin-top: 12px;
      padding: 14px;
      background: #f3f4f6;
      border-radius: 8px;
      border: 1px solid #e5e7eb;
    }

    .password-tips-title {
      font-size: 12px;
      font-weight: 600;
      color: #374151;
      margin-bottom: 10px;
    }

    .password-tips-list {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .password-tips-item {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 12px;
      color: #6b7280;
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

    .btn-register {
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
      margin-top: 24px;
    }

    .btn-register:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-register:active {
      transform: translateY(0);
    }

    .register-footer {
      text-align: center;
      margin-top: 24px;
      font-size: 14px;
      color: #6b7280;
    }

    .register-footer a {
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
    }

    .register-footer a:hover {
      text-decoration: underline;
    }

    .alert {
      padding: 14px 16px;
      border-radius: 10px;
      margin-bottom: 20px;
      font-size: 14px;
      display: flex;
      align-items: flex-start;
      gap: 10px;
    }

    .alert-danger {
      background: #fef2f2;
      border: 1px solid #fecaca;
      color: #991b1b;
    }

    .alert-success {
      background: #f0fdf4;
      border: 1px solid #bbf7d0;
      color: #166534;
    }

    .info-box {
      background: #eff6ff;
      border: 1px solid #bfdbfe;
      border-radius: 10px;
      padding: 14px 16px;
      margin-bottom: 20px;
    }

    .info-box p {
      margin: 0;
      font-size: 13px;
      color: #1e40af;
      display: flex;
      align-items: flex-start;
      gap: 10px;
    }

    .info-box i {
      margin-top: 2px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .register-image {
        display: none;
      }

      .register-form-side {
        padding: 24px;
      }
    }

    @media (max-width: 640px) {
      .form-grid {
        grid-template-columns: 1fr;
      }

      .register-header h1 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>
  <div class="register-wrapper">
    {{-- Left Side - Image --}}
    <div class="register-image">
      <div class="register-image-content">
        <img src="{{ asset('img/jata.png') }}" alt="Logo">
        <h2>Sistem Permohonan Pengguna Baru</h2>
        <p>Kementerian Kemajuan Desa dan Wilayah (KKDW)</p>

        <div class="register-image-features">
          <div class="feature">
            <i class="fa-solid fa-user-plus"></i>
            <span>Pendaftaran mudah dan pantas</span>
          </div>
          <div class="feature">
            <i class="fa-solid fa-shield-halved"></i>
            <span>Keselamatan data terjamin</span>
          </div>
          <div class="feature">
            <i class="fa-solid fa-clock"></i>
            <span>Kelulusan dalam masa 24-48 jam</span>
          </div>
        </div>
      </div>
    </div>

    {{-- Right Side - Form --}}
    <div class="register-form-side">
      <div class="register-container">
        <div class="register-header">
          <h1>Daftar Akaun Baru</h1>
          <p>Sila lengkapkan maklumat untuk mendaftar</p>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
              <strong>Ralat!</strong> Sila semak maklumat yang dimasukkan.
            </div>
          </div>
        @endif

        <div class="info-box">
          <p>
            <i class="fa-solid fa-info-circle"></i>
            <span>Pendaftaran memerlukan kelulusan pentadbir. Anda akan menerima emel setelah akaun diluluskan.</span>
          </p>
        </div>

        <form action="{{ route('register') }}" method="POST">
          @csrf

          <div class="form-grid">
            <div class="form-group full-width">
              <label for="name" class="form-label">
                Nama Penuh <span class="required">*</span>
              </label>
              <input
                type="text"
                id="name"
                name="name"
                class="form-input @error('name') is-invalid @enderror"
                value="{{ old('name') }}"
                placeholder="Masukkan nama penuh"
                required
              >
              @error('name')
                <span class="invalid-feedback">
                  <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="nokp" class="form-label">
                No. Kad Pengenalan <span class="required">*</span>
              </label>
              <input
                type="text"
                id="nokp"
                name="nokp"
                class="form-input @error('nokp') is-invalid @enderror"
                value="{{ old('nokp') }}"
                placeholder="000000000000"
                maxlength="12"
                required
              >
              @error('nokp')
                <span class="invalid-feedback">
                  <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="email" class="form-label">
                Alamat Emel <span class="required">*</span>
              </label>
              <input
                type="email"
                id="email"
                name="email"
                class="form-input @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                placeholder="nama@contoh.com"
                required
              >
              @error('email')
                <span class="invalid-feedback">
                  <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                </span>
              @enderror
            </div>

            <div class="form-group full-width">
              <label for="bahagian_id" class="form-label">
                Bahagian <span class="required">*</span>
              </label>
              <select
                id="bahagian_id"
                name="bahagian_id"
                class="form-select @error('bahagian_id') is-invalid @enderror"
                required
              >
                <option value="">-- Pilih Bahagian --</option>
                @foreach ($bahagians as $bahagian)
                  <option value="{{ $bahagian->id }}" {{ old('bahagian_id') == $bahagian->id ? 'selected' : '' }}>
                    {{ $bahagian->nama_bahagian }}
                  </option>
                @endforeach
              </select>
              @error('bahagian_id')
                <span class="invalid-feedback">
                  <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="password" class="form-label">
                Kata Laluan <span class="required">*</span>
              </label>
              <div class="password-input-wrapper">
                <input
                  type="password"
                  id="password"
                  name="password"
                  class="form-input @error('password') is-invalid @enderror"
                  placeholder="Masukkan kata laluan"
                  required
                >
                <button type="button" class="password-toggle" onclick="togglePassword('password', this)">
                  <i class="fa-solid fa-eye"></i>
                </button>
              </div>
              @error('password')
                <span class="invalid-feedback">
                  <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="password_confirmation" class="form-label">
                Sahkan Kata Laluan <span class="required">*</span>
              </label>
              <div class="password-input-wrapper">
                <input
                  type="password"
                  id="password_confirmation"
                  name="password_confirmation"
                  class="form-input"
                  placeholder="Sahkan kata laluan"
                  required
                >
                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)">
                  <i class="fa-solid fa-eye"></i>
                </button>
              </div>
            </div>
          </div>

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

          <button type="submit" class="btn-register">
            <i class="fa-solid fa-user-plus"></i>
            Daftar Sekarang
          </button>
        </form>

        <div class="register-footer">
          Sudah mempunyai akaun? <a href="{{ route('login') }}">Log Masuk</a>
        </div>
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

      // IC number formatting - numbers only
      const nokpInput = document.getElementById('nokp');
      nokpInput.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
  <script>
    // Initialize Tom Select on bahagian_id dropdown
    document.addEventListener('DOMContentLoaded', function() {
      const bahagianSelect = document.getElementById('bahagian_id');
      if (bahagianSelect && typeof TomSelect !== 'undefined' && !bahagianSelect.tomselect) {
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
</body>
</html>
