<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'payment_method',
        'discount',
        'total',
        'products',
        'status',
    ];
   // Cast the 'products' field to an array automatically
   protected $casts = [
    'products' => 'array',  // Automatically cast the JSON field to an array
];
}