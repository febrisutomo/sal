<?php

namespace App\Models;

use App\Models\Sopir;
use App\Models\Armada;
use App\Models\Penyaluran;
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

    public function penyaluran()
    {
        return $this->hasOne(Penyaluran::class);
    }
}
