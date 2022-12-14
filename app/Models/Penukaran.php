<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penukaran extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'pengambilan_id',
        'no_seri',
        'rincian'
    ];

    protected $casts = [
        'rincian' => 'array',
    ];
}
