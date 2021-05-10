<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    "prefix"=>"/admin",
    "as"=>'admin.',
    "middleware"=>"admin"
], function(){
    Route::get('/', [ProductController::class, 'data'])->name('index');

    //categories
    Route::prefix('category')->group(function (){
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::post('/', [CategoryController::class, 'store'])->name('categoryInsert');
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
        Route::get('/{id}', [CategoryController::class, 'show'])->name('categoryShow');
        Route::put('/', [CategoryController::class, 'update'])->name('categoryUpdate');
    });

    //subcategories
    Route::prefix('subcategory')->group(function (){
        Route::get('/', [SubcategoryController::class, 'index'])->name('subcategories');
        Route::post('/', [SubcategoryController::class, 'store'])->name('subcategoryInsert');
        Route::delete('/{id}', [SubcategoryController::class, 'destroy']);
        Route::get('/{id}', [SubcategoryController::class, 'show'])->name('subcategoryShow');
        Route::put('/', [SubcategoryController::class, 'update'])->name('subcategoryUpdate');
    });

    //products
    Route::prefix('product')->group(function (){
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::post('/', [ProductController::class, 'store'])->name('productInsert');
        Route::delete('/{id}', [ProductController::class, 'destroy']);
        Route::get('/{id}', [ProductController::class, 'show'])->name('productShow');
        Route::put('/', [ProductController::class, 'update'])->name('productUpdate');
    });
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\UserController::class, 'profilePage'])->name('profile');
Route::get('/advertpage', [App\Http\Controllers\HomeController::class, 'addAdvPage'])->name('adv');
Route::post('/', [App\Http\Controllers\HomeController::class, 'addProductByUser'])->name('toAddAdv');
Route::get('/subcategories', [App\Http\Controllers\ProductController::class, 'subcategoriesByCategory'])->name('subcategories');
Route::get('/products', [App\Http\Controllers\ProductController::class, 'productsBySubcategory'])->name('list_products');
Route::get('/details', [App\Http\Controllers\ProductController::class, 'getDetails'])->name('details');
Route::get('/details/change/{id}', [App\Http\Controllers\ProductController::class, 'changeDetails']);
Route::put('/details/product', [App\Http\Controllers\ProductController::class, 'updateProduct'])->name('updateProduct');
Route::delete('/details/product', [App\Http\Controllers\ProductController::class, 'deleteProduct'])->name('todeleteProduct');
Route::put('/details/change/img', [\App\Http\Controllers\ProductController::class, 'updateImg']);

/* breadcrumb */
Route::get('/subcategories/{id}', [App\Http\Controllers\ProductController::class, 'byCategory']);
Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'detailsProduct']);

/* корзина */
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cartIndex');
Route::post('/add-to-cart', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');

/* search */
Route::get('/product/search', [\App\Http\Controllers\SubcategoryController::class, 'search']);

//Route::post('/subcat', function (Request $request){
//    $parent_id = $request->cat_id;
//    $subcategories = \App\Models\Category::where('id', $parent_id)->with('subcategories')->get();
//    return response()->json([
//        'subcategories' => $subcategories
//    ]);
//})->name('subcat');

