<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PangkalanPenyaluran extends Pivot
{
    use HasFactory;

    public function getBayarAttribute()
    {
        return $this->attributes['harga'] * $this->attributes['kuantitas'];
    }

}
