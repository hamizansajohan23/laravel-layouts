@extends('layouts.app')

@section('title', 'Senarai Permohonan')
@section('header_title', 'Senarai Permohonan')
@section('header_subtitle', 'Urus permohonan ID pengguna baru')

@push('styles')
<style>
  .permohonan-page {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  .filter-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 16px 20px;
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
  }

  .filter-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--muted);
  }

  .filter-select {
    padding: 8px 12px;
    font-size: 14px;
    color: var(--ink);
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    min-width: 180px;
  }

  .filter-select:focus {
    outline: none;
    border-color: var(--accent);
  }

  .stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
  }

  .stat-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    gap: 16px;
  }

  .stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
  }

  .stat-icon.warning {
    background: rgba(255, 193, 7, 0.15);
    color: #e6a700;
  }

  .stat-icon.success {
    background: rgba(39, 194, 164, 0.15);
    color: #27c2a4;
  }

  .stat-icon.danger {
    background: rgba(239, 68, 68, 0.15);
    color: #ef4444;
  }

  .stat-icon.primary {
    background: rgba(59, 87, 244, 0.15);
    color: var(--accent);
  }

  .stat-info h4 {
    font-size: 24px;
    font-weight: 700;
    color: var(--ink);
    margin: 0 0 4px;
  }

  .stat-info p {
    font-size: 13px;
    color: var(--muted);
    margin: 0;
  }

  .table-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  .table-responsive {
    overflow-x: auto;
  }

  .data-table {
    width: 100%;
    border-collapse: collapse;
  }

  .data-table th,
  .data-table td {
    padding: 14px 16px;
    text-align: left;
    border-bottom: 1px solid var(--border);
  }

  .data-table th {
    background: var(--bg);
    font-size: 12px;
    font-weight: 600;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .data-table td {
    font-size: 14px;
    color: var(--ink);
  }

  .data-table tbody tr:hover {
    background: var(--bg);
  }

  .data-table tbody tr:last-child td {
    border-bottom: none;
  }

  .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
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

  .btn-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 12px;
    border-radius: 6px;
    border: 1px solid var(--border);
    background: var(--panel);
    color: var(--accent);
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    gap: 6px;
  }

  .btn-action:hover {
    background: var(--accent);
    border-color: var(--accent);
    color: #fff;
  }

  .empty-state {
    padding: 60px 20px;
    text-align: center;
  }

  .empty-state-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: var(--bg);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 32px;
    color: var(--muted);
  }

  .empty-state h4 {
    font-size: 18px;
    font-weight: 600;
    color: var(--ink);
    margin: 0 0 8px;
  }

  .empty-state p {
    font-size: 14px;
    color: var(--muted);
    margin: 0;
  }

  .pagination-wrapper {
    padding: 16px;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: center;
  }

  .alert {
    padding: 14px 16px;
    border-radius: var(--radius);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
  }

  .alert-success {
    background: rgba(39, 194, 164, 0.12);
    border: 1px solid rgba(39, 194, 164, 0.3);
    color: #27c2a4;
  }

  .alert-error {
    background: rgba(239, 68, 68, 0.12);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #ef4444;
  }

  .user-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .user-name {
    font-weight: 600;
  }

  .user-email {
    font-size: 12px;
    color: var(--muted);
  }
</style>
@endpush

@section('content')
<div class="permohonan-page">
  @if (session('success'))
    <div class="alert alert-success">
      <i class="fa-solid fa-check-circle"></i>
      {{ session('success') }}
    </div>
  @endif

  @if (session('error'))
    <div class="alert alert-error">
      <i class="fa-solid fa-exclamation-circle"></i>
      {{ session('error') }}
    </div>
  @endif

  <div class="filter-card">
    <span class="filter-label">Tapis mengikut status:</span>
    <select class="filter-select" onchange="window.location.href='{{ route('admin.permohonan.index') }}?status=' + this.value">
      <option value="dalam_semakan" {{ $status === 'dalam_semakan' ? 'selected' : '' }}>Dalam Semakan</option>
      <option value="diluluskan" {{ $status === 'diluluskan' ? 'selected' : '' }}>Diluluskan</option>
      <option value="ditolak" {{ $status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
      <option value="semua" {{ $status === 'semua' ? 'selected' : '' }}>Semua Status</option>
    </select>
  </div>

  <div class="table-card">
    @if ($permohonans->count() > 0)
      <div class="table-responsive">
        <table class="data-table">
          <thead>
            <tr>
              <th>Bil</th>
              <th>Pemohon</th>
              <th>No. KP</th>
              <th>Bahagian</th>
              <th>Status</th>
              <th>Tarikh</th>
              <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($permohonans as $index => $permohonan)
              <tr>
                <td>{{ $permohonans->firstItem() + $index }}</td>
                <td>
                  <div class="user-info">
                    <span class="user-name">{{ $permohonan->nama }}</span>
                    <span class="user-email">{{ $permohonan->emel }}</span>
                  </div>
                </td>
                <td>{{ $permohonan->nokp }}</td>
                <td>{{ $permohonan->bahagian->nama_pendek }}</td>
                <td>
                  <span class="status-badge {{ $permohonan->status_color }}">
                    <i class="fa-solid fa-circle" style="font-size: 6px;"></i>
                    {{ $permohonan->status_label }}
                  </span>
                </td>
                <td>{{ $permohonan->created_at->format('d/m/Y') }}</td>
                <td>
                  <a href="{{ route('admin.permohonan.show', $permohonan) }}" class="btn-action">
                    <i class="fa-solid fa-eye"></i>
                    Lihat
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @if ($permohonans->hasPages())
        <div class="pagination-wrapper">
          {{ $permohonans->withQueryString()->links() }}
        </div>
      @endif
    @else
      <div class="empty-state">
        <div class="empty-state-icon">
          <i class="fa-solid fa-inbox"></i>
        </div>
        <h4>Tiada Permohonan</h4>
        <p>Tiada permohonan yang sepadan dengan kriteria carian.</p>
      </div>
    @endif
  </div>
</div>
@endsection
