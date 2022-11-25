<?php

namespace App\Models;

use App\Models\Sopir;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Truk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'merk',
        'kapasitas',
        'plat_nomor',
        'sopir_id',
        'kernet_id'
    ];
    
    public function sopir()
    {
        return $this->belongsTo(Sopir::class);
    }
    public function kernet()
    {
        return $this->belongsTo(kernet::class);
    }
}
