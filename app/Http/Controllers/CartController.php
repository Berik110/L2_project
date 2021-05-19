<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('cart.index', compact('categories'));
    }

    public function addToCart(Request $request){
        $product = Product::where('id', $request->get('id'))->first();
        $user = Auth::user();

        \Cart::session($user);

        \Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => (int)$request->get('qty'),
            'attributes' => [
                'category_id'=> $product->category->id,
                'subcategory_id'=> $product->subcategory->id,
                'user_id'=>$user->id,
                'url'=>isset($product->images->first()['url'])?$product->images->first()['url'] : 'no_image.jpg'
            ]
        ));

        \Cart::getContent();

        return response()->json(\Cart::getContent());
    }
}
