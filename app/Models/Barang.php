<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'tipe_dagangan_id',
        'kode',
        'nama',
        'harga_modal',
        'harga_jual',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function tipe()
    {
        return $this->belongsTo(TipeDagangan::class);
    }
}
