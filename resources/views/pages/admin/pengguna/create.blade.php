@extends('layouts.app')

@section('title', 'Cipta Pengguna Baru')
@section('header_title', 'Cipta Pengguna Baru')
@section('header_subtitle', 'Tambah pengguna baru ke sistem')

@push('styles')
<style>
  .create-page {
    max-width: 800px;
  }

  .form-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  .form-card-header {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    background: var(--bg);
  }

  .form-card-header h3 {
    font-size: 16px;
    font-weight: 600;
    color: var(--ink);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .form-card-body {
    padding: 24px;
  }

  .form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }

  @media (max-width: 768px) {
    .form-grid {
      grid-template-columns: 1fr;
    }
  }

  .form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .form-group.full-width {
    grid-column: 1 / -1;
  }

  .form-label {
    font-size: 14px;
    font-weight: 600;
    color: var(--ink);
  }

  .form-label .required {
    color: #ef4444;
  }

  .form-input,
  .form-select {
    padding: 12px 14px;
    font-size: 14px;
    font-family: inherit;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    background: var(--panel);
    color: var(--ink);
    transition: all 0.2s;
    height: 46px;
    box-sizing: border-box;
  }

  .form-select {
    padding: 0 14px;
    cursor: pointer;
  }

  .form-input:focus,
  .form-select:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(59, 87, 244, 0.1);
  }

  .form-input.is-invalid,
  .form-select.is-invalid {
    border-color: #ef4444;
  }

  .invalid-feedback {
    color: #ef4444;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .form-hint {
    font-size: 12px;
    color: var(--muted);
  }

  .form-section {
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid var(--border);
  }

  .form-section-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .form-actions {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid var(--border);
  }

  .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    font-size: 14px;
    font-weight: 600;
    font-family: inherit;
    border-radius: var(--radius);
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
  }

  .btn-secondary {
    background: var(--bg);
    color: var(--ink);
    border: 1px solid var(--border);
  }

  .btn-secondary:hover {
    background: var(--border);
  }

  .btn-primary {
    background: var(--accent);
    color: #fff;
    border: none;
  }

  .btn-primary:hover {
    background: var(--accent-2);
    transform: translateY(-1px);
  }

  .alert {
    padding: 14px 16px;
    border-radius: var(--radius);
    margin-bottom: 20px;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .alert-danger {
    background: rgba(239, 68, 68, 0.15);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #ef4444;
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
    color: var(--muted);
    cursor: pointer;
    padding: 4px;
    font-size: 16px;
    transition: color 0.2s;
  }

  .password-toggle:hover {
    color: var(--ink);
  }

  .password-tips {
    margin-top: 16px;
    padding: 16px;
    background: var(--bg);
    border-radius: 8px;
    border: 1px solid var(--border);
  }

  .password-tips-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--ink);
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
    color: var(--ink);
    transition: all 0.2s ease;
  }

  .password-tips-item i {
    color: var(--muted);
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
</style>
@endpush

@section('content')
<div class="create-page">
  @if ($errors->any())
    <div class="alert alert-danger">
      <i class="fa-solid fa-circle-exclamation"></i>
      <span>Sila semak maklumat yang dimasukkan.</span>
    </div>
  @endif

  <div class="form-card">
    <div class="form-card-header">
      <h3>
        <i class="fa-solid fa-user-plus"></i>
        Maklumat Pengguna Baru
      </h3>
    </div>
    <div class="form-card-body">
      <form action="{{ route('admin.pengguna.store') }}" method="POST">
        @csrf

        <div class="form-grid">
          <div class="form-group">
            <label for="name" class="form-label">
              Nama Penuh <span class="required">*</span>
            </label>
            <input
              type="text"
              id="name"
              name="name"
              class="form-input @error('name') is-invalid @enderror"
              value="{{ old('name') }}"
              required
            >
            @error('name')
              <span class="invalid-feedback">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="nokp" class="form-label">No. Kad Pengenalan</label>
            <input
              type="text"
              id="nokp"
              name="nokp"
              class="form-input @error('nokp') is-invalid @enderror"
              value="{{ old('nokp') }}"
              placeholder="000000-00-0000"
            >
            @error('nokp')
              <span class="invalid-feedback">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="email" class="form-label">
              Emel <span class="required">*</span>
            </label>
            <input
              type="email"
              id="email"
              name="email"
              class="form-input @error('email') is-invalid @enderror"
              value="{{ old('email') }}"
              required
            >
            @error('email')
              <span class="invalid-feedback">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
              </span>
            @enderror
          </div>

          <div class="form-group">
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
                  {{ $bahagian->nama_pendek }} - {{ $bahagian->nama_bahagian }}
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
            <label for="role_id" class="form-label">
              Peranan <span class="required">*</span>
            </label>
            <select
              id="role_id"
              name="role_id"
              class="form-select @error('role_id') is-invalid @enderror"
              required
            >
              <option value="" disabled {{ old('role_id') ? '' : 'selected' }}>-- Pilih Peranan --</option>
              @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->display_name }}</option>
              @endforeach
            </select>
            @error('role_id')
              <span class="invalid-feedback">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="status" class="form-label">
              Status <span class="required">*</span>
            </label>
            <select
              id="status"
              name="status"
              class="form-select @error('status') is-invalid @enderror"
              required
            >
              <option value="aktif" {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}>Aktif</option>
              <option value="tidak_aktif" {{ old('status') === 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
            @error('status')
              <span class="invalid-feedback">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
              </span>
            @enderror
          </div>
        </div>

        <div class="form-section">
          <div class="form-section-title">
            <i class="fa-solid fa-lock"></i>
            Kata Laluan
          </div>
          <div class="form-grid">
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
              <label for="password_confirmation" class="form-label">
                Sahkan Kata Laluan <span class="required">*</span>
              </label>
              <div class="password-input-wrapper">
                <input
                  type="password"
                  id="password_confirmation"
                  name="password_confirmation"
                  class="form-input"
                  required
                >
                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)">
                  <i class="fa-solid fa-eye"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="form-actions">
          <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
          </a>
          <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-user-plus"></i>
            Cipta Pengguna
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
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
@endpush
