@extends('layouts.app')

@section('title', 'Profil Pengguna')
@section('header_title', 'Profil Pengguna')
@section('header_subtitle', 'Kemaskini maklumat peribadi anda')

@push('styles')
<style>
  .profile-page {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 24px;
  }

  @media (max-width: 992px) {
    .profile-page {
      grid-template-columns: 1fr;
    }
  }

  .profile-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .profile-avatar-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 32px 24px;
    text-align: center;
    box-shadow: var(--shadow);
  }

  .profile-avatar-large {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, rgba(59,87,244,.15), rgba(39,194,164,.15));
    border: 3px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }

  .profile-avatar-large img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .profile-avatar-large .initials {
    font-size: 42px;
    font-weight: 700;
    color: var(--accent);
  }

  .profile-display-name {
    font-size: 20px;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 4px;
  }

  .profile-display-role {
    font-size: 14px;
    color: var(--muted);
    margin-bottom: 16px;
  }

  .profile-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    background: linear-gradient(135deg, rgba(59,87,244,.12), rgba(39,194,164,.12));
    border: 1px solid var(--border);
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    color: var(--accent);
  }

  .profile-stats {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--shadow);
  }

  .profile-stats-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 16px;
  }

  .profile-stats-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .profile-stats-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 12px;
    background: var(--panel-2);
    border-radius: 10px;
  }

  .profile-stats-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: linear-gradient(135deg, rgba(59,87,244,.12), rgba(39,194,164,.12));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--accent);
  }

  .profile-stats-label {
    font-size: 12px;
    color: var(--muted);
  }

  .profile-stats-value {
    font-size: 14px;
    font-weight: 600;
    color: var(--ink);
  }

  .profile-form-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  .profile-form-header {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .profile-form-header i {
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

  .profile-form-header h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: var(--ink);
  }

  .profile-form-header p {
    margin: 2px 0 0;
    font-size: 13px;
    color: var(--muted);
  }

  .profile-form-body {
    padding: 24px;
  }

  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }

  @media (max-width: 768px) {
    .form-grid {
      grid-template-columns: 1fr;
    }
  }

  .form-grid .full-width {
    grid-column: 1 / -1;
  }

  .form-group {
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

  .form-group .form-control:disabled {
    opacity: 0.6;
    cursor: not-allowed;
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

  .profile-form-footer {
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

  <div class="profile-page">
    {{-- Sidebar --}}
    <div class="profile-sidebar">
      <div class="profile-avatar-card">
        <div class="profile-avatar-large">
          <img src="{{ asset('img/user.jpg') }}" alt="{{ $user->name }}">
        </div>
        <div class="profile-display-name">{{ $user->name }}</div>
        <div class="profile-display-role">{{ $user->bahagian->nama_pendek ?? 'Tiada Bahagian' }}</div>
        <div class="profile-badge">
          <i class="fa-solid fa-shield-halved"></i>
          {{ ucfirst($user->role) }}
        </div>
      </div>

      <div class="profile-stats">
        <div class="profile-stats-title">Maklumat Akaun</div>
        <div class="profile-stats-list">
          <div class="profile-stats-item">
            <div class="profile-stats-icon">
              <i class="fa-solid fa-envelope"></i>
            </div>
            <div>
              <div class="profile-stats-label">Emel</div>
              <div class="profile-stats-value">{{ $user->email }}</div>
            </div>
          </div>
          <div class="profile-stats-item">
            <div class="profile-stats-icon">
              <i class="fa-solid fa-id-card"></i>
            </div>
            <div>
              <div class="profile-stats-label">No. KP</div>
              <div class="profile-stats-value">{{ $user->nokp ?? '-' }}</div>
            </div>
          </div>
          <div class="profile-stats-item">
            <div class="profile-stats-icon">
              <i class="fa-solid fa-calendar"></i>
            </div>
            <div>
              <div class="profile-stats-label">Daftar Sejak</div>
              <div class="profile-stats-value">{{ $user->created_at->format('d M Y') }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Form --}}
    <div class="profile-form-card">
      <div class="profile-form-header">
        <i class="fa-solid fa-user-pen"></i>
        <div>
          <h5>Kemaskini Profil</h5>
          <p>Ubah maklumat peribadi anda di sini</p>
        </div>
      </div>

      <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="profile-form-body">
          <div class="form-grid">
            <div class="form-group">
              <label for="name">Nama Pengguna <span class="required">*</span></label>
              <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                name="name"
                value="{{ old('name', $user->name) }}"
                placeholder="Masukkan nama penuh"
                required
              >
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="nokp">No. Kad Pengenalan</label>
              <input
                type="text"
                class="form-control @error('nokp') is-invalid @enderror"
                id="nokp"
                name="nokp"
                value="{{ old('nokp', $user->nokp) }}"
                placeholder="Contoh: 901234567890"
                maxlength="12"
              >
              @error('nokp')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="form-hint">Masukkan 12 digit tanpa sempang (-)</div>
            </div>

            <div class="form-group">
              <label for="email">Emel <span class="required">*</span></label>
              <input
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                id="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                placeholder="nama@contoh.com"
                required
              >
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="bahagian_id">Bahagian</label>
              <select
                class="form-control @error('bahagian_id') is-invalid @enderror"
                id="bahagian_id"
                name="bahagian_id"
              >
                <option value="">-- Pilih Bahagian --</option>
                @foreach ($bahagians as $bahagian)
                  <option value="{{ $bahagian->id }}" {{ old('bahagian_id', $user->bahagian_id) == $bahagian->id ? 'selected' : '' }}>
                    {{ $bahagian->nama_bahagian }}
                  </option>
                @endforeach
              </select>
              @error('bahagian_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group full-width">
              <label>Peranan</label>
              <input
                type="text"
                class="form-control"
                value="{{ ucfirst($user->role) }}"
                disabled
              >
              <div class="form-hint">Peranan ditetapkan oleh pentadbir sistem dan tidak boleh diubah</div>
            </div>
          </div>
        </div>

        <div class="profile-form-footer">
          <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Kembali
          </a>
          <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection
