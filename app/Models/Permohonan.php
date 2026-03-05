<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permohonan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'nokp',
        'emel',
        'bahagian_id',
        'pengguna_id',
        'status',
        'catatan',
        'tarikh_keputusan',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tarikh_keputusan' => 'datetime',
        ];
    }

    /**
     * Get the bahagian for this permohonan.
     */
    public function bahagian(): BelongsTo
    {
        return $this->belongsTo(Bahagian::class);
    }

    /**
     * Get the user who submitted this permohonan.
     */
    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengguna_id');
    }

    /**
     * Get the status label in Malay.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'dalam_semakan' => 'Dalam Semakan',
            'diluluskan' => 'Diluluskan',
            'ditolak' => 'Ditolak',
            default => $this->status,
        };
    }

    /**
     * Get the status badge color.
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'dalam_semakan' => 'warning',
            'diluluskan' => 'success',
            'ditolak' => 'danger',
            default => 'secondary',
        };
    }
}
