@extends('layouts.app')

@section('title', 'Permohonan Baru')
@section('header_title', 'Permohonan ID Pengguna Baru')
@section('header_subtitle', 'Isi maklumat untuk permohonan ID pengguna baru')

@push('styles')
<style>
  .form-page {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 24px;
  }

  @media (max-width: 992px) {
    .form-page {
      grid-template-columns: 1fr;
    }
  }

  .form-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .info-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 24px;
    box-shadow: var(--shadow);
  }

  .info-card .info-icon {
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

  .info-card h5 {
    font-size: 16px;
    font-weight: 700;
    color: var(--ink);
    margin: 0 0 8px;
  }

  .info-card p {
    font-size: 13px;
    color: var(--muted);
    margin: 0;
    line-height: 1.6;
  }

  .tips-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--shadow);
  }

  .tips-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 16px;
  }

  .tips-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .tips-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 13px;
    color: var(--ink);
  }

  .tips-item i {
    color: var(--accent);
    margin-top: 2px;
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
  }

  .form-card-header h4 {
    font-size: 16px;
    font-weight: 700;
    color: var(--ink);
    margin: 0;
  }

  .form-card-body {
    padding: 24px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group:last-child {
    margin-bottom: 0;
  }

  .form-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 8px;
  }

  .form-label .required {
    color: #ef4444;
  }

  .form-control {
    width: 100%;
    padding: 10px 14px;
    font-size: 14px;
    color: var(--ink);
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    transition: all 0.2s ease;
  }

  .form-control:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(59, 87, 244, 0.15);
  }

  .form-control.is-invalid {
    border-color: #ef4444;
  }

  .form-control.is-invalid:focus {
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
  }

  .form-text {
    font-size: 12px;
    color: var(--muted);
    margin-top: 6px;
  }

  .invalid-feedback {
    font-size: 12px;
    color: #ef4444;
    margin-top: 6px;
  }

  .form-card-footer {
    padding: 20px 24px;
    border-top: 1px solid var(--border);
    background: var(--bg);
    display: flex;
    justify-content: flex-end;
    gap: 12px;
  }

  .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: 600;
    border-radius: var(--radius);
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s ease;
  }

  .btn-secondary {
    background: var(--panel);
    border: 1px solid var(--border);
    color: var(--ink);
  }

  .btn-secondary:hover {
    background: var(--bg);
  }

  .btn-primary {
    background: linear-gradient(135deg, var(--accent), var(--accent-2));
    border: none;
    color: #fff;
  }

  .btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 87, 244, 0.3);
  }
</style>
@endpush

@section('content')
<div class="form-page">
  <div class="form-sidebar">
    <div class="info-card">
      <div class="info-icon">
        <i class="fa-solid fa-user-plus"></i>
      </div>
      <h5>Permohonan ID Baru</h5>
      <p>Sila isi maklumat lengkap untuk permohonan ID pengguna baru. Permohonan akan disemak oleh pentadbir sistem.</p>
    </div>

    <div class="tips-card">
      <div class="tips-title">Panduan Pengisian</div>
      <div class="tips-list">
        <div class="tips-item">
          <i class="fa-solid fa-check-circle"></i>
          <span>Pastikan nama penuh seperti dalam kad pengenalan</span>
        </div>
        <div class="tips-item">
          <i class="fa-solid fa-check-circle"></i>
          <span>No. KP mestilah 12 digit tanpa tanda sempang (-)</span>
        </div>
        <div class="tips-item">
          <i class="fa-solid fa-check-circle"></i>
          <span>Gunakan emel rasmi kementerian/jabatan</span>
        </div>
        <div class="tips-item">
          <i class="fa-solid fa-check-circle"></i>
          <span>Pilih bahagian yang betul</span>
        </div>
      </div>
    </div>
  </div>

  <form action="{{ route('permohonan.store') }}" method="POST">
    @csrf
    <div class="form-card">
      <div class="form-card-header">
        <h4>Maklumat Permohonan</h4>
      </div>

      <div class="form-card-body">
        <div class="form-group">
          <label class="form-label">
            Nama Penuh <span class="required">*</span>
          </label>
          <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukkan nama penuh">
          @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">
            No. Kad Pengenalan <span class="required">*</span>
          </label>
          <input type="text" name="nokp" class="form-control @error('nokp') is-invalid @enderror" value="{{ old('nokp') }}" placeholder="Contoh: 880101125555" maxlength="12">
          <div class="form-text">Masukkan 12 digit tanpa tanda sempang (-)</div>
          @error('nokp')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">
            Alamat Emel <span class="required">*</span>
          </label>
          <input type="email" name="emel" class="form-control @error('emel') is-invalid @enderror" value="{{ old('emel') }}" placeholder="Contoh: nama@kpm.gov.my">
          @error('emel')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">
            Bahagian <span class="required">*</span>
          </label>
          <select name="bahagian_id" class="form-control @error('bahagian_id') is-invalid @enderror">
            <option value="">-- Pilih Bahagian --</option>
            @foreach ($bahagians as $bahagian)
              <option value="{{ $bahagian->id }}" {{ old('bahagian_id') == $bahagian->id ? 'selected' : '' }}>
                {{ $bahagian->nama_bahagian }}
              </option>
            @endforeach
          </select>
          @error('bahagian_id')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="form-card-footer">
        <a href="{{ route('permohonan.index') }}" class="btn btn-secondary">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali
        </a>
        <button type="submit" class="btn btn-primary">
          <i class="fa-solid fa-paper-plane"></i>
          Hantar Permohonan
        </button>
      </div>
    </div>
  </form>
</div>
@endsection
