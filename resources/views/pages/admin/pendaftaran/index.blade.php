@extends('layouts.app')

@section('title', 'Senarai Permohonan')
@section('header_title', 'Senarai Permohonan')
@section('header_subtitle', 'Urus permohonan pendaftaran pengguna baru')

@push('styles')
<style>
  .pendaftaran-page {
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

  /* Stats Cards */
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
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

  .stat-card.warning::before {
    background: linear-gradient(180deg, #fbbf24, #f59e0b);
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

  .stat-icon.warning {
    background: linear-gradient(135deg, rgba(251, 191, 36, 0.15), rgba(245, 158, 11, 0.1));
    color: #f59e0b;
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
    background: linear-gradient(135deg, var(--accent), var(--accent-2));
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

  .btn-action.approve {
    background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(34, 197, 94, 0.05));
    color: #22c55e;
    border: 1px solid rgba(34, 197, 94, 0.15);
  }

  .btn-action.approve:hover {
    background: #22c55e;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
  }

  .btn-action.reject {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.15);
  }

  .btn-action.reject:hover {
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
    margin: 0;
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

    .data-table th,
    .data-table td {
      padding: 12px 14px;
    }
  }
</style>
@endpush

@section('content')
<div class="pendaftaran-page">
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
      <h2>Senarai Permohonan</h2>
      <p>Urus permohonan pendaftaran pengguna baru yang memerlukan kelulusan</p>
    </div>
  </div>

  <div class="stats-grid">
    <div class="stat-card warning">
      <div class="stat-icon warning">
        <i class="fa-solid fa-user-clock"></i>
      </div>
      <div class="stat-info">
        <h4>{{ $pendaftarans->total() }}</h4>
        <p>Menunggu Kelulusan</p>
      </div>
    </div>
  </div>

  <div class="toolbar">
    <div class="search-box">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" id="searchInput" placeholder="Cari nama atau emel pemohon..." onkeyup="filterTable()">
    </div>
  </div>

  <div class="table-card">
    <div class="table-card-header">
      <h3>
        <i class="fa-solid fa-list"></i>
        Senarai Permohonan Pendaftaran
      </h3>
      <span class="count-badge">{{ $pendaftarans->total() }} permohonan</span>
    </div>

    @if ($pendaftarans->count() > 0)
      <div class="table-responsive">
        <table class="data-table" id="pendaftaranTable">
          <thead>
            <tr>
              <th style="width: 60px;">Bil</th>
              <th>Pemohon</th>
              <th>No. KP</th>
              <th>Bahagian</th>
              <th>Tarikh Mohon</th>
              <th style="text-align: center; width: 120px;">Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pendaftarans as $index => $user)
              <tr data-name="{{ strtolower($user->name) }}" data-email="{{ strtolower($user->email) }}">
                <td>
                  <strong>{{ $pendaftarans->firstItem() + $index }}</strong>
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
                  <div class="date-text">
                    {{ $user->created_at->format('d M Y') }}
                    <span class="time">{{ $user->created_at->format('h:i A') }}</span>
                  </div>
                </td>
                <td style="text-align: center;">
                  <div class="action-buttons">
                    <form action="{{ route('admin.pendaftaran.approve', $user) }}" method="POST" style="display: inline;" onsubmit="return confirm('Luluskan pendaftaran {{ $user->name }}?');">
                      @csrf
                      @method('PATCH')
                      <button type="submit" class="btn-action approve" title="Luluskan">
                        <i class="fa-solid fa-check"></i>
                      </button>
                    </form>
                    <form action="{{ route('admin.pendaftaran.reject', $user) }}" method="POST" style="display: inline;" onsubmit="return confirm('Tolak dan padam pendaftaran {{ $user->name }}?');">
                      @csrf
                      @method('PATCH')
                      <button type="submit" class="btn-action reject" title="Tolak">
                        <i class="fa-solid fa-xmark"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @if ($pendaftarans->hasPages())
        <div class="pagination-wrapper">
          {{ $pendaftarans->links() }}
        </div>
      @endif
    @else
      <div class="empty-state">
        <div class="empty-state-icon">
          <i class="fa-solid fa-inbox"></i>
        </div>
        <h4>Tiada Permohonan</h4>
        <p>Tiada permohonan pendaftaran yang memerlukan kelulusan buat masa ini.</p>
      </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
function filterTable() {
  const searchValue = document.getElementById('searchInput').value.toLowerCase();
  const rows = document.querySelectorAll('#pendaftaranTable tbody tr');

  rows.forEach(row => {
    const name = row.dataset.name || '';
    const email = row.dataset.email || '';

    const matchSearch = name.includes(searchValue) || email.includes(searchValue);

    if (matchSearch) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
}
</script>
@endpush
