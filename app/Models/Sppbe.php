<?php

namespace App\Models;

use App\Models\Sa;
use App\Models\KuotaHarian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sppbe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kode',
        'no_sh',
        'plant',
        'alamat',
        'no_hp'
    ];

    public function sas()
    {
        return $this->hasMany(Sa::class);
    }
 
    
    public function kuotaHarians()
    {
        return $this->hasManyThrough(KuotaHarian::class, Sa::class);
    }
}
