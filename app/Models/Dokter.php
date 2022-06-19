<?php

namespace App\Models;

use Carbon\Carbon;
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
        // 'hari_praktek_id',
        // 'jam_praktek_id',
        'code',
    ];

    public function pendaftaran(){
        if ((int)substr(Carbon::now()->toTimeString(), 0, 2) < 12) {
            return $this->hasMany(pendaftaran::class, 'dokter_id', 'id')->where('shiff', 'pagi')->limit(1)->oldest();
        }
        return $this->hasMany(pendaftaran::class, 'dokter_id', 'id')->where('shiff', 'malam')->limit(1)->oldest();
    }

    public function riwayat(){
        return $this->hasMany(Riwayat::class, 'dokter_id', 'id');
    }
    // public function jam_praktek(){
    //     return $this->hasMany(JamPraktek::class, 'jam_praktek_id', 'id');
    // }
    public function hari_praktek(){
        return $this->hasMany(HariPraktek::class, 'dokter_id', 'id');
    }
}
