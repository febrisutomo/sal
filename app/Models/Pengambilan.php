<?php

namespace App\Models;

use App\Models\Kitir;
use App\Models\Sopir;
use App\Models\Armada;
use App\Models\Pangkalan;
use App\Models\Penukaran;
use App\Models\PangkalanPenyaluran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengambilan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kitir_id',
        'armada_id',
        'sopir_id',
    ];

    public function armada()
    {
        return $this->belongsTo(Armada::class);
    }
    
    public function sopir()
    {
        return $this->belongsTo(Sopir::class);
    }

    public function kitir()
    {
        return $this->belongsTo(Kitir::class);
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
}
