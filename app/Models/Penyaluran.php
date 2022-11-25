<?php

namespace App\Models;

use App\Models\Truk;
use App\Models\Pangkalan;
use App\Models\PangkalanPenyaluran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penyaluran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengambilan_id',
    ];

    public function pangkalans()
    {
        return $this->belongsToMany(Pangkalan::class, 'pangkalan_penyalurans')
            ->using(PangkalanPenyaluran::class)
            ->withTimestamps()
            ->withPivot('harga', 'jumlah')
            ->withTrashed();
    }

    public function truk()
    {
        return $this->belongsTo(Truk::class);
    }

    public function subtotal(): Attribute
    {
        return new Attribute(
            get: fn () => $this->pivot->kuantitas,
        );
    }
    
}
