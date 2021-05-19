<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function profilePage(){
        $user = Auth::user();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $products = Product::all();

//        $userId = Auth::user()->id;
//        $orders = DB::table('orders')
//            ->join('products', 'orders.product_id', '=', 'products.id')
//            ->where('orders.user_id', $userId)
//            ->get();

        return view('profile_page', compact('user', 'categories', 'subcategories', 'products'));
    }
}
