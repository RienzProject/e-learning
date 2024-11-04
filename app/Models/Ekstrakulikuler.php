<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
    use HasFactory;
    protected $table = 'ekstrakulikuler';
    protected $primarykey = 'id';
    protected $fillable = ['nama','hari','jam'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
