<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    // Kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'nama',
        'username',
        'password',
        'terakhir_login',
    ];

    // Kolom penting yang tidak boleh disentuh mass-assignment
    protected $guarded = [
        'id',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'terakhir_login' => 'datetime',
    ];

    /**
     * Send the password reset notification dengan custom template
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
