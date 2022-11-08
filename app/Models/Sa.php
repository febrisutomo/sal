<?php

namespace App\Models;

use App\Models\Kitir;
use App\Models\Sppbe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'no_sa',
        'sppbe_id',
        'bulan_tahun',
        'tipe'
    ];

    public function kitirs()
    {
        return $this->hasMany(Kitir::class);
    }

    public function sppbe()
    {
        return $this->belongsTo(Sppbe::class);
    }

    public function getTotalAttribute()
    {
        return $this->kitirs()->sum('kuota');
    }
}
