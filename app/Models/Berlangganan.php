<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berlangganan extends Model
{
    use HasFactory;

    protected $table = 'berlangganan';
    protected $fillable = [
        'tipe',
        'harga',
        'benefit',
    ];
}
