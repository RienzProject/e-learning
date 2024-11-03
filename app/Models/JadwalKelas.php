<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKelas extends Model
{
    use HasFactory;
    protected $table = 'jadwal_kelas';
    protected $primarykey = 'id';
    protected $fillable = ['mata_pelajaran_id', 'hari'];

    public function mataPelajaran() {
        return $this->belongsTo(MataPelajaran::class);
    }
}
