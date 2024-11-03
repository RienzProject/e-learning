<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'presensi';
    protected $primarykey = 'id';
    protected $fillable = ['siswa_id','ruang_presensi_id', 'status_presensi'];

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    public function ruangPresensi() {
        return $this->belongsTo(RuangPresensi::class);
    }
}
