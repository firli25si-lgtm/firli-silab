<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model ini hanya dipakai sebagai referensi relasi dari Laboratorium.
 * CRUD Jadwal Praktikum sepenuhnya menggunakan Query Builder (DB::table).
 */
class JadwalPraktikum extends Model
{
    protected $table = 'jadwal_praktikums';

    protected $fillable = [
        'laboratorium_id',
        'mata_kuliah',
        'dosen_pengampu',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kapasitas_peserta',
        'keterangan',
    ];

    /**
     * Relasi: jadwal milik satu laboratorium
     */
    public function laboratorium(): BelongsTo
    {
        return $this->belongsTo(Laboratorium::class, 'laboratorium_id');
    }
}
