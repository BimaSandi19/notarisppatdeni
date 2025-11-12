<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Reminder extends Model
{
    use HasFactory;

    protected $table = 'reminders';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    // Kolom yang bisa diisi mass assignment
    protected $fillable = [
        'nama_nasabah',
        'nomor_kwitansi',
        'nominal_tagihan',
        'status_pembayaran',
        'keterangan',
        'tanggal_tagihan',
        'user_id',
    ];

    // Kolom yang dilindungi
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reminder) {
            if (Auth::check()) {
                $reminder->user_id = Auth::id();
                Log::info('User ID set to: ' . $reminder->user_id);
            } else {
                Log::warning('User not logged in.');
            }
        });
    }
}
