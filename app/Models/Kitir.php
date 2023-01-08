<?php

namespace App\Models;

use App\Models\Sa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kitir extends Model
{
    use HasFactory;

    protected $fillable = ['bulan_tahun'];

    public function getRouteKeyName()
    {
        return 'bulan_tahun';
    }

    public function sas()
    {
        return $this->hasMany(Sa::class);
    }

    public function kuotaHarians()
    {
        return $this->hasManyThrough(KuotaHarian::class, Sa::class);
    }

    public function getTotalAttribute()
    {
        return $this->kuotaHarians->sum('kuota');
    }

    public function getHariKerjaAttribute()
    {
        return $this->kuotaHarians->groupBy('tanggal')->count();
    }



}
