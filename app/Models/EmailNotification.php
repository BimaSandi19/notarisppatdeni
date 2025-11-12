<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model
{
    use HasFactory;

    protected $table = 'email_notification';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Kolom yang bisa diisi mass assignment
    protected $fillable = [
        'reminders_id',
        'email_tujuan',
        'email_kirim',
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
