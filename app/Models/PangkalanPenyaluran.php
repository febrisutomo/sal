<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PangkalanPenyaluran extends Pivot
{
    use HasFactory;

    public function bayar(): Attribute
    {
        return new Attribute(
            get: fn () => $this->kuantitas * $this->harga,
        );
    }
}
