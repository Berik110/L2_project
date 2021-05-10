<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'count',
        'category_id',
        'subcategory_id',
        'user_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id'); // Many to One
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class, 'subcategory_id'); // Many to One
    }

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_products', 'product_id', 'order_id'); // Many to Many
    }

    public function images(){
        return $this->hasMany(ProductImage::class, 'product_id'); // One to Many
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id'); // Many to One
    }
}
