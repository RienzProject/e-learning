<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapor extends Model
{
    use HasFactory;
    protected $table = 'rapor';
    protected $primarykey = 'id';
    protected $fillable = ['siswa_id', 'kelas_semester_id', 'status_rapor', 'status_siswa', 'url_rapor'];

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    public function kelasSemester() {
        return $this->belongsTo(KelasSemester::class);
    }
}


