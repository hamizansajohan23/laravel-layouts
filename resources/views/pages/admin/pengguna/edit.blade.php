@extends('layouts.app')

@section('title', 'Kemaskini Pengguna')
@section('header_title', 'Kemaskini Pengguna')
@section('header_subtitle', 'Kemaskini maklumat pengguna sistem')

@push('styles')
<style>
  .edit-page {
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

  .alert-success {
    background: rgba(39, 194, 164, 0.15);
    border: 1px solid rgba(39, 194, 164, 0.3);
    color: #27c2a4;
  }

  .alert-danger {
    background: rgba(239, 68, 68, 0.15);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #ef4444;
  }

  .user-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
    padding-bottom: 24px;
    border-bottom: 1px solid var(--border);
  }

  .user-avatar {
    width: 64px;
    height: 64px;
    border-radius: 16px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 700;
    font-size: 24px;
  }

  .user-meta h3 {
    font-size: 18px;
    font-weight: 700;
    color: var(--ink);
    margin: 0 0 4px;
  }

  .user-meta p {
    font-size: 14px;
    color: var(--muted);
    margin: 0;
  }

  @media (max-width: 640px) {
    .form-grid {
      grid-template-columns: 1fr;
    }
    
    .form-actions {
      flex-direction: column;
    }
    
    .btn {
      justify-content: center;
    }
  }
</style>
@endpush

@section('content')
<div class="edit-page">
  @if (session('success'))
    <div class="alert alert-success">
      <i class="fa-solid fa-circle-check"></i>
      {{ session('success') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
      <i class="fa-solid fa-circle-exclamation"></i>
      Sila semak dan betulkan ralat di bawah.
    </div>
  @endif

  <div class="form-card">
    <div class="form-card-header">
      <h3>
        <i class="fa-solid fa-user-pen"></i>
        Kemaskini Maklumat Pengguna
      </h3>
    </div>
    <div class="form-card-body">
      <div class="user-header">
        <div class="user-avatar">
          {{ strtoupper(substr($pengguna->name, 0, 2)) }}
        </div>
        <div class="user-meta">
          <h3>{{ $pengguna->name }}</h3>
          <p>Didaftarkan pada {{ $pengguna->created_at->format('d F Y') }}</p>
        </div>
      </div>

      <form action="{{ route('admin.pengguna.update', $pengguna) }}" method="POST">
        @csrf
        @method('PUT')

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
              value="{{ old('name', $pengguna->name) }}"
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
              value="{{ old('nokp', $pengguna->nokp) }}"
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
              value="{{ old('email', $pengguna->email) }}"
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
                <option value="{{ $bahagian->id }}" {{ old('bahagian_id', $pengguna->bahagian_id) == $bahagian->id ? 'selected' : '' }}>
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
              <option value="pengguna" {{ old('role', $pengguna->role) === 'pengguna' ? 'selected' : '' }}>Pengguna</option>
              <option value="admin" {{ old('role', $pengguna->role) === 'admin' ? 'selected' : '' }}>Pentadbir</option>
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
              <option value="aktif" {{ old('status', $pengguna->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
              <option value="tidak_aktif" {{ old('status', $pengguna->status) === 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
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
            Tukar Kata Laluan (Pilihan)
          </div>
          <div class="form-grid">
            <div class="form-group">
              <label for="password" class="form-label">Kata Laluan Baru</label>
              <input
                type="password"
                id="password"
                name="password"
                class="form-input @error('password') is-invalid @enderror"
                placeholder="Kosongkan jika tidak mahu tukar"
              >
              <span class="form-hint">Minimum 8 aksara</span>
              @error('password')
                <span class="invalid-feedback">
                  <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="password_confirmation" class="form-label">Sahkan Kata Laluan</label>
              <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="form-input"
                placeholder="Masukkan semula kata laluan"
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
            <i class="fa-solid fa-save"></i>
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
