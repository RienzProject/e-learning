<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    use HasFactory;
    protected $table = 'nilai_siswa';
    protected $primarykey = 'id';
    protected $fillable = ['siswa_mata_pelajaran_id', 'upload_tugas_id', 'nilai'];

    public function siswaMataPelajaran() {
        return $this->belongsTo(SiswaMataPelajaran::class);
    }

    public function uploadTugas() {
        return $this->belongsTo(UploadTugas::class);
    }

    public function capaianKompetensi() {
        return $this->hasMany(CapaianKompetensi::class);
    }
}
