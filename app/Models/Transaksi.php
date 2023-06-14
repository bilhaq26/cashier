<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $fillable = [
        'no_transaksi',
        'tgl_transaksi',
        'diskon',
        'id_paket',
        'total_harga',
        'bayar',
        'kembalian',
        'status',
    ];

    public static function generateCode($code = null)
    {
        $baseCode = 'SKG-';
        $code = $baseCode.sprintf('%04d', 1);

        // tambah kode terakhir
        $lastCode = self::where('no_transaksi', 'like', '%SKG-%')->orderBy('no_transaksi', 'desc')->first();
        if($lastCode){
            $lastCode = substr($lastCode->no_transaksi, -4);
            $code = $baseCode.sprintf('%04d', (int)$lastCode + 1);
        }
        return $code;

    }

    public static function _isCodeExists($code)
    {
        $data = self::where('no_transaksi', $code)->first();
        if($data){
            return true;
        }
        return false;

        // $check = self::where('no_transaksi', 'like', '%TRX-'.$code.'%')->exists();
        // if($check){
        //     $lastCode = substr($code, -4);
        //     $code = sprintf('%04d', (int)$lastCode + 1);
        // }
        // return $code;
    }

    public function diskon()
    {
        return $this->belongsTo(Diskon::class);
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'no_transaksi', 'no_transaksi');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id');
    }

}
