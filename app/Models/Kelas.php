<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_kelas',
    ];

    // ==================== RELATIONSHIPS ====================

    /**
     * Get the siswa in this kelas.
     */
    public function siswas(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the jadwals for this kelas.
     */
    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
