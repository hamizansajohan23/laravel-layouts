@extends('layouts.app')

@section('title', 'Senarai Pengguna')
@section('header_title', 'Senarai Pengguna')
@section('header_subtitle', 'Pengurusan pengguna sistem')

@push('styles')
<style>
  .pengguna-page {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  /* Page Header */
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
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    color: #fff;
    box-shadow: 0 4px 15px rgba(59, 87, 244, 0.3);
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(59, 87, 244, 0.4);
  }

  /* Stats Cards */
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
  }

  @media (max-width: 1200px) {
    .stats-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 600px) {
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
    transition: all 0.3s ease;
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
    background: linear-gradient(180deg, var(--accent), var(--accent2));
  }

  .stat-card.success::before {
    background: linear-gradient(180deg, #27c2a4, #10b981);
  }

  .stat-card.warning::before {
    background: linear-gradient(180deg, #fbbf24, #f59e0b);
  }

  .stat-card.danger::before {
    background: linear-gradient(180deg, #ef4444, #dc2626);
  }

  .stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
  }

  .stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
  }

  .stat-icon.primary {
    background: linear-gradient(135deg, rgba(59, 87, 244, 0.15), rgba(39, 194, 164, 0.1));
    color: var(--accent);
  }

  .stat-icon.success {
    background: linear-gradient(135deg, rgba(39, 194, 164, 0.15), rgba(16, 185, 129, 0.1));
    color: #27c2a4;
  }

  .stat-icon.warning {
    background: linear-gradient(135deg, rgba(251, 191, 36, 0.15), rgba(245, 158, 11, 0.1));
    color: #f59e0b;
  }

  .stat-icon.danger {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.1));
    color: #ef4444;
  }

  .stat-info {
    flex: 1;
  }

  .stat-info h4 {
    font-size: 28px;
    font-weight: 800;
    color: var(--ink);
    margin: 0 0 4px;
    line-height: 1;
  }

  .stat-info p {
    font-size: 13px;
    color: var(--muted);
    margin: 0;
    font-weight: 500;
  }

  /* Search & Filter Bar */
  .toolbar {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 20px;
    box-shadow: var(--shadow);
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    align-items: center;
  }

  .search-box {
    flex: 1;
    min-width: 250px;
    position: relative;
  }

  .search-box i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    font-size: 14px;
  }

  .search-box input {
    width: 100%;
    padding: 12px 16px 12px 44px;
    font-size: 14px;
    font-family: inherit;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: var(--bg);
    color: var(--ink);
    transition: all 0.2s;
  }

  .search-box input:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(59, 87, 244, 0.1);
    background: var(--panel);
  }

  .filter-select {
    min-width: 150px;
    padding: 12px 16px;
    font-size: 14px;
    font-family: inherit;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: var(--bg);
    color: var(--ink);
    cursor: pointer;
    transition: all 0.2s;
  }

  .filter-select:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(59, 87, 244, 0.1);
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

  .table-card-header .count-badge {
    background: var(--accent);
    color: #fff;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
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

  /* User Info */
  .user-info {
    display: flex;
    align-items: center;
    gap: 14px;
  }

  .user-avatar {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 700;
    font-size: 14px;
    box-shadow: 0 4px 12px rgba(59, 87, 244, 0.25);
    flex-shrink: 0;
  }

  .user-details {
    display: flex;
    flex-direction: column;
    gap: 3px;
  }

  .user-name {
    font-weight: 600;
    color: var(--ink);
    font-size: 14px;
  }

  .user-email {
    font-size: 12px;
    color: var(--muted);
  }

  /* Badges */
  .role-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    text-transform: capitalize;
  }

  .role-badge.admin {
    background: linear-gradient(135deg, rgba(59, 87, 244, 0.15), rgba(59, 87, 244, 0.05));
    color: var(--accent);
    border: 1px solid rgba(59, 87, 244, 0.2);
  }

  .role-badge.admin::before {
    content: '\f521';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    font-size: 10px;
  }

  .role-badge.pengguna {
    background: linear-gradient(135deg, rgba(39, 194, 164, 0.15), rgba(39, 194, 164, 0.05));
    color: #27c2a4;
    border: 1px solid rgba(39, 194, 164, 0.2);
  }

  .role-badge.pengguna::before {
    content: '\f007';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    font-size: 10px;
  }

  .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
  }

  .status-badge.success {
    background: linear-gradient(135deg, rgba(39, 194, 164, 0.15), rgba(39, 194, 164, 0.05));
    color: #10b981;
    border: 1px solid rgba(39, 194, 164, 0.2);
  }

  .status-badge.danger {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(239, 68, 68, 0.05));
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.2);
  }

  .status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    animation: pulse 2s infinite;
  }

  .status-badge.success .status-dot {
    background: #10b981;
  }

  .status-badge.danger .status-dot {
    background: #ef4444;
    animation: none;
  }

  @keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
  }

  /* Bahagian Column */
  .bahagian-text {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 12px;
    background: var(--bg);
    border-radius: 8px;
    font-size: 13px;
    color: var(--ink);
  }

  .bahagian-text i {
    color: var(--muted);
    font-size: 12px;
  }

  /* Action Buttons */
  .action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
  }

  .btn-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 14px;
  }

  .btn-action.edit {
    background: linear-gradient(135deg, rgba(59, 87, 244, 0.1), rgba(59, 87, 244, 0.05));
    color: var(--accent);
    border: 1px solid rgba(59, 87, 244, 0.15);
  }

  .btn-action.edit:hover {
    background: var(--accent);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 87, 244, 0.3);
  }

  .btn-action.delete {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.15);
  }

  .btn-action.delete:hover {
    background: #ef4444;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
  }

  /* Empty State */
  .empty-state {
    padding: 80px 20px;
    text-align: center;
  }

  .empty-state-icon {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--bg), var(--panel));
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    font-size: 40px;
    color: var(--muted);
    border: 2px dashed var(--border);
  }

  .empty-state h4 {
    font-size: 20px;
    font-weight: 700;
    color: var(--ink);
    margin: 0 0 8px;
  }

  .empty-state p {
    font-size: 14px;
    color: var(--muted);
    margin: 0 0 24px;
  }

  /* Pagination */
  .pagination-wrapper {
    padding: 20px 24px;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: center;
    background: linear-gradient(180deg, var(--bg), var(--panel));
  }

  /* Alert */
  .alert {
    padding: 16px 20px;
    border-radius: 12px;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 12px;
    animation: slideIn 0.3s ease;
  }

  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .alert-success {
    background: linear-gradient(135deg, rgba(39, 194, 164, 0.15), rgba(39, 194, 164, 0.05));
    border: 1px solid rgba(39, 194, 164, 0.3);
    color: #10b981;
  }

  .alert-danger {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(239, 68, 68, 0.05));
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #ef4444;
  }

  .alert i {
    font-size: 18px;
  }

  /* Date Column */
  .date-text {
    font-size: 13px;
    color: var(--muted);
  }

  .date-text .time {
    display: block;
    font-size: 11px;
    margin-top: 2px;
  }

  /* Mobile Responsive */
  @media (max-width: 768px) {
    .page-header {
      flex-direction: column;
      align-items: flex-start;
    }

    .toolbar {
      flex-direction: column;
    }

    .search-box {
      width: 100%;
    }

    .filter-select {
      width: 100%;
    }

    .data-table th,
    .data-table td {
      padding: 12px 14px;
    }
  }
</style>
@endpush

@section('content')
<div class="pengguna-page">
  @if (session('success'))
    <div class="alert alert-success">
      <i class="fa-solid fa-circle-check"></i>
      {{ session('success') }}
    </div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger">
      <i class="fa-solid fa-circle-exclamation"></i>
      {{ session('error') }}
    </div>
  @endif

  <div class="page-header">
    <div class="page-header-info">
      <h2>Pengurusan Pengguna</h2>
      <p>Urus semua pengguna dalam sistem</p>
    </div>
    <a href="{{ route('admin.pengguna.create') }}" class="btn btn-primary">
      <i class="fa-solid fa-user-plus"></i>
      Cipta Pengguna Baru
    </a>
  </div>

  <div class="stats-grid">
    <div class="stat-card primary">
      <div class="stat-icon primary">
        <i class="fa-solid fa-users"></i>
      </div>
      <div class="stat-info">
        <h4>{{ $users->total() }}</h4>
        <p>Jumlah Pengguna</p>
      </div>
    </div>
    <div class="stat-card success">
      <div class="stat-icon success">
        <i class="fa-solid fa-user-check"></i>
      </div>
      <div class="stat-info">
        <h4>{{ App\Models\User::where('status', 'aktif')->count() }}</h4>
        <p>Aktif</p>
      </div>
    </div>
    <div class="stat-card danger">
      <div class="stat-icon danger">
        <i class="fa-solid fa-user-xmark"></i>
      </div>
      <div class="stat-info">
        <h4>{{ App\Models\User::where('status', 'tidak_aktif')->count() }}</h4>
        <p>Tidak Aktif</p>
      </div>
    </div>
    <div class="stat-card warning">
      <div class="stat-icon warning">
        <i class="fa-solid fa-user-shield"></i>
      </div>
      <div class="stat-info">
        <h4>{{ App\Models\User::where('role', 'admin')->count() }}</h4>
        <p>Pentadbir</p>
      </div>
    </div>
  </div>

  <div class="toolbar">
    <div class="search-box">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" id="searchInput" placeholder="Cari nama atau emel pengguna..." onkeyup="filterTable()">
    </div>
    <select class="filter-select" id="roleFilter" onchange="filterTable()">
      <option value="">Semua Peranan</option>
      <option value="admin">Pentadbir</option>
      <option value="pengguna">Pengguna</option>
    </select>
    <select class="filter-select" id="statusFilter" onchange="filterTable()">
      <option value="">Semua Status</option>
      <option value="aktif">Aktif</option>
      <option value="tidak_aktif">Tidak Aktif</option>
    </select>
  </div>

  <div class="table-card">
    <div class="table-card-header">
      <h3>
        <i class="fa-solid fa-list"></i>
        Senarai Pengguna
      </h3>
      <span class="count-badge">{{ $users->total() }} pengguna</span>
    </div>

    @if ($users->count() > 0)
      <div class="table-responsive">
        <table class="data-table" id="userTable">
          <thead>
            <tr>
              <th style="width: 60px;">Bil</th>
              <th>Pengguna</th>
              <th>No. KP</th>
              <th>Bahagian</th>
              <th>Peranan</th>
              <th>Status</th>
              <th>Tarikh Daftar</th>
              <th style="text-align: center; width: 120px;">Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $index => $user)
              <tr data-name="{{ strtolower($user->name) }}" data-email="{{ strtolower($user->email) }}" data-role="{{ strtolower($user->role) }}" data-status="{{ $user->status }}">
                <td>
                  <strong>{{ $users->firstItem() + $index }}</strong>
                </td>
                <td>
                  <div class="user-info">
                    <div class="user-avatar">
                      {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div class="user-details">
                      <span class="user-name">{{ $user->name }}</span>
                      <span class="user-email">{{ $user->email }}</span>
                    </div>
                  </div>
                </td>
                <td>
                  @if ($user->nokp)
                    <span style="font-family: monospace;">{{ $user->nokp }}</span>
                  @else
                    <span style="color: var(--muted);">-</span>
                  @endif
                </td>
                <td>
                  @if ($user->bahagian)
                    <span class="bahagian-text">
                      <i class="fa-solid fa-building"></i>
                      {{ $user->bahagian->nama_pendek }}
                    </span>
                  @else
                    <span style="color: var(--muted);">-</span>
                  @endif
                </td>
                <td>
                  <span class="role-badge {{ strtolower($user->role) }}">
                    {{ ucfirst($user->role) }}
                  </span>
                </td>
                <td>
                  <span class="status-badge {{ $user->status_color }}">
                    <span class="status-dot"></span>
                    {{ $user->status_label }}
                  </span>
                </td>
                <td>
                  <div class="date-text">
                    {{ $user->created_at->format('d M Y') }}
                    <span class="time">{{ $user->created_at->format('h:i A') }}</span>
                  </div>
                </td>
                <td style="text-align: center;">
                  <div class="action-buttons">
                    <a href="{{ route('admin.pengguna.edit', $user) }}" class="btn-action edit" title="Kemaskini">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    @if ($user->id !== auth()->id())
                      <form action="{{ route('admin.pengguna.destroy', $user) }}" method="POST" style="display: inline;" onsubmit="return confirm('Adakah anda pasti mahu memadam pengguna {{ $user->name }}?');">
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
      @if ($users->hasPages())
        <div class="pagination-wrapper">
          {{ $users->links() }}
        </div>
      @endif
    @else
      <div class="empty-state">
        <div class="empty-state-icon">
          <i class="fa-solid fa-users"></i>
        </div>
        <h4>Tiada Pengguna</h4>
        <p>Belum ada pengguna dalam sistem. Cipta pengguna pertama anda.</p>
        <a href="{{ route('admin.pengguna.create') }}" class="btn btn-primary">
          <i class="fa-solid fa-user-plus"></i>
          Cipta Pengguna
        </a>
      </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
function filterTable() {
  const searchValue = document.getElementById('searchInput').value.toLowerCase();
  const roleFilter = document.getElementById('roleFilter').value.toLowerCase();
  const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
  const rows = document.querySelectorAll('#userTable tbody tr');

  rows.forEach(row => {
    const name = row.dataset.name || '';
    const email = row.dataset.email || '';
    const role = row.dataset.role || '';
    const status = row.dataset.status || '';

    const matchSearch = name.includes(searchValue) || email.includes(searchValue);
    const matchRole = !roleFilter || role === roleFilter;
    const matchStatus = !statusFilter || status === statusFilter;

    if (matchSearch && matchRole && matchStatus) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
}
</script>
@endpush
