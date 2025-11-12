<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Kolom yang bisa diisi mass assignment
    protected $fillable = [
        'nama_nasabah',
        'nomor_kwitansi',
        'status_pembayaran',
        'keterangan',
        'tanggal_tagihan',
    ];

    // Kolom yang dilindungi
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'tanggal_tagihan' => 'datetime',
    ];
}
