@extends('layouts.app')

@section('title', 'Butiran Permohonan')
@section('header_title', 'Butiran Permohonan')
@section('header_subtitle', 'Semak dan proses permohonan')

@push('styles')
<style>
  .detail-page {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 24px;
  }

  @media (max-width: 992px) {
    .detail-page {
      grid-template-columns: 1fr;
    }

    .action-sidebar {
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

  .detail-section {
    margin-bottom: 24px;
  }

  .detail-section:last-child {
    margin-bottom: 0;
  }

  .detail-section-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 16px;
    padding-bottom: 8px;
    border-bottom: 1px solid var(--border);
  }

  .detail-row {
    display: flex;
    padding: 12px 0;
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
  }

  .action-sidebar {
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

  .action-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  .action-card-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    font-size: 14px;
    font-weight: 600;
    color: var(--ink);
  }

  .action-card-body {
    padding: 20px;
  }

  .form-group {
    margin-bottom: 16px;
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

  .form-control {
    width: 100%;
    padding: 10px 14px;
    font-size: 14px;
    color: var(--ink);
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    transition: all 0.2s ease;
    resize: vertical;
  }

  .form-control:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(59, 87, 244, 0.15);
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

  .action-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 20px;
    font-size: 14px;
    font-weight: 600;
    border-radius: var(--radius);
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s ease;
    width: 100%;
  }

  .btn-success {
    background: linear-gradient(135deg, #27c2a4, #20a88e);
    border: none;
    color: #fff;
  }

  .btn-success:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(39, 194, 164, 0.3);
  }

  .btn-danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    border: none;
    color: #fff;
  }

  .btn-danger:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
  }

  .btn-secondary {
    background: var(--panel);
    border: 1px solid var(--border);
    color: var(--ink);
  }

  .btn-secondary:hover {
    background: var(--bg);
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
    margin-bottom: 12px;
  }

  .info-card-content {
    font-size: 14px;
    color: var(--ink);
    line-height: 1.6;
  }

  .processed-info {
    background: var(--bg);
    border-radius: var(--radius);
    padding: 16px;
    text-align: center;
  }

  .processed-info p {
    font-size: 14px;
    color: var(--muted);
    margin: 0;
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
        <div class="detail-section">
          <div class="detail-section-title">Maklumat Pemohon</div>
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
        </div>

        <div class="detail-section">
          <div class="detail-section-title">Maklumat Pengguna Penghantar</div>
          <div class="detail-row">
            <div class="detail-label">Dihantar Oleh</div>
            <div class="detail-value">{{ $permohonan->pengguna->name ?? '-' }}</div>
          </div>
          <div class="detail-row">
            <div class="detail-label">Tarikh Permohonan</div>
            <div class="detail-value">{{ $permohonan->created_at->format('d/m/Y H:i') }}</div>
          </div>
        </div>

        @if ($permohonan->tarikh_keputusan)
          <div class="detail-section">
            <div class="detail-section-title">Maklumat Keputusan</div>
            <div class="detail-row">
              <div class="detail-label">Status</div>
              <div class="detail-value">
                <span class="status-badge {{ $permohonan->status_color }}">
                  {{ $permohonan->status_label }}
                </span>
              </div>
            </div>
            <div class="detail-row">
              <div class="detail-label">Tarikh Keputusan</div>
              <div class="detail-value">{{ $permohonan->tarikh_keputusan->format('d/m/Y H:i') }}</div>
            </div>
            @if ($permohonan->catatan)
              <div class="detail-row">
                <div class="detail-label">Catatan</div>
                <div class="detail-value">{{ $permohonan->catatan }}</div>
              </div>
            @endif
          </div>
        @endif
      </div>

      <div class="detail-card-footer">
        <a href="{{ route('admin.permohonan.index') }}" class="btn btn-secondary" style="width: auto;">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali ke Senarai
        </a>
      </div>
    </div>
  </div>

  <div class="action-sidebar">
    <div class="status-card">
      @if ($permohonan->status === 'dalam_semakan')
        <div class="status-icon warning">
          <i class="fa-solid fa-clock"></i>
        </div>
        <div class="status-label">Dalam Semakan</div>
        <div class="status-date">Menunggu tindakan</div>
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

    @if ($permohonan->status === 'dalam_semakan')
      <div class="action-card">
        <div class="action-card-header">
          <i class="fa-solid fa-gavel"></i>
          Tindakan
        </div>
        <div class="action-card-body">
          <div class="action-buttons">
            <form action="{{ route('admin.permohonan.approve', $permohonan) }}" method="POST" id="approveForm">
              @csrf
              <input type="hidden" name="catatan" id="approveCatatan">
              <button type="button" class="btn btn-success" onclick="approvePermohonan()">
                <i class="fa-solid fa-check"></i>
                Luluskan
              </button>
            </form>

            <button type="button" class="btn btn-danger" onclick="showRejectModal()">
              <i class="fa-solid fa-times"></i>
              Tolak
            </button>
          </div>

          <div class="form-text" style="text-align: center; margin-top: 12px;">
            Kelulusan akan mencipta akaun pengguna baru secara automatik.
          </div>
        </div>
      </div>
    @else
      <div class="info-card">
        <div class="info-card-title">Status Permohonan</div>
        <div class="processed-info">
          <p>Permohonan ini telah diproses pada {{ $permohonan->tarikh_keputusan?->format('d/m/Y') }}.</p>
        </div>
      </div>

      @if ($permohonan->catatan)
        <div class="info-card">
          <div class="info-card-title">Catatan</div>
          <div class="info-card-content">{{ $permohonan->catatan }}</div>
        </div>
      @endif
    @endif
  </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
  <div style="background: var(--panel); border-radius: var(--radius); padding: 24px; max-width: 480px; width: 90%; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
    <h4 style="font-size: 18px; font-weight: 700; color: var(--ink); margin: 0 0 16px;">Tolak Permohonan</h4>
    <form action="{{ route('admin.permohonan.reject', $permohonan) }}" method="POST">
      @csrf
      <div class="form-group">
        <label class="form-label">Sebab Penolakan <span style="color: #ef4444;">*</span></label>
        <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="4" placeholder="Masukkan sebab penolakan..." required>{{ old('catatan') }}</textarea>
        @error('catatan')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 20px;">
        <button type="button" class="btn btn-secondary" style="width: auto;" onclick="hideRejectModal()">Batal</button>
        <button type="submit" class="btn btn-danger" style="width: auto;">
          <i class="fa-solid fa-times"></i>
          Tolak Permohonan
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
function approvePermohonan() {
  if (confirm('Adakah anda pasti untuk meluluskan permohonan ini? Akaun pengguna baru akan dicipta secara automatik.')) {
    document.getElementById('approveForm').submit();
  }
}

function showRejectModal() {
  document.getElementById('rejectModal').style.display = 'flex';
}

function hideRejectModal() {
  document.getElementById('rejectModal').style.display = 'none';
}

// Close modal when clicking outside
document.getElementById('rejectModal').addEventListener('click', function(e) {
  if (e.target === this) {
    hideRejectModal();
  }
});
</script>
@endpush
