<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bahagian extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_bahagian',
        'nama_pendek',
    ];

    /**
     * Get users belonging to this bahagian.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
