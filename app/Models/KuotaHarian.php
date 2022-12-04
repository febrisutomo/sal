<?php

namespace App\Models;

use App\Models\Sa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KuotaHarian extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'sa_id',
        'kuota',
    ];

    protected $appends = [
        'diambil'
    ];
  

    public function sa()
    {
        return $this->belongsTo(Sa::class);
    }

    public function pengambilans()
    {
        return $this->hasMany(Pengambilan::class);
    }

    public function getDiambilAttribute()
    {
        return $this->pengambilans->sum('jumlah');
    }



    // public function getTanggalAttribute()
    // {
    //     return date('d/m/Y', strtotime($this->attributes['tanggal']));
    // }
}
