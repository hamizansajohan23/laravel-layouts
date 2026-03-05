@extends('layouts.app')

@section('title', 'Permohonan Pengguna')
@section('header_title', 'Permohonan Pengguna')
@section('header_subtitle', 'Senarai permohonan ID pengguna baru')

@push('styles')
<style>
  .permohonan-page {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  .page-header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
  }

  .btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s ease;
  }

  .btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 87, 244, 0.3);
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

  .action-buttons {
    display: flex;
    gap: 8px;
  }

  .btn-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: 1px solid var(--border);
    background: var(--panel);
    color: var(--muted);
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
  }

  .btn-action:hover {
    background: var(--accent);
    border-color: var(--accent);
    color: #fff;
  }

  .btn-action.edit:hover {
    background: #3b82f6;
    border-color: #3b82f6;
  }

  .btn-action.delete:hover {
    background: #ef4444;
    border-color: #ef4444;
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
    margin: 0 0 20px;
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

  <div class="page-header-actions">
    <div>
      <p style="margin: 0; font-size: 14px; color: var(--muted);">
        Jumlah permohonan: <strong>{{ $permohonans->total() }}</strong>
      </p>
    </div>
    <a href="{{ route('permohonan.create') }}" class="btn-primary">
      <i class="fa-solid fa-plus"></i>
      Permohonan Baru
    </a>
  </div>

  <div class="table-card">
    @if ($permohonans->count() > 0)
      <div class="table-responsive">
        <table class="data-table">
          <thead>
            <tr>
              <th>Bil</th>
              <th>Nama</th>
              <th>No. KP</th>
              <th>Emel</th>
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
                <td>{{ $permohonan->nama }}</td>
                <td>{{ $permohonan->nokp }}</td>
                <td>{{ $permohonan->emel }}</td>
                <td>{{ $permohonan->bahagian->nama_pendek }}</td>
                <td>
                  <span class="status-badge {{ $permohonan->status_color }}">
                    <i class="fa-solid fa-circle" style="font-size: 6px;"></i>
                    {{ $permohonan->status_label }}
                  </span>
                </td>
                <td>{{ $permohonan->created_at->format('d/m/Y') }}</td>
                <td>
                  <div class="action-buttons">
                    <a href="{{ route('permohonan.show', $permohonan) }}" class="btn-action" title="Lihat">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                    @if ($permohonan->status === 'dalam_semakan')
                      <a href="{{ route('permohonan.edit', $permohonan) }}" class="btn-action edit" title="Edit">
                        <i class="fa-solid fa-pen"></i>
                      </a>
                      <form action="{{ route('permohonan.destroy', $permohonan) }}" method="POST" style="display: inline;" onsubmit="return confirm('Adakah anda pasti untuk memadam permohonan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action delete" title="Padam">
                          <i class="fa-solid fa-trash"></i>
                        </button>
                      </form>
                    @endif
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @if ($permohonans->hasPages())
        <div class="pagination-wrapper">
          {{ $permohonans->links() }}
        </div>
      @endif
    @else
      <div class="empty-state">
        <div class="empty-state-icon">
          <i class="fa-solid fa-inbox"></i>
        </div>
        <h4>Tiada Permohonan</h4>
        <p>Anda belum membuat sebarang permohonan ID pengguna baru.</p>
        <a href="{{ route('permohonan.create') }}" class="btn-primary">
          <i class="fa-solid fa-plus"></i>
          Buat Permohonan
        </a>
      </div>
    @endif
  </div>
</div>
@endsection
