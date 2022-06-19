<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HariPraktek extends Model
{
    use HasFactory;
    protected $fillable = [
        'hari_praktek',
        'dokter_id'
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'id') ;
    }

    public function jampraktek()
    {
        return $this->hasMany(JamPraktek::class, 'hari_praktek_id', 'id');
    }
}
