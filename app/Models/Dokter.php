<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_dokter',
        'photo_dokter',
        'bidang_dokter',
        'hari_praktek',
        'jam_praktek_pagi',
        'jam_praktek_malam',
        'code',
    ];

    // public function jam_praktek()
    // {
    //     return $this->hasMany(JamPraktek::class);
    // }

    public function pendaftaran(){
        return $this->hasMany(pendaftaran::class, 'dokter_id', 'id');
    }

}
