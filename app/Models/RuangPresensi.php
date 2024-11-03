<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangPresensi extends Model
{
    use HasFactory;
    protected $table = 'ruang_presensi';
    protected $primarykey = 'id';
    protected $fillable = ['kelas_semester_id', 'user_id', 'tanggal_presenesi'];

    public function presensi() {
        return $this->hasMany(Presensi::class);
    }

    public function kelasSemester() {
        return $this->belongsTo(KelasSemester::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
