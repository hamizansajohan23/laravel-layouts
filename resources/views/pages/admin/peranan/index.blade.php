@extends('layouts.app')

@section('title', 'Senarai Peranan')
@section('header_title', 'Senarai Peranan')
@section('header_subtitle', 'Pengurusan peranan dan kebenaran sistem')

@push('styles')
<style>
  .peranan-page {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  .page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
  }

  .page-header-info h2 {
    font-size: 24px;
    font-weight: 700;
    color: var(--ink);
    margin: 0 0 4px;
  }

  .page-header-info p {
    font-size: 14px;
    color: var(--muted);
    margin: 0;
  }

  .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    font-size: 14px;
    font-weight: 600;
    font-family: inherit;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    border: none;
  }

  .btn-primary {
    background: linear-gradient(135deg, var(--accent), var(--accent-2));
    color: #fff;
    box-shadow: 0 4px 15px rgba(59, 87, 244, 0.3);
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(59, 87, 244, 0.4);
  }

  .btn-secondary {
    background: var(--panel);
    border: 1px solid var(--border);
    color: var(--ink);
  }

  .btn-secondary:hover {
    background: var(--bg);
    border-color: var(--accent);
  }

  .btn-sm {
    padding: 8px 14px;
    font-size: 13px;
  }

  .btn-danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: #fff;
  }

  .btn-danger:hover {
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
  }

  /* Stats Cards */
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
  }

  @media (max-width: 900px) {
    .stats-grid {
      grid-template-columns: 1fr;
    }
  }

  .stat-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 24px;
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    gap: 20px;
    position: relative;
    overflow: hidden;
  }

  .stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    border-radius: 4px 0 0 4px;
  }

  .stat-card.primary::before {
    background: linear-gradient(180deg, var(--accent), var(--accent-2));
  }

  .stat-card.info::before {
    background: linear-gradient(180deg, #3b82f6, #2563eb);
  }

  .stat-card.success::before {
    background: linear-gradient(180deg, #27c2a4, #10b981);
  }

  .stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
  }

  .stat-icon.primary {
    background: linear-gradient(135deg, rgba(59, 87, 244, 0.15), rgba(39, 194, 164, 0.1));
    color: var(--accent);
  }

  .stat-icon.info {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(37, 99, 235, 0.1));
    color: #3b82f6;
  }

  .stat-icon.success {
    background: linear-gradient(135deg, rgba(39, 194, 164, 0.15), rgba(16, 185, 129, 0.1));
    color: #27c2a4;
  }

  .stat-info h4 {
    font-size: 28px;
    font-weight: 800;
    color: var(--ink);
    margin: 0 0 4px;
  }

  .stat-info p {
    font-size: 13px;
    color: var(--muted);
    margin: 0;
  }

  /* Table Card */
  .table-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: 16px;
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  .table-card-header {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .table-card-header h3 {
    font-size: 16px;
    font-weight: 600;
    color: var(--ink);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .table-card-header h3 i {
    color: var(--accent);
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
    padding: 16px 20px;
    text-align: left;
    border-bottom: 1px solid var(--border);
  }

  .data-table th {
    background: linear-gradient(180deg, var(--bg), var(--panel));
    font-size: 11px;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.8px;
  }

  .data-table td {
    font-size: 14px;
    color: var(--ink);
    vertical-align: middle;
  }

  .data-table tbody tr {
    transition: all 0.2s ease;
  }

  .data-table tbody tr:hover {
    background: linear-gradient(90deg, rgba(59, 87, 244, 0.03), transparent);
  }

  .data-table tbody tr:last-child td {
    border-bottom: none;
  }

  /* Role Info */
  .role-info {
    display: flex;
    align-items: center;
    gap: 14px;
  }

  .role-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--accent), var(--accent-2));
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 18px;
    box-shadow: 0 4px 12px rgba(59, 87, 244, 0.25);
  }

  .role-details {
    display: flex;
    flex-direction: column;
    gap: 3px;
  }

  .role-name {
    font-weight: 600;
    color: var(--ink);
    font-size: 14px;
  }

  .role-code {
    font-size: 12px;
    color: var(--muted);
    font-family: monospace;
  }

  /* Badges */
  .badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
  }

  .badge-primary {
    background: linear-gradient(135deg, rgba(59, 87, 244, 0.15), rgba(59, 87, 244, 0.05));
    color: var(--accent);
    border: 1px solid rgba(59, 87, 244, 0.2);
  }

  .badge-success {
    background: linear-gradient(135deg, rgba(39, 194, 164, 0.15), rgba(39, 194, 164, 0.05));
    color: #059669;
    border: 1px solid rgba(39, 194, 164, 0.2);
  }

  .badge-warning {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.05));
    color: #d97706;
    border: 1px solid rgba(245, 158, 11, 0.2);
  }

  .default-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, rgba(39, 194, 164, 0.15), rgba(39, 194, 164, 0.05));
    color: #059669;
    border: 1px solid rgba(39, 194, 164, 0.2);
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
  }

  /* Actions */
  .action-btns {
    display: flex;
    gap: 8px;
  }

  .action-btn {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
    text-decoration: none;
  }

  .action-btn.edit {
    background: rgba(59, 87, 244, 0.1);
    color: var(--accent);
  }

  .action-btn.edit:hover {
    background: var(--accent);
    color: #fff;
  }

  .action-btn.delete {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
  }

  .action-btn.delete:hover {
    background: #ef4444;
    color: #fff;
  }

  /* Alert */
  .alert {
    padding: 16px 20px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
  }

  .alert-success {
    background: rgba(39, 194, 164, 0.1);
    border: 1px solid rgba(39, 194, 164, 0.3);
    color: #059669;
  }

  .alert-danger {
    background: rgba(239, 68, 68, 0.1);
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
    cursor: pointer;
    color: inherit;
    opacity: 0.6;
    font-size: 16px;
  }

  .alert .btn-close:hover {
    opacity: 1;
  }

  /* Empty State */
  .empty-state {
    padding: 60px 20px;
    text-align: center;
    color: var(--muted);
  }

  .empty-state i {
    font-size: 48px;
    margin-bottom: 16px;
    opacity: 0.5;
  }

  .empty-state p {
    margin: 0;
    font-size: 14px;
  }

  /* Pagination */
  .pagination-wrapper {
    padding: 20px 24px;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: center;
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

  @if (session('error'))
    <div class="alert alert-danger">
      <i class="fa-solid fa-circle-exclamation"></i>
      <span>{{ session('error') }}</span>
      <button type="button" class="btn-close" onclick="this.parentElement.remove()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
  @endif

  <div class="peranan-page">
    <div class="page-header">
      <div class="page-header-info">
        <h2><i class="fa-solid fa-user-shield"></i> Senarai Peranan</h2>
        <p>Urus peranan dan kebenaran pengguna dalam sistem</p>
      </div>
      @if (auth()->user()->hasPermission('peranan.create'))
      <a href="{{ route('admin.peranan.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Tambah Peranan
      </a>
      @endif
    </div>

    <!-- Stats -->
    <div class="stats-grid">
      <div class="stat-card primary">
        <div class="stat-icon primary">
          <i class="fa-solid fa-user-shield"></i>
        </div>
        <div class="stat-info">
          <h4>{{ $roles->total() }}</h4>
          <p>Jumlah Peranan</p>
        </div>
      </div>
      <div class="stat-card info">
        <div class="stat-icon info">
          <i class="fa-solid fa-key"></i>
        </div>
        <div class="stat-info">
          <h4>{{ \App\Models\Permission::count() }}</h4>
          <p>Jumlah Kebenaran</p>
        </div>
      </div>
      <div class="stat-card success">
        <div class="stat-icon success">
          <i class="fa-solid fa-users"></i>
        </div>
        <div class="stat-info">
          <h4>{{ \App\Models\User::whereNotNull('role_id')->count() }}</h4>
          <p>Pengguna dengan Peranan</p>
        </div>
      </div>
    </div>

    <!-- Table -->
    <div class="table-card">
      <div class="table-card-header">
        <h3><i class="fa-solid fa-list"></i> Senarai Peranan</h3>
      </div>

      <div class="table-responsive">
        <table class="data-table">
          <thead>
            <tr>
              <th>Peranan</th>
              <th>Penerangan</th>
              <th>Kebenaran</th>
              <th>Pengguna</th>
              <th>Status</th>
              <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($roles as $role)
              <tr>
                <td>
                  <div class="role-info">
                    <div class="role-icon">
                      <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="role-details">
                      <div class="role-name">{{ $role->display_name }}</div>
                      <div class="role-code">{{ $role->name }}</div>
                    </div>
                  </div>
                </td>
                <td>{{ $role->description ?? '-' }}</td>
                <td>
                  <span class="badge badge-primary">
                    <i class="fa-solid fa-key"></i> {{ $role->permissions_count }}
                  </span>
                </td>
                <td>
                  <span class="badge badge-warning">
                    <i class="fa-solid fa-users"></i> {{ $role->users_count }}
                  </span>
                </td>
                <td>
                  @if ($role->is_default)
                    <span class="default-badge">
                      <i class="fa-solid fa-check"></i> Default
                    </span>
                  @else
                    <span style="color: var(--muted);">-</span>
                  @endif
                </td>
                <td>
                  <div class="action-btns">
                    @if (auth()->user()->hasPermission('peranan.edit'))
                    <a href="{{ route('admin.peranan.edit', $role) }}" class="action-btn edit" title="Edit">
                      <i class="fa-solid fa-pen"></i>
                    </a>
                    @endif
                    @if (auth()->user()->hasPermission('peranan.delete') && $role->users_count == 0)
                      <form action="{{ route('admin.peranan.destroy', $role) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Adakah anda pasti untuk memadam peranan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete" title="Padam">
                          <i class="fa-solid fa-trash"></i>
                        </button>
                      </form>
                    @endif
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6">
                  <div class="empty-state">
                    <i class="fa-solid fa-user-shield"></i>
                    <p>Tiada peranan dijumpai</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if ($roles->hasPages())
        <div class="pagination-wrapper">
          {{ $roles->links() }}
        </div>
      @endif
    </div>
  </div>
@endsection
