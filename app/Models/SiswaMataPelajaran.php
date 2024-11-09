<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaMataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'siswa_mata_pelajaran';
    protected $primaryKey = 'id';
    protected $fillable = ['siswa_id', 'mata_pelajaran_id', 'nilai_akhir'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function nilaiSiswa()
    {
        return $this->hasMany(NilaiSiswa::class);
    }

    public function capaianKompetensi()
    {
        return $this->hasOne(CapaianKompetensi::class);
    }
}

