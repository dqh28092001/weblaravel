<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginAndRegisterController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// FE
Route::get('/', [HomeController::class,'index']);
Route::get('/home', [HomeController::class,'index']);
Route::post('/search', [HomeController::class,'search']);

// Danh mục sản phẩm trang chủ
Route::get('/danh_muc_san_pham/{category_id}', [CategoryProduct::class,'show_category_home']);
Route::get('/thuong_hieu_san_pham/{brand_id}', [BrandProduct::class,'show_brand_home']);
Route::get('/detail_product/{product_id}', [ProductController::class,'detail_product']);

// BE
Route::get('/admin_login', [AdminController::class,'index']);
Route::get('/dashboard', [AdminController::class,'show_dashboard']);
Route::get('/logout', [AdminController::class,'logout']);
Route::post('/admin_dashboard', [AdminController::class,'dashboard']);

// BE Category Product
Route::get('/add_category_product', [CategoryProduct::class,'add_category_product']);
Route::get('/edit_category_product/{category_product_id}', [CategoryProduct::class,'edit_category_product']);
Route::get('/delete_category_product/{category_product_id}', [CategoryProduct::class,'delete_category_product']);

Route::get('/all_category_product', [CategoryProduct::class,'all_category_product']);

Route::get('/unactive_category_product/{category_product_id}', [CategoryProduct::class,'unactive_category_product']);
Route::get('/active_category_product/{category_product_id}', [CategoryProduct::class,'active_category_product']);

Route::post('/save_category_product', [CategoryProduct::class,'save_category_product']);
Route::post('/update_category_product/{category_product_id}', [CategoryProduct::class,'update_category_product']);

// BE Brand Product
Route::get('/add_brand_product', [BrandProduct::class,'add_brand_product']);
Route::get('/edit_brand_product/{brand_product_id}', [BrandProduct::class,'edit_brand_product']);
Route::get('/delete_brand_product/{brand_product_id}', [BrandProduct::class,'delete_brand_product']);

Route::get('/all_brand_product', [BrandProduct::class,'all_brand_product']);

Route::get('/unactive_brand_product/{brand_product_id}', [BrandProduct::class,'unactive_brand_product']);
Route::get('/active_brand_product/{brand_product_id}', [BrandProduct::class,'active_brand_product']);

Route::post('/save_brand_product', [BrandProduct::class,'save_brand_product']);
Route::post('/update_brand_product/{brand_product_id}', [BrandProduct::class,'update_brand_product']);


// BE Product
Route::get('/add_product', [ProductController::class,'add_product']);
Route::get('/edit_product/{product_id}', [ProductController::class,'edit_product']);
Route::get('/delete_product/{product_id}', [ProductController::class,'delete_product']);

Route::get('/all_product', [ProductController::class,'all_product']);

Route::get('/unactive_product/{product_id}', [ProductController::class,'unactive_product']);
Route::get('/active_product/{product_id}', [ProductController::class,'active_product']);

Route::post('/save_product', [ProductController::class,'save_product']);
Route::post('/update_product/{product_id}', [ProductController::class,'update_product']);


// add to cart
Route::post('/save_cart', [CartController::class,'save_cart']);
Route::get('/show_cart', [CartController::class,'show_cart']);
Route::get('/delete_to_cart/{rowId}', [CartController::class,'delete_to_cart']);
Route::post('/update_cart', [CartController::class,'update_cart']);

// Checkout
Route::get('/show_checkout', [CheckoutController::class,'show_checkout']);
Route::get('/login_checkout', [CheckoutController::class,'login_checkout']);
Route::get('/logout_checkout', [CheckoutController::class,'logout_checkout']);
Route::post('/login_add_customer', [CheckoutController::class,'login_add_customer']);
Route::post('/login_customer', [CheckoutController::class,'login_customer']);
Route::post('/oder_place', [CheckoutController::class,'oder_place']);
Route::post('/save_checkout_customer', [CheckoutController::class,'save_checkout_customer']);
Route::get('/payment', [CheckoutController::class,'payment']);

// oder-admin
Route::get('/manage_oder', [CheckoutController::class,'manage_oder']);
Route::get('/view_oder/{oderId}', [CheckoutController::class,'view_oder']);


// add to cart ajax
Route::post('/add-cart-ajax',[CartController::class,'add_cart_ajax']);
Route::get('/show_cart_ajax', [CartController::class,'show_cart_ajax']);
Route::get('/delete_cart_ajax/{session_id}', [CartController::class,'delete_cart_ajax']);
Route::post('/update_cart_ajax', [CartController::class,'update_cart_ajax']);



