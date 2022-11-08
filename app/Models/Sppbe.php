<?php

namespace App\Models;

use App\Models\Sa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sppbe extends Model
{
    use HasFactory;

    public function sas()
    {
        return $this->hasMany(Sa::class);
    }
}
