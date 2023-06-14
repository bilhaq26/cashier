<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'datetime',
        'date',
        'ip_address',
        'url',
        'referal',
        'tipe',
        'visit',
        'country',
        'country_code',
        'browser',
        'device',
        'os',
    ];
}
