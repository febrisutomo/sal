<?php

namespace App\Models;

use App\Models\Truk;
use App\Models\Sopir;
use App\Models\Kernet;
use App\Models\Pangkalan;
use App\Models\PangkalanPenyaluran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penyaluran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengambilan_id',
        'tanggal',
        'truk_id',
        'sopir_id',
        'kernet_id',
    ];

    public function pengambilan()
    {
        return $this->belongsTo(Pengambilan::class);
    }

    public function pangkalans()
    {
        return $this->belongsToMany(Pangkalan::class, 'pangkalan_penyalurans')
            ->using(PangkalanPenyaluran::class)
            ->withTimestamps()
            ->withPivot('harga', 'kuantitas')
            ->withTrashed();
    }

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

    public function getTotalAttribute()
    {
        return $this->pangkalans->sum('pivot.kuantitas');
    }

    public function getTotalBayarAttribute()
    {
        return $this->pangkalans->sum('pivot.bayar');
    }
    
}
