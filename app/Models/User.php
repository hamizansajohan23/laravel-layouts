<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nokp',
        'email',
        'password',
        'role',
        'role_id',
        'status',
        'bahagian_id',
        'email_verified_at',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the bahagian that the user belongs to.
     */
    public function bahagian(): BelongsTo
    {
        return $this->belongsTo(Bahagian::class);
    }

    /**
     * Get the role model that the user belongs to.
     */
    public function roleModel(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Check if user has a specific permission.
     */
    public function hasPermission(string $permission): bool
    {
        // Super admin (legacy) has all permissions
        if (strtolower($this->role) === 'admin' && $this->role_id === null) {
            return true;
        }

        // Check via role model
        if ($this->roleModel) {
            return $this->roleModel->hasPermission($permission);
        }

        return false;
    }

    /**
     * Check if user has any of the given permissions.
     */
    public function hasAnyPermission(array $permissions): bool
    {
        // Super admin (legacy) has all permissions
        if (strtolower($this->role) === 'admin' && $this->role_id === null) {
            return true;
        }

        // Check via role model
        if ($this->roleModel) {
            return $this->roleModel->hasAnyPermission($permissions);
        }

        return false;
    }

    /**
     * Get the user's role display name.
     */
    public function getRoleDisplayNameAttribute(): string
    {
        if ($this->roleModel) {
            return $this->roleModel->display_name;
        }

        return ucfirst($this->role ?? 'Pengguna');
    }

    /**
     * Get the user's first name.
     */
    public function getFirstNameAttribute(): string
    {
        return explode(' ', $this->name)[0];
    }

    /**
     * Get the status label.
     * - baru + email_verified_at = null → Menunggu (pending approval)
     * - baru + email_verified_at set → Baru (new staff, approved)
     * - aktif → Aktif
     * - tidak_aktif → Tidak Aktif
     */
    public function getStatusLabelAttribute(): string
    {
        if ($this->status === 'baru') {
            return $this->email_verified_at === null ? 'Menunggu' : 'Baru';
        }

        return match ($this->status) {
            'aktif' => 'Aktif',
            'tidak_aktif' => 'Tidak Aktif',
            default => 'Aktif',
        };
    }

    /**
     * Get the status color class.
     */
    public function getStatusColorAttribute(): string
    {
        if ($this->status === 'baru') {
            return $this->email_verified_at === null ? 'warning' : 'info';
        }

        return match ($this->status) {
            'aktif' => 'success',
            'tidak_aktif' => 'danger',
            default => 'success',
        };
    }

    /**
     * Check if user is pending approval.
     */
    public function isPendingApproval(): bool
    {
        return $this->status === 'baru' && $this->email_verified_at === null;
    }

    /**
     * Check if user is approved (can login).
     */
    public function isApproved(): bool
    {
        return $this->email_verified_at !== null || $this->status === 'aktif';
    }

    /**
     * Check if user is the super admin (legacy admin without role_id or superadmin role).
     */
    public function isSuperAdmin(): bool
    {
        // Legacy super admin (backward compatibility)
        if (strtolower($this->role) === 'admin' && $this->role_id === null) {
            return true;
        }

        // Check if role model name is 'superadmin'
        if ($this->roleModel && strtolower($this->roleModel->name) === 'superadmin') {
            return true;
        }

        return false;
    }

    /**
     * Check if user has an admin-level role.
     */
    public function isAdminRole(): bool
    {
        // Legacy super admin
        if ($this->isSuperAdmin()) {
            return true;
        }

        // Check if role name contains 'admin'
        if ($this->roleModel && str_contains(strtolower($this->roleModel->name), 'admin')) {
            return true;
        }

        return strtolower($this->role) === 'admin';
    }

    /**
     * Check if this user can manage (edit/delete) another user.
     */
    public function canManageUser(User $target): bool
    {
        // Can't manage yourself through this method
        if ($this->id === $target->id) {
            return false;
        }

        // Super admin can manage everyone
        if ($this->isSuperAdmin()) {
            return true;
        }

        // If target is an admin-level user, check for pengguna.manage.admin permission
        if ($target->isAdminRole()) {
            return $this->hasPermission('pengguna.manage.admin');
        }

        // Otherwise, anyone with pengguna.edit permission can manage
        return $this->hasPermission('pengguna.edit');
    }
}
