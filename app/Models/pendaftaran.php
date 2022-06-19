<?php

namespace App\Models;

use Carbon\Carbon;
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
        'shiff',
        'tanggal_pendaftaran',
        'transaksi',
        'antrian',
        'keluhan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'id');
    }

    public function jam_praktek()
    {
        return $this->hasOne(JamPraktek::class, 'id', 'jam_praktek_id');
    }

    public function scopeNow($query)
    {
        if ((int)substr(Carbon::now()->toTimeString(), 0, 2) < 12) {
            return $query->with('dokter', 'jam_praktek')->select('dokter_id', 'antrian')->where('shiff', 'pagi')->groupBy('dokter_id')->get();
        }
        return $query->with('dokter', 'jam_praktek')->select('dokter_id', 'antrian')->where('shiff', 'malam')->groupBy('dokter_id')->get();
    }

}
