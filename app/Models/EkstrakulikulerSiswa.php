<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EkstrakulikulerSiswa extends Model
{
    use HasFactory;
    protected $table = 'ekstrakulikuler_siswa';
    protected $primarykey = 'id';
    protected $fillable = ['ekstrakulikuler_id', 'siswa_id', 'predikat', 'keterangan'];

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function ekstrakulikuler() {
        return $this->belongsTo(Ekstrakulikuler::class, 'ekstrakulikuler_id');
    }
}
