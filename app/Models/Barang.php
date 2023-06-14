<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';
    protected $fillable = [
        'image',
        'nama_barang',
        'keterangan',
        'id_jenis',
        'harga',
        'stok',
    ];

    public function jenis()
    {
        return $this->belongsTo(JenisBarang::class, 'id_jenis', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_barang', 'id');
    }

    public function paketDetails()
    {
        return $this->hasMany(DetailPaket::class, 'id_barang', 'id');
    }
}
