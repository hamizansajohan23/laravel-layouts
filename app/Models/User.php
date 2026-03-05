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
        'status',
        'bahagian_id',
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
     * Get the user's first name.
     */
    public function getFirstNameAttribute(): string
    {
        return explode(' ', $this->name)[0];
    }

    /**
     * Get the status label.
     */
    public function getStatusLabelAttribute(): string
    {
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
        return match ($this->status) {
            'aktif' => 'success',
            'tidak_aktif' => 'danger',
            default => 'success',
        };
    }
}
