<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pangkalan extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'no_reg',
        'nama',
        'alamat',
        'no_hp',
        'kuota',
        'lat_lng'
    ];
    
}
