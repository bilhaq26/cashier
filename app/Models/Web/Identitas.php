<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identitas extends Model
{
    use HasFactory;

    protected $table = 'identitas';
    protected $fillable = [
        'logo',
        'favicon',
        'name',
        'email',
        'phone',
        'address',
        'facebook',
        'twitter',
        'instagram',
        'tiktok',
        'about',
    ];
}
