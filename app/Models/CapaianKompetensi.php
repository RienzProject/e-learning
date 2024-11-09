<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianKompetensi extends Model
{
    use HasFactory;
    protected $table = 'capaian_kompetensi';
    protected $primarykey = 'id';
    protected $fillable = ['siswa_mata_pelajaran_id','catatan'];

    public function siswaMataPelajaran() {
        return $this->belongsTo(SiswaMataPelajaran::class);
    }
}
