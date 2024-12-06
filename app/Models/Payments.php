<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'order_id',
        'status',
        'name',
        'email',
        'tipe',
        'price',
        'checkout_link',
    ];
}