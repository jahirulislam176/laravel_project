<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Message;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Shipping;
use App\Models\Sale;
use App\Models\Billing_detail;
use App\Notifications\UserNotification;
use Auth;
use Carbon\carbon;

class FrontendController extends Controller
{


  function index()
  {
    $products=Product::all();
    $categories=Category::all();
    return view('welcome',compact('products','categories'));
  }


    function contact(){

      return view('contact');
    }

function messageToAdmin(Request $request){
  Message::insert([
  'first_name'=>$request->first_name,
    'last_name'=>$request->last_name,
    'phone_number'=>$request->phone_number,
    'email'=>$request->email,
    'message'=>$request->message,
  ]);
  return back()->with('Status','Successfully Inserted Your Data');

}


    function categorywiseproduct($category_id){
      $products=Product::where('category_id',$category_id)->get();
      return view('categorywiseproduct',compact('products'));
    }

function productdetails($product_id){
$singleproductinfo=Product::find($product_id);
$related_products=Product::where('category_id',$singleproductinfo->category_id)->where('id','!=',$product_id)->get();
  return view('productdetails',compact('singleproductinfo','related_products'));
}


//Cart System
function cart($coupon_name =""){
if($coupon_name== ""){
  $ip_address=$_SERVER['REMOTE_ADDR'];
  $cart_items=Cart::where('customer_ip',$ip_address)->get();
  $coupon_discount_amount= 0;
  return view('cart',compact('cart_items','coupon_discount_amount','coupon_name'));
}
else{
  if (Coupon::where('coupon_name',$coupon_name)->exists()) {
    // echo Carbon::now()->format('Y-m-d');
    // echo "<br>";
    // Coupon::where('coupon_name',$coupon_name)->first()->valid_till;
    if(Carbon::now()->format('Y-m-d') <=Coupon::where('coupon_name',$coupon_name)->first()->valid_till){

      $ip_address=$_SERVER['REMOTE_ADDR'];
      $cart_items=Cart::where('customer_ip',$ip_address)->get();
      $coupon_discount_amount=Coupon::where('coupon_name',$coupon_name)->first()->discount_amount;
      return view('cart',compact('cart_items','coupon_discount_amount','coupon_name'));
        }
        else{
          echo "Invalid Coupon";
        }
  }
  else{
    echo "No coupon";
  }

}
}
// function cartwithcouponname($coupon_name){
//   echo $coupon_name;
//
// }
function addTocart($product_id){
  $ip_address=$_SERVER['REMOTE_ADDR'];
  if (Cart::where('customer_ip',$ip_address)->where('product_id',$product_id)->exists()) {
    Cart::where('customer_ip',$ip_address)->where('product_id',$product_id)->increment('product_quantity',1);
    return back();
    // code...
  }
  else{
    Cart::insert([
      'customer_ip'=>$ip_address,
      'product_id'=>$product_id,
      'created_at'=>Carbon::now()
    ]);
    return back();
  }
}


function clearcart()
{
  $ip_address=$_SERVER['REMOTE_ADDR'];
  Cart::where('customer_ip',$ip_address)->delete();
  return back();
}

function singlecartdelete($cart_id){
  Cart::find($cart_id)->delete();
  return back();
}
function updatecart(Request $request){
    $ip_address=$_SERVER['REMOTE_ADDR'];
  foreach ($request->product_id as $key_of_product_id => $value_of_product_id) {
  if (Product::find($value_of_product_id)->product_quantity >=$request->user_given_quantity[$key_of_product_id]) {
    Cart::where('customer_ip',$ip_address)->where('product_id',$value_of_product_id)->update([
      'product_quantity'=>$request->user_given_quantity[$key_of_product_id]
    ]);
    // echo $key_of_product_id;
    // echo '<br>';
    // echo $value_of_product_id;
    // echo "<br>";
    // code...
//print_r($request->all());
      // code...

  }
  }
    return back();

}

function customerregister()
{
  return view('customerregister');
}
function customerregisterinsert(Request $request)
{
  User::insert([
 'name'=>$request->name,
 'email'=>$request->email,
 'password'=>bcrypt($request->password),
 'role'=>2,
 'created_at'=>Carbon::now()
  ]);
  return back();
}
function checkout(Request $request)
{

  $v=auth()->user();
  if (!$v){
      return back()->withErrors('msg', 'You have to login first');
  }
  if ($request->sc == 1){
      $j="Delivery will within one day";
  }
    if ($request->sc == 2){
        $j="Delivery will within seven days";
    }
    if ($request->sc == 3){
        $j="You take your product by your Pickup  within two days otherwise it will be cancel.";
    }

  app(User::class)->fill(['email' => $v->email])->notify(new UserNotification($j));
  $grand_total=$request->grand_total;
  $countries=Country::all();
  return view('checkout',compact('countries','grand_total'));
}

function checkoutinsert(Request $request)
{
  //($request->all());
  $shipping_id=Shipping::insertGetId([
    'user_id'=>Auth::id(),
    'first_name'=>$request->first_name,
    'last_name'=>$request->last_name,
    'address'=>$request->address,
    'phone_number'=>$request->phone_number,
    'zip_code'=>$request->zip_code,
    'country_id'=>$request->country_id,
    'city_id'=>$request->city_id,
    'payment_type'=>$request->payment_type,
    'payment_status'=>1,
    'created_at'=>Carbon::now()

  ]);
$sale_id=Sale::insertGetId([
        'user_id'=>Auth::id(),
        'shipping_id'=>$shipping_id,
        'grand_total'=>$request->grand_total,
        'created_at'=>Carbon::now(),
  ]);
  $ip_address=$_SERVER['REMOTE_ADDR'];
  $cart_items=Cart::where('customer_ip',$ip_address)->get();
  foreach ($cart_items as $cart_item) {
    Billing_detail::insert([
      'sale_id'=>$sale_id,
      'product_id'=>$cart_item->product_id,
      'product_unit_price'=>Product::find($cart_item->product_id)->product_price,
      'product_quantity'=>$cart_item->product_quantity,
      'created_at'=>Carbon::now(),
    ]);
    Product::find($cart_item->product_id)->decrement('product_quantity',$cart_item->product_quantity);
    $cart_item->delete();
    // code...
  }

return redirect('/');
  // $grand_total=$request->grand_total;
  // $countries=Country::all();
  // return view('checkout',compact('countries','grand_total'));
}


function citylist(Request $request){
  echo $request->country_id;
  $stringTosend="<option>-Select One-</option>";
  $cities=City::where('country_id',$request->country_id)->get();
  foreach ($cities as $city) {
    // code...

    $stringTosend .="<option value='".$city->id."'>".$city->name."</option>";

  }
  echo   $stringTosend;
}

}
