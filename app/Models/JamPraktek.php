<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamPraktek extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift',
        'jam_praktek',
        'hari_praktek_id'
    ];
    protected $table = "jam_prakteks";

    public function hari_praktek()
    {
        return $this->belongsTo(HariPraktek::class, 'hari_praktek_id', 'id');
    }

    public function pendaftaran()
    {
        return $this->belongsTo(pendaftaran::class, 'jam_praktek_id', 'id');
    }

    public function riwayat()
    {
        return $this->belongsTo(Riwayat::class, 'jam_praktek_id', 'id');
    }

    // public function dokter()
    // {
    //     return $this->belongsTo(Dokter::class, 'dokter_id', 'id') ;
    // }
}
