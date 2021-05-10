<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    const PATH = 'admin.products.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $products = Product::all();
        $subcategories = Subcategory::all();
        $categories = Category::all();
        return view(self::PATH . 'index', compact('user', 'products', 'subcategories', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProductRequest $request)
    {
//        $request->validate([
//            'name'=>'required|string|max:255',
//            'description'=>'required',
//            'price'=>'required',
//            'count'=>'required',
//            'category_id'=>'required'
//        ]);
        $product = Product::create($request->all());

        $file = $request->file('productImage');
        $path = 'images/' . $file->getClientOriginalName();
        $file->move('images/', $file->getClientOriginalName());

        ProductImage::create([
            'url' => $path,
            'product_id' => $product->id
        ]);

        return redirect('/admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
//        $subcategory = Subcategory::find($request->get('subcategory_id'));
        $subcategories = Subcategory::all();
        $categories = Category::all();
        return view('admin.products.show', compact('product', 'subcategories', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(AddProductRequest $request)
    {
        /* 1 вариант лучше когда много полей */
//        Product::where('id', $request->id)->update($request->except('id', '_method', '_token'));
        /* 2 вариант */
        $product = Product::find($request->get('id'));
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
        $product->count = $request->get('count');
        $product->subcategory_id = $request->get('subcategory_id');
        $product->save();
        return redirect('/admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('/admin/product');
    }

    public function subcategoriesByCategory(Request $request)
    {
        $subcategories = Subcategory::where('category_id', $request->get('category_id'))->paginate(10);
//        $items = Item::where('category_id', $request->get('category_id'))->simplePaginate(6);
//        $items = Item::where('category_id', $request->get('category_id'))->get();
        $categories = Category::all();
        $products = Product::all();
        $user = Auth::user();
        $category = Category::find($request->get('category_id'));
        $subcategory = Subcategory::where('id', $request->get('subcategory_id'));

        return view('subcategories.by_categories', compact('user', 'subcategories', 'categories', 'products', 'category', 'subcategory'));
    }

    public function productsBySubcategory(Request $request)
    {
        $user = Auth::user();
        $products = Product::where('subcategory_id', $request->get('subcategory_id'))->paginate(8);
//        $items = Item::where('category_id', $request->get('category_id'))->simplePaginate(6);
//        $items = Item::where('category_id', $request->get('category_id'))->get();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $subcategory = Subcategory::find($request->get('subcategory_id'));
        $category = Category::find($request->get('category_id'));

//        return $category->name;
        return view('products.by_subcategories', compact('user', 'subcategories', 'categories', 'products', 'subcategory', 'category'));
    }

    public function getDetails(Request $request)
    {
        $product = Product::find($request->get('product_id'));
        $user = Auth::user();
//        return $product->name;
        return view('products.details', compact('product', 'user'));
    }

    public function changeDetails($id)
    {
//        $product = Product::find($request->get('id'));
        $product = Product::find($id);
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $user = Auth::user();
        return view('products.change_details', compact('user', 'product', 'categories', 'subcategories'));
    }


    public function updateProduct(AddProductRequest $request)
    {
        /*Новая версия для сохранения если много полей*/
        Product::where('id', $request->id)->update($request->except('id', '_method', '_token'));
        $id = $request->id;
        /* Сохраняем по старому */
//        $item = Item::find($request->get('id'));
//        $item->name = $request->get('name');
//        $item->description = $request->get('description');
//        $item->price = $request->get('price');
//        $item->quantity = $request->get('quantity');
//        $item->option = $request->get('option');
//        $item->category_id = $request->get('category_id');
//        $item->brand_id = $request->get('brand_id');
//        $item->save();
//        return redirect('/details/change?id='.$id);
//        return redirect('/details?product_id='.$id);
        return redirect('/details/change/' . $id);
    }

    public function deleteProduct(Request $request)
    {
        Product::destroy($request->get("product_id"));
        return redirect('/');
    }

    public function updateImg(Request $request)
    {
        $product = Product::find($request->get('id'));

        $file = $request->file('image');
        $path = 'images/' . $file->getClientOriginalName();
        $file->move('images/', $file->getClientOriginalName());

        ProductImage::where('product_id', $request->get('id'))->update(['url' => $path]);
//        ItemImage::create(['url'=>$path, 'item_id'=>$item->id]);
//        return redirect('/details/change?id='.$product->id);
        return redirect('/details/change/' . $product->id);
    }


    public function byCategory(Request $request, $id)
    {
        $subcategories = Subcategory::where('category_id', $id);
//        $items = Item::where('category_id', $request->get('category_id'))->simplePaginate(6);
//        $items = Item::where('category_id', $request->get('category_id'))->get();
        $categories = Category::all();
        $products = Product::all();
        $user = Auth::user();
        $category = Category::find($id);
//        $subcategory = Subcategory::where('id', $request->get('subcategory_id'));

        return view('subcategories.by_categories', compact('user', 'subcategories', 'categories', 'products', 'category'));
    }


    public function detailsProduct($id)
    {
        $subcategory = Subcategory::find($id);
        $user = Auth::user();
//        return $product->name;
        return view('products.details', compact('subcategory', 'user'));
    }

    public function data(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $products = Product::all();
        $users = User::all();

        return view('admin.index', compact('products', 'categories', 'subcategories', 'users'));
    }

//    public function search(Request $request)
//    {
//        $key = $request->get('key');
//        $subcategories = Subcategory::where('name', $key)->get();
//        $categories = Category::all();
//        $user = Auth::user();
//        $products = Product::all();
//        return view(self::PATH . 'index', compact('user', 'products', 'subcategory', 'categories'));
//    }

}

