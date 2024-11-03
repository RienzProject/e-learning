<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataOrangTua extends Model
{
    use HasFactory;
    protected $table = 'data_orang_tua';
    protected $primarykey = 'id';
    protected $fillable = ['user_id', 'nama_ayah', 'nama_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu', 'jalan', 'kelurahan', 'kecamatan', 'kota', 'provinsi'];

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }
}
