@extends('layouts.app')

@section('title', 'Dashboard')
@section('header_title', 'Dashboard')
@section('header_subtitle', 'Ringkasan sistem anda')

@push('styles')
<style>
  .dashboard-page {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
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
    transition: all 0.2s ease;
  }

  .stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
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
    background: linear-gradient(135deg, rgba(59, 87, 244, 0.15), rgba(59, 87, 244, 0.05));
    color: var(--accent);
  }

  .stat-icon.success {
    background: linear-gradient(135deg, rgba(39, 194, 164, 0.15), rgba(39, 194, 164, 0.05));
    color: #27c2a4;
  }

  .stat-icon.warning {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.15), rgba(255, 193, 7, 0.05));
    color: #e6a700;
  }

  .stat-icon.danger {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(239, 68, 68, 0.05));
    color: #ef4444;
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
  }

  .charts-row {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 24px;
  }

  @media (max-width: 1200px) {
    .charts-row {
      grid-template-columns: 1fr;
    }
  }

  .chart-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  .chart-card-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .chart-card-header h4 {
    font-size: 15px;
    font-weight: 700;
    color: var(--ink);
    margin: 0;
  }

  .chart-card-body {
    padding: 20px;
  }

  .chart-container {
    position: relative;
    height: 300px;
  }

  .chart-container-pie {
    position: relative;
    height: 280px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .recent-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  .recent-card-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .recent-card-header h4 {
    font-size: 15px;
    font-weight: 700;
    color: var(--ink);
    margin: 0;
  }

  .recent-card-header a {
    font-size: 13px;
    color: var(--accent);
    text-decoration: none;
  }

  .recent-card-header a:hover {
    text-decoration: underline;
  }

  .recent-list {
    padding: 0;
    margin: 0;
    list-style: none;
  }

  .recent-item {
    padding: 14px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .recent-item:last-child {
    border-bottom: none;
  }

  .recent-item-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .recent-item-name {
    font-size: 14px;
    font-weight: 600;
    color: var(--ink);
  }

  .recent-item-detail {
    font-size: 12px;
    color: var(--muted);
  }

  .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
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

  .empty-recent {
    padding: 40px 20px;
    text-align: center;
    color: var(--muted);
    font-size: 14px;
  }

  .welcome-banner {
    background: linear-gradient(135deg, var(--accent), var(--accent-2));
    border-radius: var(--radius);
    padding: 24px 28px;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .welcome-banner h2 {
    font-size: 22px;
    font-weight: 700;
    margin: 0 0 8px;
  }

  .welcome-banner p {
    font-size: 14px;
    opacity: 0.9;
    margin: 0;
  }

  .welcome-banner-icon {
    font-size: 64px;
    opacity: 0.3;
  }

  @media (max-width: 768px) {
    .welcome-banner-icon {
      display: none;
    }
  }
</style>
@endpush

@section('content')
<div class="dashboard-page">
  <div class="welcome-banner">
    <div>
      <h2>Selamat Datang, {{ auth()->user()->first_name }}!</h2>
      <p>{{ $isAdmin ? 'Anda log masuk sebagai Pentadbir Sistem' : 'Selamat datang ke sistem' }}</p>
    </div>
    <div class="welcome-banner-icon">
      <i class="fa-solid fa-chart-line"></i>
    </div>
  </div>

  @if ($isAdmin)
    {{-- Admin Dashboard --}}
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon primary">
          <i class="fa-solid fa-users"></i>
        </div>
        <div class="stat-info">
          <h4>{{ $stats['jumlah_pengguna'] }}</h4>
          <p>Jumlah Pengguna</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon success">
          <i class="fa-solid fa-user-check"></i>
        </div>
        <div class="stat-info">
          <h4>{{ $stats['pengguna_aktif'] }}</h4>
          <p>Pengguna Aktif</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon danger">
          <i class="fa-solid fa-user-xmark"></i>
        </div>
        <div class="stat-info">
          <h4>{{ $stats['pengguna_tidak_aktif'] }}</h4>
          <p>Pengguna Tidak Aktif</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon warning">
          <i class="fa-solid fa-user-clock"></i>
        </div>
        <div class="stat-info">
          <h4>{{ $stats['permohonan_baru'] }}</h4>
          <p>Permohonan Pendaftaran</p>
        </div>
      </div>
    </div>

    <div class="chart-card">
      <div class="chart-card-header">
        <h4><i class="fa-solid fa-chart-area"></i> Statistik Pengguna Bulanan</h4>
      </div>
      <div class="chart-card-body">
        <div class="chart-container">
          <canvas id="lineChart"></canvas>
        </div>
      </div>
    </div>

  @else
    {{-- Dashboard Pengguna Biasa --}}
    <div class="recent-card">
      <div class="recent-card-header">
        <h4><i class="fa-solid fa-user"></i> Selamat Datang</h4>
      </div>
      <div class="empty-recent" style="padding: 40px 20px;">
        <i class="fa-solid fa-hand-wave" style="font-size: 48px; color: var(--accent);"></i>
        <p style="font-size: 16px; margin-top: 16px;">Selamat datang ke Sistem Pengurusan Pengguna</p>
        <p style="color: var(--muted); margin-top: 8px;">Anda log masuk sebagai {{ auth()->user()->name }}</p>
        <p style="color: var(--muted);">Bahagian: {{ auth()->user()->bahagian?->nama_bahagian ?? 'Tiada' }}</p>
      </div>
    </div>
  @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const primaryColor = '#3b57f4';

  @if ($isAdmin)
  // Line Chart - Statistik Pengguna Bulanan
  const lineCtx = document.getElementById('lineChart').getContext('2d');
  new Chart(lineCtx, {
    type: 'line',
    data: {
      labels: {!! json_encode($chartData['labels'] ?? []) !!},
      datasets: [
        {
          label: 'Pengguna Baru',
          data: {!! json_encode($chartData['pengguna'] ?? []) !!},
          borderColor: primaryColor,
          backgroundColor: 'rgba(59, 87, 244, 0.1)',
          fill: true,
          tension: 0.4,
          borderWidth: 2,
          pointBackgroundColor: primaryColor,
          pointRadius: 4,
          pointHoverRadius: 6
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            usePointStyle: true,
            padding: 20
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1
          },
          grid: {
            color: 'rgba(0, 0, 0, 0.05)'
          }
        },
        x: {
          grid: {
            display: false
          }
        }
      }
    }
  });
  @endif
});
</script>
@endpush
