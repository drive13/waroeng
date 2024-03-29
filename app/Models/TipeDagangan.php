<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeDagangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipe',
        'keterangan',
    ];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
