<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengumpulanTugas extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengumpulan_tugas';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'file_jawaban',
        'nilai',
        'tanggal_dikumpul',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_dikumpul' => 'datetime',
            'nilai' => 'integer',
        ];
    }

    // ==================== RELATIONSHIPS ====================

    /**
     * Get the tugas that this submission belongs to.
     */
    public function tugas(): BelongsTo
    {
        return $this->belongsTo(Tugas::class);
    }

    /**
     * Get the siswa who submitted this.
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
