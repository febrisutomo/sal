<?php

namespace App\Models;

use App\Models\Sopir;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Armada extends Model
{
    use HasFactory;

    public function sopir()
    {
        return $this->belongsTo(Sopir::class);
    }
}
