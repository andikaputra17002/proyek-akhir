<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendaftaran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'dokter_id',
        'jam_praktek_id',
        'tanggal_pendaftaran',
        'transaksi',
        'antrian',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function jam_praktek()
    {
        return $this->belongsTo(JamPraktek::class);
    }

}
