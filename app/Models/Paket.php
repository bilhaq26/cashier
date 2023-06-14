<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'pakets';
    protected $fillable = [
        'nama_paket',
        'harga',
        'keterangan',
    ];

    public function detailPaket()
    {
        return $this->hasMany(DetailPaket::class, 'id_paket', 'id');
    }
}
