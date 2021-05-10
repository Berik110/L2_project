<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profilePage(){
        $user = Auth::user();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $products = Product::all();
        return view('profile_page', compact('user', 'categories', 'subcategories', 'products'));
    }
}
