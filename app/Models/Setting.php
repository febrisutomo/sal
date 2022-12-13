<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perusahaan',
        'alamat',
        'email',
        'telepon',
        'nama_manager',
        'ttd_manager',
        'harga',
        'stok_awal'
    ];
    public static function get()
    {
        return self::first();
    }

    public static function set($data)
    {
        return self::first()->update($data);
    }
}
