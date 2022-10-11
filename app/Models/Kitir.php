<?php

namespace App\Models;

use App\Models\Sa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kitir extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'no_sa',
        'kuota',
        'sisa_kuota',
        'jenis',
    ];

  

    public function sa()
    {
        return $this->belongsTo(Sa::class, 'no_sa');
    }

    // public function getTanggalAttribute()
    // {
    //     return date('d/m/Y', strtotime($this->attributes['tanggal']));
    // }
}
