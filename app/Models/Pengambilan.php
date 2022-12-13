<?php

namespace App\Models;

use App\Models\Truk;
use App\Models\Sopir;
use App\Models\Kernet;
use App\Models\Penukaran;
use App\Models\Penyaluran;
use App\Models\KuotaHarian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengambilan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kuota_harian_id',
        'truk_id',
        'sopir_id',
        'kernet_id',
    ];

    public function truk()
    {
        return $this->belongsTo(Truk::class);
    }
    
    public function sopir()
    {
        return $this->belongsTo(Sopir::class);
    }
    
    public function kernet()
    {
        return $this->belongsTo(Kernet::class);
    }

    public function kuotaHarian()
    {
        return $this->belongsTo(KuotaHarian::class);
    }

    public function penyaluran()
    {
        return $this->hasOne(Penyaluran::class);
    }

    public function penukarans()
    {
        return $this->hasMany(Penukaran::class);
    }

    public function getTotalPenukaranAttribute()
    {
        return $this->penukarans->count();
    }

    public function getTotalPenyaluranAttribute()
    {
        return $this->penyaluran->total;
    }

    public function scopeFilter($query, $filter)
    {
        return $query->when($filter['no_sa'] ?? false, function ($query, $no_sa) {
            $query->whereRelation('kuotaHarian.sa', 'no_sa', $no_sa);
        })->when($filter['tanggal'] ?? false, function ($query, $tanggal) {
            $query->whereRelation('kuotaHarian', 'tanggal', $tanggal);
        })->when($filter['start'] ?? false, function ($query, $tanggal) {
            $query->whereRelation('kuotaHarian', 'tanggal', '>=', $tanggal);
        })->when($filter['end'] ?? false, function ($query, $tanggal) {
            $query->whereRelation('kuotaHarian', 'tanggal', '<=', $tanggal);
        });

    }

    
}
