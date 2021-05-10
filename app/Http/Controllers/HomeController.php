<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except('index', 'addAdvPage', 'storeAdd', 'addProductByUser');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $user = Auth::user();
        return view('home', compact('categories', 'user'));
    }

    public function addAdvPage()
    {
        $user = Auth::user();
        $categories = Category::all();
//        $categories = Category::where('parent_id',0)->get();
        $subcategories = Subcategory::all();
        return view('addadvert', compact('user', 'categories', 'subcategories'));
    }

    public function addProductByUser(AddProductRequest $request){

        $product = Product::create($request->all());

        $file = $request->file('productImage');
        $path = 'images/'.$file->getClientOriginalName();
        $file->move('images/', $file->getClientOriginalName());

        ProductImage::create(['url'=>$path, 'product_id'=>$product->id]);
        return redirect('/advertpage?succes=1');
    }



}
