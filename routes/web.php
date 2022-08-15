<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CategoryContoller;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\frontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\frontend\wishlistController;

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

Route::get('/', [FrontendController::class, 'index']);
Route::get('category', [FrontendController::class, 'category']);
Route::get('view-category/{slug}', [FrontendController::class, 'viewcategory']);
Route::get('view-category/{cate_slug}/{prod_slug}', [FrontendController::class, 'productview']);

Auth::routes();

Route::post('add-to-cart', [CartController::class, 'addProduct']);
Route::post('delete-cart-item', [CartController::class, 'deleteproduct']);
Route::post('update_cart', [CartController::class, 'updatecart']);
Route::post('add-to-wishlist', [wishlistController::class, 'add']);
Route::post('delete-wishlist-item', [wishlistController::class, 'deleteproduct']);
Route::get('product-list', [frontendController::class, 'productlist']);
Route::post('searchproduct', [frontendController::class, 'searchproduct']);


Route::middleware(['auth'])->group(function () {
    Route::get('cart', [CartController::class, 'viewcart']);
    Route::get('checkout', [CheckoutController::class, 'index']);
    Route::post('place_order', [CheckoutController::class, 'place_order']);
    Route::get('my_orders', [UserController::class, 'index']);
    Route::get('view_order/{id}', [UserController::class, 'vieworder']);
    Route::get('wishlist', [wishlistController::class, 'index']);
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', 'Admin\frontendController@index');
    Route::get('categories', 'Admin\CategoryContoller@index');
    Route::get('add-category', 'Admin\CategoryContoller@add');
    Route::post('insert_category', 'Admin\CategoryContoller@insert');
    Route::get('edit-category/{id}', [CategoryContoller::class, 'edit']);
    Route::put('update-category/{id}', [CategoryContoller::class, 'update']);
    Route::get('delete-category/{id}', [CategoryContoller::class, 'destroy']);
    Route::get('products', [ProductController::class, 'index']);
    Route::get('add-products', [ProductController::class, 'add']);
    Route::post('insert-product', [ProductController::class, 'insert']);
    Route::get('edit-prod/{id}', [ProductController::class, 'edit']);
    Route::put('update-product/{id}', [ProductController::class, 'update']);
    Route::get('delete-product/{id}', [ProductController::class, 'destroy']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('admin/view_order/{id}', [OrderController::class, 'view']);
    Route::put('update_order/{id}', [OrderController::class, 'updateorder']);
    Route::get('order_history', [OrderController::class, 'orderhistory']);
});
