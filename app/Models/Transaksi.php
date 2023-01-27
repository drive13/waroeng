<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pembeli_id',
        'total_belanja',
        'total_bayar',
        'keterangan'
    ];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class);
    }

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
