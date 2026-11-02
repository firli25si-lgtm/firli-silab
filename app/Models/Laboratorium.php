<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laboratorium extends Model
{
    protected $fillable = [
        'kode_lab',
        'nama_lab',
        'kapasitas',
        'lokasi',
        'penanggung_jawab',
        'status',
        'deskripsi',
    ];

    /**
     * Relasi: satu lab punya banyak jadwal praktikum
     */
    public function jadwals(): HasMany
    {
        return $this->hasMany(JadwalPraktikum::class, 'laboratorium_id');
    }

    /**
     * Generate kode lab otomatis (LAB-001, LAB-002, ...)
     */
    public static function generateKodeLab(): string
    {
        $count = self::count() + 1;
        return 'LAB-' . str_pad($count, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Helper: badge warna berdasarkan status
     */
    public function statusBadgeClass(): string
    {
        return match ($this->status) {
            'aktif'       => 'badge bg-success',
            'maintenance' => 'badge bg-warning text-dark',
            'nonaktif'    => 'badge bg-secondary',
            default       => 'badge bg-light text-dark',
        };
    }
}
