@extends('layouts.app')

@section('title', 'Tukar Kata Laluan')
@section('header_title', 'Tukar Kata Laluan')
@section('header_subtitle', 'Kemaskini kata laluan akaun anda')

@push('styles')
<style>
  .password-page {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 24px;
  }

  @media (max-width: 992px) {
    .password-page {
      grid-template-columns: 1fr;
    }
  }

  .password-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .password-info-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 24px;
    box-shadow: var(--shadow);
  }

  .password-info-card .info-icon {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    background: linear-gradient(135deg, rgba(59,87,244,.12), rgba(39,194,164,.12));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--accent);
    font-size: 24px;
    margin-bottom: 16px;
  }

  .password-info-card h5 {
    font-size: 16px;
    font-weight: 700;
    color: var(--ink);
    margin: 0 0 8px;
  }

  .password-info-card p {
    font-size: 13px;
    color: var(--muted);
    margin: 0;
    line-height: 1.6;
  }

  .password-tips {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--shadow);
  }

  .password-tips-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 16px;
  }

  .password-tips-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .password-tips-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 13px;
    color: var(--ink);
    transition: all 0.2s ease;
  }

  .password-tips-item i {
    color: var(--muted);
    margin-top: 2px;
    font-size: 8px;
    transition: all 0.2s ease;
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

  .password-form-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  .password-form-header {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .password-form-header i {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, rgba(59,87,244,.12), rgba(39,194,164,.12));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--accent);
    font-size: 18px;
  }

  .password-form-header h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: var(--ink);
  }

  .password-form-header p {
    margin: 2px 0 0;
    font-size: 13px;
    color: var(--muted);
  }

  .password-form-body {
    padding: 24px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group:last-child {
    margin-bottom: 0;
  }

  .form-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 8px;
  }

  .form-group label .required {
    color: #ef4444;
  }

  .form-group .form-control {
    width: 100%;
    padding: 12px 16px;
    font-size: 14px;
    font-family: inherit;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: var(--panel-2);
    color: var(--ink);
    transition: all 0.2s ease;
  }

  .form-group .form-control:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(59, 87, 244, 0.12);
  }

  .form-group .form-control.is-invalid {
    border-color: #ef4444;
  }

  .form-group .form-hint {
    font-size: 12px;
    color: var(--muted);
    margin-top: 6px;
  }

  .form-group .invalid-feedback {
    font-size: 12px;
    color: #ef4444;
    margin-top: 6px;
  }

  .password-input-wrapper {
    position: relative;
  }

  .password-input-wrapper .form-control {
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

  .password-form-footer {
    padding: 20px 24px;
    border-top: 1px solid var(--border);
    background: var(--panel-2);
    display: flex;
    justify-content: flex-end;
    gap: 12px;
  }

  .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    font-size: 14px;
    font-weight: 600;
    font-family: inherit;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
  }

  .btn-secondary {
    background: var(--panel);
    border: 1px solid var(--border);
    color: var(--ink);
  }

  .btn-secondary:hover {
    background: var(--panel-2);
    border-color: var(--accent);
  }

  .btn-primary {
    background: linear-gradient(135deg, #3b57f4 0%, #27c2a4 100%);
    border: none;
    color: white;
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(59, 87, 244, 0.4);
  }

  .alert {
    padding: 14px 18px;
    border-radius: 10px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14px;
  }

  .alert-success {
    background: rgba(39, 194, 164, 0.12);
    border: 1px solid rgba(39, 194, 164, 0.3);
    color: #059669;
  }

  .alert-danger {
    background: rgba(239, 68, 68, 0.12);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #dc2626;
  }

  .alert i {
    font-size: 18px;
  }

  .alert .btn-close {
    margin-left: auto;
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    color: inherit;
    opacity: 0.6;
  }

  .alert .btn-close:hover {
    opacity: 1;
  }
</style>
@endpush

@section('content')
  @if (session('success'))
    <div class="alert alert-success">
      <i class="fa-solid fa-circle-check"></i>
      <span>{{ session('success') }}</span>
      <button type="button" class="btn-close" onclick="this.parentElement.remove()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
      <i class="fa-solid fa-circle-exclamation"></i>
      <span>Sila semak maklumat yang diisi.</span>
      <button type="button" class="btn-close" onclick="this.parentElement.remove()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
  @endif

  <div class="password-page">
    {{-- Sidebar --}}
    <div class="password-sidebar">
      <div class="password-info-card">
        <div class="info-icon">
          <i class="fa-solid fa-shield-halved"></i>
        </div>
        <h5>Keselamatan Akaun</h5>
        <p>Pastikan kata laluan anda kukuh dan unik untuk melindungi akaun anda daripada akses tidak dibenarkan.</p>
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
    </div>

    {{-- Form --}}
    <div class="password-form-card">
      <div class="password-form-header">
        <i class="fa-solid fa-key"></i>
        <div>
          <h5>Tukar Kata Laluan</h5>
          <p>Masukkan kata laluan semasa dan kata laluan baru anda</p>
        </div>
      </div>

      <form action="{{ route('password.change.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="password-form-body">
          <div class="form-group">
            <label for="current_password">Kata Laluan Semasa <span class="required">*</span></label>
            <div class="password-input-wrapper">
              <input
                type="password"
                class="form-control @error('current_password') is-invalid @enderror"
                id="current_password"
                name="current_password"
                placeholder="Masukkan kata laluan semasa"
                required
              >
              <button type="button" class="password-toggle" onclick="togglePassword('current_password', this)">
                <i class="fa-solid fa-eye"></i>
              </button>
            </div>
            @error('current_password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="password">Kata Laluan Baru <span class="required">*</span></label>
            <div class="password-input-wrapper">
              <input
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                id="password"
                name="password"
                placeholder="Masukkan kata laluan baru"
                required
              >
              <button type="button" class="password-toggle" onclick="togglePassword('password', this)">
                <i class="fa-solid fa-eye"></i>
              </button>
            </div>
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-hint">Minimum 12 aksara dengan huruf besar, huruf kecil, nombor dan aksara khas (@$!%*?&)</div>
          </div>

          <div class="form-group">
            <label for="password_confirmation">Sahkan Kata Laluan Baru <span class="required">*</span></label>
            <div class="password-input-wrapper">
              <input
                type="password"
                class="form-control"
                id="password_confirmation"
                name="password_confirmation"
                placeholder="Sahkan kata laluan baru"
                required
              >
              <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)">
                <i class="fa-solid fa-eye"></i>
              </button>
            </div>
          </div>
        </div>

        <div class="password-form-footer">
          <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Kembali
          </a>
          <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-lock"></i> Tukar Kata Laluan
          </button>
        </div>
      </form>
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
