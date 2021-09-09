<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
//Frontend Route
Route::get('/',[FrontendController::class,'index']);
Route::get('contact',[FrontendController::class,'contact']);

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('categorywiseproduct/{category_id}',[FrontendController::class,'categorywiseproduct']);
Route::get('product/details/{product_id}',[FrontendController::class,'productdetails']);
Route::POST('message/insert',[FrontendController::class,'messageToAdmin']);
Route::get('cart',[FrontendController::class,'cart']);
Route::get('cart/{coupon_name}',[FrontendController::class,'cart']);
Route::get('add/to/cart/{product_id}',[FrontendController::class,'addTocart']);
Route::get('clear/cart',[FrontendController::class,'clearcart']);
Route::get('single/cart/delete/{cart_id}',[FrontendController::class,'singlecartdelete']);
Route::POST('update/cart',[FrontendController::class,'updatecart']);
Route::get('customer/register',[FrontendController::class,'customerregister']);
Route::POST('customer/register/insert',[FrontendController::class,'customerregisterinsert']);
Route::POST('checkout',[FrontendController::class,'checkout']);
Route::POST('checkout/insert',[FrontendController::class,'checkoutinsert']);
Route::POST('city/list',[FrontendController::class,'citylist']);
//customer controller
Route::get('customer/dashboard',[CustomerController::class,'customerdashboard']);
Route::get('customer/profile',[CustomerController::class,'customerprofile']);
Route::POST('customer/profile/insert',[CustomerController::class,'customerprofileinsert']);
Route::POST('customer/profile/update',[CustomerController::class,'customerprofileupdate']);
Route::get('customer/order',[CustomerController::class,'order']);
Route::get('customer/order/details/{sale_id}',[CustomerController::class,'orderdetails']);
Route::get('add/review/{billing_detail_id}',[CustomerController::class,'addreview']);
Route::POST('add/review/insert',[CustomerController::class,'addreviewinsert']);
//Backend Route
Route::get('Backend/product/view',[ProductController::class,'productview']);
Route::POST('product/insert',[ProductController::class,'productinsert']);
Route::get('product/edit/{product_id}',[ProductController::class,'producteditpage']);
Route::POST('product/edit',[ProductController::class,'producteditinsert']);
Route::get('product/delete/{product_id}',[ProductController::class,'productdelete']);
Route::get('Backend/message/view',[ProductController::class,'messageview']);
Route::get('user/delete/{user_id}',[ProductController::class,'messagedelete']);
Route::get('Backend/customer/view',[ProductController::class,'customerdetails']);
//Category Routing
Route::get('Backend/category/view',[CategoryController::class,'category']);
Route::POST('category/insert',[CategoryController::class,'categoryinsert']);
Route::get('Backend/category/edit/{category_id}',[CategoryController::class,'categoryedit']);
Route::POST('category/edit/insert',[CategoryController::class,'categoryeditinsert']);
Route::get('delete/category/{category_id}',[CategoryController::class,'deletecategory']);
Route::get('Backend/Coupon/view',[CouponController::class,'index']);
Route::POST('coupon/insert',[CouponController::class,'couponinsert']);
Route::get('delete/coupon/{coupon_id}',[CouponController::class,'coupondelete']);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
