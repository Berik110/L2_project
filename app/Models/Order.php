<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
//    public $timestamps = false;

    protected $fillable=[
        'product_id',
        'user_id',
        'status',
        'payment_method',
        'payment_status',
        'full_name',
        'phone_number',
        'address'
    ];
}
