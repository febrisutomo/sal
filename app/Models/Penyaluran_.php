<?php

namespace App\Models;

use App\Models\Pangkalan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penyaluran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengambilan_id',
        'pangkalan_id',
        'harga',
        'kuantitas'
    ];

    public function pangkalans()
    {
        return $this->belongsTo(Pangkalan::class);
    }


}
