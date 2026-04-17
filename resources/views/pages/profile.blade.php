@extends('layouts.app')

@section('title', 'Profil Pengguna')
@section('header_title', 'Profil Pengguna')
@section('header_subtitle', 'Kemaskini maklumat peribadi anda')

@push('styles')
<style>
  .profile-container {
    width: 100%;
  }

  .profile-avatar-section {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 32px 24px 24px;
    text-align: center;
    box-shadow: var(--shadow);
    margin-bottom: 20px;
  }

  .profile-avatar-wrapper {
    position: relative;
    display: inline-block;
    margin-bottom: 16px;
  }

  .profile-avatar-large {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(59,87,244,.15), rgba(39,194,164,.15));
    border: 4px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .profile-avatar-large:hover {
    border-color: var(--accent);
    transform: scale(1.02);
  }

  .profile-avatar-large img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .profile-avatar-large .initials {
    font-size: 44px;
    font-weight: 700;
    color: var(--accent);
  }

  .avatar-upload-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 40%;
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
    border-radius: 0 0 50% 50%;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding-bottom: 10px;
    opacity: 0;
    transition: opacity 0.3s ease;
    cursor: pointer;
  }

  .profile-avatar-wrapper:hover .avatar-upload-overlay {
    opacity: 1;
  }

  .avatar-upload-overlay i {
    color: white;
    font-size: 18px;
  }

  .avatar-upload-input {
    display: none;
  }

  .profile-display-name {
    font-size: 22px;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 4px;
  }

  .profile-display-role {
    font-size: 13px;
    color: var(--muted);
    margin-bottom: 12px;
  }

  .profile-meta {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    flex-wrap: wrap;
  }

  .profile-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    background: linear-gradient(135deg, rgba(59,87,244,.12), rgba(39,194,164,.12));
    border: 1px solid var(--border);
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    color: var(--accent);
  }

  .profile-date {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: var(--muted);
  }

  .profile-date i {
    color: var(--accent);
  }

  .avatar-hint {
    font-size: 11px;
    color: var(--muted);
    margin-top: 14px;
    opacity: 0.8;
  }

  .profile-form-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  .profile-form-header {
    padding: 18px 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .profile-form-header i {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: linear-gradient(135deg, rgba(59,87,244,.12), rgba(39,194,164,.12));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--accent);
    font-size: 16px;
  }

  .profile-form-header h5 {
    margin: 0;
    font-size: 15px;
    font-weight: 700;
    color: var(--ink);
  }

  .profile-form-header p {
    margin: 2px 0 0;
    font-size: 12px;
    color: var(--muted);
  }

  .profile-form-body {
    padding: 24px;
  }

  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
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
    padding: 11px 14px;
    font-size: 14px;
    font-family: inherit;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: var(--panel-2);
    color: var(--ink);
    transition: all 0.2s ease;
    height: 44px;
    box-sizing: border-box;
    line-height: 1.4;
  }

  .form-group select.form-control {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding: 0 36px 0 14px;
    cursor: pointer;
    line-height: 42px;
  }

  .form-group .form-control:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(59, 87, 244, 0.12);
  }

  .form-group .form-control:disabled {
    background: var(--panel-2);
    color: var(--ink);
    opacity: 1;
    cursor: not-allowed;
  }

  .form-group .form-control.is-invalid {
    border-color: #ef4444;
  }

  .form-group .form-hint {
    font-size: 11px;
    color: var(--muted);
    margin-top: 5px;
  }

  .form-group .invalid-feedback {
    font-size: 12px;
    color: #ef4444;
    margin-top: 5px;
  }

  .profile-form-footer {
    padding: 18px 24px;
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
    padding: 11px 18px;
    font-size: 13px;
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

  <div class="profile-container">
    {{-- Profile Avatar Section - Centered Above --}}
    <div class="profile-avatar-section">
      <div class="profile-avatar-wrapper" onclick="document.getElementById('profile_picture').click()">
        <div class="profile-avatar-large">
          @if ($user->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" id="avatar-preview">
          @else
            <span class="initials" id="avatar-initials">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
            <img src="" alt="{{ $user->name }}" id="avatar-preview" style="display: none;">
          @endif
        </div>
        <div class="avatar-upload-overlay">
          <i class="fa-solid fa-camera"></i>
        </div>
      </div>
      <div class="profile-display-name">{{ $user->name }}</div>
      <div class="profile-display-role">{{ $user->bahagian->nama_pendek ?? 'Tiada Bahagian' }}</div>
      <div class="profile-meta">
        <div class="profile-badge">
          <i class="fa-solid fa-shield-halved"></i>
          {{ ucfirst($user->role) }}
        </div>
        <div class="profile-date">
          <i class="fa-solid fa-calendar"></i>
          Daftar sejak {{ $user->created_at->format('d M Y') }}
        </div>
      </div>
      <div class="avatar-hint">Klik pada gambar untuk memuat naik foto baharu (JPEG, PNG, JPG, GIF, WEBP - Maks 2MB)</div>
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

      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Hidden file input for profile picture --}}
        <input
          type="file"
          class="avatar-upload-input"
          id="profile_picture"
          name="profile_picture"
          accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
          onchange="previewAvatar(this)"
        >

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
                @if (in_array($user->role, ['user', 'pengguna'])) disabled @endif
              >
              @error('nokp')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @if (in_array($user->role, ['user', 'pengguna']))
                <div class="form-hint">Maklumat ini hanya boleh dikemaskini oleh pentadbir</div>
              @else
                <div class="form-hint">Masukkan 12 digit tanpa sempang (-)</div>
              @endif
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
              <label>Bahagian</label>
              <input
                type="text"
                class="form-control"
                value="{{ $user->bahagian->nama_bahagian ?? 'Tiada Bahagian' }}"
                disabled
              >
              <div class="form-hint">Bahagian ditetapkan oleh pentadbir sistem</div>
            </div>

            <div class="form-group full-width">
              <label>Peranan</label>
              <input
                type="text"
                class="form-control"
                value="{{ $user->roleModel ? $user->roleModel->display_name : ucfirst($user->role) }}"
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

@push('scripts')
<script>
  function previewAvatar(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();

      reader.onload = function(e) {
        const preview = document.getElementById('avatar-preview');
        const initials = document.getElementById('avatar-initials');

        preview.src = e.target.result;
        preview.style.display = 'block';

        if (initials) {
          initials.style.display = 'none';
        }
      }

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endpush
