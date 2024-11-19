<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSemester extends Model
{
    use HasFactory;
    protected $table = 'kelas_semester';
    protected $primarykey = 'id';
    protected $fillable = ['kelas_id', 'semester_id', 'status'];

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function semester() {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function siswa() {
        return $this->hasMany(Siswa::class);
    }

    public function rapor() {
        return $this->hasMany(Rapor::class);
    }

    public function ruangPresensi() {
        return $this->hasMany(RuangPresensi::class);
    }

    public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class, 'kelas_id');
    }

    public function guruKelas() {
        return $this->hasMany(GuruKelas::class, 'kelas_id');
    }
}
