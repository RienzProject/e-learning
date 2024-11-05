<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'NIP',
        'username',
        'password',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'agama',
        'gender',
        'foto',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function waliKelas() {
        return $this->hasOne(WaliKelas::class);
    }

    public function uploadTugas() {
        return $this->hasMany(UploadTugas::class);
    }

    public function mataPelajaran() {
        return $this->hasMany(MataPelajaran::class);
    }

    public function ruangPresensi() {
        return $this->hasMany(RuangPresensi::class);
    }
}
