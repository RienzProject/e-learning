<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $table = 'mata_pelajaran';
    protected $primarykey = 'id';
    protected $fillable = ['kelas_id', 'user_id', 'kode', 'nama', 'jenis'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }

    public function jadwalKelas() {
        return $this->hasMany(JadwalKelas::class);
    }

    public function uploadTugas() {
        return $this->hasMany(UploadTugas::class);
    }

    public function nilaiMataPelajaran() {
        return $this->hasMany(NilaiMataPelajaran::class);
    }

    public function siswaMataPelajaran() {
        return $this->belongsToMany(SiswaMataPelajaran::class, 'siswa_mata_pelajaran', 'mata_pelajaran_id', 'siswa_id');
    }

    public function siswa() {
        return $this->belongsToMany(Siswa::class);
    }

    public function kelasSemester()
    {
        return $this->belongsTo(KelasSemester::class, 'kelas_id');
    }

    public function guruKelas() {
        return $this->hasMany(GuruKelas::class);
    }
}
