<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\ManagecustomerController;
use App\Http\Controllers\Admin\ManageorderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[HomeController::class,'index'])->name('home'); 
Route::post('enquiry.store',[EnquiryController::class,'store'])->name('enquiry.store');
Route::get('admin', ([LoginController::class, 'index']))->name('login');
Route::post('admin/login', [LoginController::class, 'login'])->name('login.post');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('permission', PermissionController::class);
    Route::get('logout',[LoginController::class,'logout'])->name('logout');
    Route::resource('role',RoleController::class);
    Route::resource('page',PageController::class);
    Route::post('ckeditor/upload', [PageController::class, 'upload'])->name('ckeditor.upload');
    Route::post('ckeditor/upload', [BlockController::class, 'upload'])->name('ckeditor.upload');
    Route::resource('slider',SliderController::class);
    Route::resource('block',BlockController::class);
    Route::get('enquiry',[EnquiryController::class,'index'])->name('enquiry');
    Route::delete("enqry.destroy{id}", [EnquiryController::class ,'destroy'])->name('enqry.destroy');
    Route::post("enqry.status", [EnquiryController::class ,'status'])->name('enqry.status');
    Route::resource('product',ProductController::class);
    Route::post('ckeditor/upload', [ProductController::class, 'upload'])->name('ckeditor.upload');
    Route::resource('category',CategoryController::class);
    Route::resource('attribute',AttributeController::class);
    Route::resource('coupon',CouponsController::class);
    Route::get('manageorder',[ManageorderController::class,'index'])->name('manageorder');
    Route::get('order/show{id}',[ManageorderController::class,'show'])->name('order.show');
    Route::get('manage/customer',[ManagecustomerController::class,'index'])->name('manage.customer');
    Route::get('customer/show/{id}',[ManagecustomerController::class,'show'])->name('managecustomer.show');
    Route::get('customer/view/{id}',[ManagecustomerController::class,'view'])->name('managecustomer.view');

});
Route::get('contact',[ContactController::class,'index'])->name('contact');
Route::get('category/{urlkey}',[HomeController::class,'categories'])->name('category.data');
Route::get('product/{urlkey}',[HomeController::class,'productData'])->name('product.data');

Route::get('cart',[CartController::class,'viewCart'])->name('cart');
Route::post('cart/store/{id}',[CartController::class,'addToCart'])->name('cartStore');
// cart delete
Route::delete('cart/delete/{id}', [CartController::class, 'cartDelete'])->name('cart.delete');
Route::post('cart/update/{id}', [CartController::class,'cartUpdate'])->name('cart.update');

// coupon apply
Route::post('coupon/apply', [CartController::class, 'couponApply'])->name('coupon.apply');
Route::get('coupon/cancel/{id}', [CartController::class,'couponCancel'])->name('coupon.cancel');

//checkout 
Route::get('checkout',[CheckoutController::class,'addToCheckout'])->name('checkout');
Route::post('checkout/store',[CheckoutController::class,'checkoutStore'])->name('checkout.store');
Route::post('checkout/shipping',[CheckoutController::class,'cartStore'])->name('cart.shipping');
Route::get('checkout/shipping',[CheckoutController::class,'success'])->name('checkout.success');

//customer 
Route::get('customer/create',[CustomerController::class,'index'])->name('customer.create');
Route::post('customer/store',[CustomerController::class,'store'])->name('customer.store');
Route::get('customer/login',[CustomerController::class,'login'])->name('customer.login');
Route::get('customer/logout',[CustomerController::class,'logout'])->name('customer.logout');
Route::post('customer/authenticate',[CustomerController::class,'authenticate'])->name('customer.authenticate');
Route::get('customer/profile',[CustomerController::class,'profile'])->name('customer.profile');
Route::post('customer/update',[CustomerController::class,'update'])->name('customer.update');

Route::post('wishlist/store', [WishlistController::class,'storeWishlist'])->name('wishlist.store');
Route::get('wishlist/destory/{id}', [WishlistController::class,'destory'])->name('wishlist.destory');
Route::get('wishlist/proflie', [WishlistController::class,'proflie'])->name('wishlist.list');

Route::get('/{urlkey}',[HomeController::class,'page'])->name('page');