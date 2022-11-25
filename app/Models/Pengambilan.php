<?php

namespace App\Models;

use App\Models\Sopir;
use App\Models\Truk;
use App\Models\Kernet;
use App\Models\Pangkalan;
use App\Models\Penukaran;
use App\Models\KuotaHarian;
use App\Models\PangkalanPenyaluran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function penyalurans()
    {
        return $this->belongsToMany(Pangkalan::class, 'pangkalan_penyalurans')
            ->using(PangkalanPenyaluran::class)
            ->withTimestamps()
            ->withPivot('harga', 'kuantitas')
            ->withTrashed();
    }

    public function penukarans()
    {
        return $this->hasMany(Penukaran::class);
    }


    public function totalPenyaluran(): Attribute
    {
        return new Attribute(
            get: fn () => $this->penyalurans->sum('pivot.kuantitas'),
        );
    }
}
