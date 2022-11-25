<?php

namespace App\Models;

use App\Models\Sppbe;
use App\Models\KuotaHarian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'kitir_id',
        'no_sa',
        'sppbe_id',
        'tipe'
    ];

    public function kuotaHarians()
    {
        return $this->hasMany(KuotaHarian::class);
    }

    public function sppbe()
    {
        return $this->belongsTo(Sppbe::class);
    }

    public function getTotalAttribute()
    {
        return $this->kuotaHarians()->sum('kuota');
    }

    public function kitir()
    {
        $this->belongsTo(Kitir::class);
    }
}
