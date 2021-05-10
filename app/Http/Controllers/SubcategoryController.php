<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    const PATH = 'admin.subcategories.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::all();
        $categories = Category::all();
        return view(self::PATH . 'index', compact('subcategories', 'categories'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'category_id'=>'required'
        ]);
        Subcategory::create($request->all());
        return redirect('/admin/subcategory');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcategory = Subcategory::find($id);
        $categories = Category::all();
        return view('admin.subcategories.show', compact('subcategory', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'name'=>'required|string',
            'category_id'=>'required'
        ]);

        $subcategory = Subcategory::find($request->get('id'));
        $subcategory->name = $request->get('name');
        $subcategory->category_id = $request->get('category_id');
        $subcategory->save();
        return redirect('/admin/subcategory');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subcategory::destroy($id);
        return redirect('/admin/subcategory');
    }

    public function search(Request $request){
        $key = $request->get('key');
        $subcategories = Subcategory::where('name', 'like', '%'.$key.'%')->get();
//        $subcategories = Subcategory::where('name', 'like', '%'.$key.'%')
//            ->orWhere('price',)
//            ->orWhere('price',)
//            ->get();
        $categories = Category::all();
        return view('subcategories.by_categories', compact('subcategories', 'categories'));
    }
}
