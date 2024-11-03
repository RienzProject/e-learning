<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianKompetensi extends Model
{
    use HasFactory;
    protected $table = 'capaian_kompetensi';
    protected $primarykey = 'id';
    protected $fillable = ['nilai_mata_pelajaran_id','catatan'];

    public function nilaiMataPelajaran() {
        return $this->belongsTo(NilaiMataPelajaran::class);
    }
}
