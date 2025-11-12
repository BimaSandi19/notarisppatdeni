<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailsNotification extends Model
{
    use HasFactory;

    protected $table = 'emails_notification';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Kolom yang bisa diisi mass assignment
    protected $fillable = [
        'reminders_id',
        'emails_tujuan',
        'emails_kirim',
    ];

    // Kolom yang dilindungi
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    // Relasi dengan Reminder
    public function reminder()
    {
        return $this->belongsTo(Reminder::class, 'reminders_id');
    }
}
