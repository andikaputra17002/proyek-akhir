<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'id');
    }

    public function jam_praktek()
    {
        return $this->hasOne(JamPraktek::class, 'id', 'jam_praktek_id');
    }
}
