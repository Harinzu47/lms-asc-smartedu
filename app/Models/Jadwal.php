<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jadwal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tutor_id',
        'mapel_id',
        'kelas_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'jam_mulai' => 'datetime:H:i',
            'jam_selesai' => 'datetime:H:i',
        ];
    }

    // ==================== RELATIONSHIPS ====================

    /**
     * Get the tutor for this jadwal.
     */
    public function tutor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    /**
     * Get the mata pelajaran for this jadwal.
     */
    public function mapel(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id');
    }

    /**
     * Get the kelas for this jadwal.
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    /**
     * Get the materis for this jadwal.
     */
    public function materis(): HasMany
    {
        return $this->hasMany(Materi::class);
    }

    /**
     * Get the tugases for this jadwal.
     */
    public function tugases(): HasMany
    {
        return $this->hasMany(Tugas::class);
    }

    /**
     * Get the presensis for this jadwal.
     */
    public function presensis(): HasMany
    {
        return $this->hasMany(Presensi::class);
    }
    /**
     * Get the siswas (students) for this jadwal.
     */
    public function siswas(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'jadwal_siswa', 'jadwal_id', 'user_id')
                    ->withTimestamps();
    }
}
