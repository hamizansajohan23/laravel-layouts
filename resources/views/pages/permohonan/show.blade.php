@extends('layouts.app')

@section('title', 'Butiran Permohonan')
@section('header_title', 'Butiran Permohonan')
@section('header_subtitle', 'Maklumat lengkap permohonan')

@push('styles')
<style>
  .detail-page {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 24px;
  }

  @media (max-width: 992px) {
    .detail-page {
      grid-template-columns: 1fr;
    }

    .detail-sidebar {
      order: -1;
    }
  }

  .detail-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  .detail-card-header {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .detail-card-header h4 {
    font-size: 16px;
    font-weight: 700;
    color: var(--ink);
    margin: 0;
  }

  .detail-card-body {
    padding: 24px;
  }

  .detail-row {
    display: flex;
    padding: 14px 0;
    border-bottom: 1px solid var(--border);
  }

  .detail-row:last-child {
    border-bottom: none;
  }

  .detail-label {
    width: 160px;
    flex-shrink: 0;
    font-size: 13px;
    font-weight: 600;
    color: var(--muted);
  }

  .detail-value {
    flex: 1;
    font-size: 14px;
    color: var(--ink);
  }

  .detail-card-footer {
    padding: 20px 24px;
    border-top: 1px solid var(--border);
    background: var(--bg);
    display: flex;
    justify-content: flex-start;
    gap: 12px;
  }

  .detail-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .status-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 24px;
    box-shadow: var(--shadow);
    text-align: center;
  }

  .status-icon {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
    font-size: 28px;
  }

  .status-icon.warning {
    background: rgba(255, 193, 7, 0.15);
    color: #e6a700;
  }

  .status-icon.success {
    background: rgba(39, 194, 164, 0.15);
    color: #27c2a4;
  }

  .status-icon.danger {
    background: rgba(239, 68, 68, 0.15);
    color: #ef4444;
  }

  .status-label {
    font-size: 18px;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 8px;
  }

  .status-date {
    font-size: 13px;
    color: var(--muted);
  }

  .info-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--shadow);
  }

  .info-card-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 16px;
  }

  .catatan-content {
    font-size: 14px;
    color: var(--ink);
    line-height: 1.6;
  }

  .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
  }

  .status-badge.warning {
    background: rgba(255, 193, 7, 0.15);
    color: #e6a700;
  }

  .status-badge.success {
    background: rgba(39, 194, 164, 0.15);
    color: #27c2a4;
  }

  .status-badge.danger {
    background: rgba(239, 68, 68, 0.15);
    color: #ef4444;
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
<div class="detail-page">
  <div class="detail-main">
    <div class="detail-card">
      <div class="detail-card-header">
        <h4>Maklumat Permohonan</h4>
        <span class="status-badge {{ $permohonan->status_color }}">
          {{ $permohonan->status_label }}
        </span>
      </div>

      <div class="detail-card-body">
        <div class="detail-row">
          <div class="detail-label">Nama Penuh</div>
          <div class="detail-value">{{ $permohonan->nama }}</div>
        </div>
        <div class="detail-row">
          <div class="detail-label">No. Kad Pengenalan</div>
          <div class="detail-value">{{ $permohonan->nokp }}</div>
        </div>
        <div class="detail-row">
          <div class="detail-label">Alamat Emel</div>
          <div class="detail-value">{{ $permohonan->emel }}</div>
        </div>
        <div class="detail-row">
          <div class="detail-label">Bahagian</div>
          <div class="detail-value">{{ $permohonan->bahagian->nama_bahagian }}</div>
        </div>
        <div class="detail-row">
          <div class="detail-label">Tarikh Permohonan</div>
          <div class="detail-value">{{ $permohonan->created_at->format('d/m/Y H:i') }}</div>
        </div>
        @if ($permohonan->tarikh_keputusan)
          <div class="detail-row">
            <div class="detail-label">Tarikh Keputusan</div>
            <div class="detail-value">{{ $permohonan->tarikh_keputusan->format('d/m/Y H:i') }}</div>
          </div>
        @endif
      </div>

      <div class="detail-card-footer">
        <a href="{{ route('permohonan.index') }}" class="btn btn-secondary">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali
        </a>
        @if ($permohonan->status === 'dalam_semakan')
          <a href="{{ route('permohonan.edit', $permohonan) }}" class="btn btn-primary">
            <i class="fa-solid fa-pen"></i>
            Edit
          </a>
        @endif
      </div>
    </div>
  </div>

  <div class="detail-sidebar">
    <div class="status-card">
      @if ($permohonan->status === 'dalam_semakan')
        <div class="status-icon warning">
          <i class="fa-solid fa-clock"></i>
        </div>
        <div class="status-label">Dalam Semakan</div>
        <div class="status-date">Menunggu kelulusan pentadbir</div>
      @elseif ($permohonan->status === 'diluluskan')
        <div class="status-icon success">
          <i class="fa-solid fa-check-circle"></i>
        </div>
        <div class="status-label">Diluluskan</div>
        <div class="status-date">{{ $permohonan->tarikh_keputusan?->format('d/m/Y') }}</div>
      @else
        <div class="status-icon danger">
          <i class="fa-solid fa-times-circle"></i>
        </div>
        <div class="status-label">Ditolak</div>
        <div class="status-date">{{ $permohonan->tarikh_keputusan?->format('d/m/Y') }}</div>
      @endif
    </div>

    @if ($permohonan->catatan)
      <div class="info-card">
        <div class="info-card-title">Catatan Pentadbir</div>
        <div class="catatan-content">{{ $permohonan->catatan }}</div>
      </div>
    @endif
  </div>
</div>
@endsection
