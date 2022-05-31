<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamPraktek extends Model
{
    use HasFactory;

    protected $fillable = [
        'jam_praktek'
    ];
    protected $table = "jam_prakteks";
    // protected $guarded = [];
}
