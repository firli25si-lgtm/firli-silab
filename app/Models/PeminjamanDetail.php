<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeminjamanDetail extends Model
{
    protected $fillable = [
        'peminjaman_id',
        'alat_id',
        'jumlah',
        'kondisi_sebelum',
        'kondisi_sesudah',
        'catatan',
    ];

    protected $casts = [
        'jumlah' => 'integer',
    ];

    public function peminjaman(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function alat(): BelongsTo
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }
}
