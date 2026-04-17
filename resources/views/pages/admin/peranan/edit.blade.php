@extends('layouts.app')

@section('title', 'Edit Peranan')
@section('header_title', 'Edit Peranan')
@section('header_subtitle', 'Kemaskini maklumat dan kebenaran peranan')

@push('styles')
<style>
  .form-page {
    max-width: 800px;
    margin: 0 auto;
  }

  .form-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: 16px;
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  .form-card-header {
    padding: 24px;
    border-bottom: 1px solid var(--border);
    background: linear-gradient(180deg, var(--bg), var(--panel));
  }

  .form-card-header h3 {
    font-size: 18px;
    font-weight: 600;
    color: var(--ink);
    margin: 0 0 4px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .form-card-header h3 i {
    color: var(--accent);
  }

  .form-card-header p {
    font-size: 13px;
    color: var(--muted);
    margin: 0;
  }

  .form-card-body {
    padding: 24px;
  }

  .form-group {
    margin-bottom: 24px;
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

  .form-input {
    width: 100%;
    padding: 14px 16px;
    font-size: 14px;
    font-family: inherit;
    border: 1px solid var(--border);
    border-radius: 12px;
    background: var(--panel);
    color: var(--ink);
    transition: all 0.2s ease;
    box-sizing: border-box;
  }

  .form-input:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(59, 87, 244, 0.1);
  }

  .form-input::placeholder {
    color: var(--muted);
  }

  .form-textarea {
    min-height: 100px;
    resize: vertical;
  }

  .form-hint {
    font-size: 12px;
    color: var(--muted);
    margin-top: 6px;
  }

  .form-error {
    font-size: 12px;
    color: #ef4444;
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .form-error i {
    font-size: 14px;
  }

  .input-error {
    border-color: #ef4444 !important;
  }

  /* Checkbox Group */
  .checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    border: 1px solid var(--border);
    border-radius: 12px;
    background: var(--panel);
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .checkbox-wrapper:hover {
    border-color: var(--accent);
    background: rgba(59, 87, 244, 0.03);
  }

  .checkbox-wrapper input[type="checkbox"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: var(--accent);
  }

  .checkbox-label {
    font-size: 14px;
    color: var(--ink);
  }

  /* Permission Groups */
  .permission-section {
    margin-bottom: 24px;
  }

  .permission-section:last-child {
    margin-bottom: 0;
  }

  .permission-group-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px;
    background: linear-gradient(135deg, rgba(59, 87, 244, 0.08), rgba(39, 194, 164, 0.04));
    border-radius: 12px;
    margin-bottom: 12px;
    border: 1px solid rgba(59, 87, 244, 0.15);
  }

  .permission-group-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--ink);
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .permission-group-title i {
    color: var(--accent);
    font-size: 16px;
  }

  .select-all-btn {
    font-size: 12px;
    color: var(--accent);
    background: rgba(59, 87, 244, 0.1);
    border: none;
    padding: 6px 12px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.2s ease;
  }

  .select-all-btn:hover {
    background: var(--accent);
    color: #fff;
  }

  .permission-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 10px;
  }

  .permission-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: var(--panel);
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .permission-item:hover {
    border-color: var(--accent);
    background: rgba(59, 87, 244, 0.03);
  }

  .permission-item.selected {
    border-color: var(--accent);
    background: rgba(59, 87, 244, 0.08);
  }

  .permission-item input[type="checkbox"] {
    width: 16px;
    height: 16px;
    cursor: pointer;
    accent-color: var(--accent);
    flex-shrink: 0;
  }

  .permission-item-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .permission-item-name {
    font-size: 13px;
    font-weight: 500;
    color: var(--ink);
  }

  .permission-item-code {
    font-size: 11px;
    color: var(--muted);
    font-family: monospace;
  }

  /* Form Actions */
  .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding: 24px;
    border-top: 1px solid var(--border);
    background: linear-gradient(180deg, var(--panel), var(--bg));
  }

  .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 24px;
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

  /* Alert */
  .alert {
    padding: 16px 20px;
    border-radius: 12px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 24px;
  }

  .alert-danger {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #dc2626;
  }

  .alert ul {
    margin: 0;
    padding-left: 20px;
  }

  .alert li {
    font-size: 13px;
    margin-bottom: 4px;
  }

  .alert li:last-child {
    margin-bottom: 0;
  }

  /* Role Info Badge */
  .role-info-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    background: linear-gradient(135deg, rgba(59, 87, 244, 0.1), rgba(39, 194, 164, 0.05));
    border: 1px solid rgba(59, 87, 244, 0.2);
    border-radius: 12px;
    margin-bottom: 20px;
  }

  .role-info-badge i {
    color: var(--accent);
    font-size: 18px;
  }

  .role-info-badge-text {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .role-info-badge-name {
    font-size: 14px;
    font-weight: 600;
    color: var(--ink);
  }

  .role-info-badge-users {
    font-size: 12px;
    color: var(--muted);
  }
</style>
@endpush

@section('content')
  <div class="form-page">
    @if ($errors->any())
      <div class="alert alert-danger">
        <i class="fa-solid fa-circle-exclamation"></i>
        <div>
          <strong>Sila betulkan ralat berikut:</strong>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    @endif

    <form action="{{ route('admin.peranan.update', $role) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-card">
        <div class="form-card-header">
          <h3><i class="fa-solid fa-user-shield"></i> Maklumat Peranan</h3>
          <p>Kemaskini maklumat peranan dan pilih kebenaran yang diperlukan</p>
        </div>

        <div class="form-card-body">
          <div class="role-info-badge">
            <i class="fa-solid fa-user-shield"></i>
            <div class="role-info-badge-text">
              <span class="role-info-badge-name">{{ $role->display_name }}</span>
              <span class="role-info-badge-users">{{ $role->users_count }} pengguna menggunakan peranan ini</span>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Nama Peranan <span class="required">*</span></label>
            <input type="text" name="name" class="form-input @error('name') input-error @enderror"
              value="{{ old('name', $role->name) }}" placeholder="cth: editor, moderator" required>
            <div class="form-hint">Gunakan huruf kecil tanpa ruang (guna underscore jika perlu)</div>
            @error('name')
              <div class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Nama Paparan <span class="required">*</span></label>
            <input type="text" name="display_name" class="form-input @error('display_name') input-error @enderror"
              value="{{ old('display_name', $role->display_name) }}" placeholder="cth: Editor, Moderator" required>
            <div class="form-hint">Nama yang akan dipaparkan kepada pengguna</div>
            @error('display_name')
              <div class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Penerangan</label>
            <textarea name="description" class="form-input form-textarea @error('description') input-error @enderror"
              placeholder="Penerangan ringkas tentang peranan ini">{{ old('description', $role->description) }}</textarea>
            @error('description')
              <div class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <div class="checkbox-wrapper">
              <input type="checkbox" name="is_default" id="is_default" value="1"
                {{ old('is_default', $role->is_default) ? 'checked' : '' }}>
              <label class="checkbox-label" for="is_default">Tetapkan sebagai peranan lalai untuk pengguna baharu</label>
            </div>
          </div>
        </div>
      </div>

      <div class="form-card" style="margin-top: 24px;">
        <div class="form-card-header">
          <h3><i class="fa-solid fa-key"></i> Kebenaran</h3>
          <p>Pilih kebenaran yang diberikan kepada peranan ini</p>
        </div>

        <div class="form-card-body">
          @php
            $groupedPermissions = $permissions->groupBy('group');
            $rolePermissionIds = old('permissions', $role->permissions->pluck('id')->toArray());
          @endphp

          @foreach ($groupedPermissions as $group => $groupPermissions)
            <div class="permission-section">
              <div class="permission-group-header">
                <div class="permission-group-title">
                  <i class="fa-solid fa-folder"></i>
                  {{ ucfirst($group) }}
                </div>
                <button type="button" class="select-all-btn" data-group="{{ $group }}">
                  Pilih Semua
                </button>
              </div>

              <div class="permission-grid">
                @foreach ($groupPermissions as $permission)
                  <label class="permission-item {{ in_array($permission->id, $rolePermissionIds) ? 'selected' : '' }}"
                    for="perm_{{ $permission->id }}">
                    <input type="checkbox" name="permissions[]" id="perm_{{ $permission->id }}"
                      value="{{ $permission->id }}" data-group="{{ $group }}"
                      {{ in_array($permission->id, $rolePermissionIds) ? 'checked' : '' }}>
                    <div class="permission-item-info">
                      <span class="permission-item-name">{{ $permission->display_name }}</span>
                      <span class="permission-item-code">{{ $permission->name }}</span>
                    </div>
                  </label>
                @endforeach
              </div>
            </div>
          @endforeach

          @if ($permissions->isEmpty())
            <div style="text-align: center; padding: 40px; color: var(--muted);">
              <i class="fa-solid fa-key" style="font-size: 32px; margin-bottom: 12px; opacity: 0.5;"></i>
              <p>Tiada kebenaran dijumpai. Sila cipta kebenaran terlebih dahulu.</p>
            </div>
          @endif
        </div>

        <div class="form-actions">
          <a href="{{ route('admin.peranan.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Kembali
          </a>
          <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-save"></i> Kemaskini Peranan
          </button>
        </div>
      </div>
    </form>
  </div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Select all buttons
    document.querySelectorAll('.select-all-btn').forEach(function(btn) {
      btn.addEventListener('click', function() {
        const group = this.dataset.group;
        const checkboxes = document.querySelectorAll('input[type="checkbox"][data-group="' + group + '"]');
        const allChecked = Array.from(checkboxes).every(cb => cb.checked);

        checkboxes.forEach(function(cb) {
          cb.checked = !allChecked;
          cb.closest('.permission-item').classList.toggle('selected', cb.checked);
        });

        this.textContent = allChecked ? 'Pilih Semua' : 'Nyahpilih Semua';
      });
    });

    // Toggle selected class on checkbox change
    document.querySelectorAll('.permission-item input[type="checkbox"]').forEach(function(cb) {
      cb.addEventListener('change', function() {
        this.closest('.permission-item').classList.toggle('selected', this.checked);
      });
    });
  });
</script>
@endpush
