<?php

namespace App\Models;

use App\Models\Armada;
use App\Models\Pangkalan;
use App\Models\PangkalanPenyaluran;
use Illuminate\Database\Eloquent\Model;
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

    public function armada()
    {
        return $this->belongsTo(Armada::class);
    }

    public function getTotalBayarAttribute()
    {
        return $this->bases->sum('pivot.bayar');
    }

    public function getTotalPenyaluranAttribute()
    {
        return $this->bases->sum('pivot.diserahkan');
    }
}
