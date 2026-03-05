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
    background: var(--accent2);
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
            <label for="role" class="form-label">
              Peranan <span class="required">*</span>
            </label>
            <select
              id="role"
              name="role"
              class="form-select @error('role') is-invalid @enderror"
              required
            >
              <option value="pengguna" {{ old('role', 'pengguna') === 'pengguna' ? 'selected' : '' }}>Pengguna</option>
              <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Pentadbir</option>
            </select>
            @error('role')
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
              <input
                type="password"
                id="password"
                name="password"
                class="form-input @error('password') is-invalid @enderror"
                required
              >
              <span class="form-hint">Minimum 8 aksara</span>
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
              <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="form-input"
                required
              >
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
