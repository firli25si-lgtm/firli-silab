<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alat extends Model
{
    protected $fillable = [
        'kode_alat',
        'nama_alat',
        'kategori_id',
        'deskripsi',
        'stok',
        'stok_tersedia',
        'kondisi',
        'lokasi',
        'gambar',
    ];

    protected $casts = [
        'stok' => 'integer',
        'stok_tersedia' => 'integer',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function peminjamanDetails(): HasMany
    {
        return $this->hasMany(PeminjamanDetail::class, 'alat_id');
    }

    /**
     * Generate kode alat otomatis
     */
    public static function generateKodeAlat(int $kategoriId): string
    {
        $kategori = Kategori::find($kategoriId);
        $prefix = strtoupper(substr($kategori->nama_kategori, 0, 3));
        $count = self::where('kategori_id', $kategoriId)->count() + 1;
        return $prefix . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}
