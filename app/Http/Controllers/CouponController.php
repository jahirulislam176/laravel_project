<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\carbon;

class CouponController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('rolechecker');
  }
   function index()
   {
     $coupons=Coupon::all();
     return view('Backend/Coupon/view',compact('coupons'));
   }
   function couponinsert(Request $request){
   $request->validate([
     'coupon_name'=>'unique:coupons,coupon_name',
     'discount_amount'=>'numeric|max:99',
   ]);

     Coupon::insert([
       'coupon_name'=>$request->coupon_name,
       'discount_amount'=>$request->discount_amount,
       'valid_till'=>$request->valid_till,
       'created_at'=>Carbon::now()->format('Y-m-d'),
     ]);
     return back()->with('status','Coupon Added Successfully');
   }

   function coupondelete($coupon_id)
   {
    Coupon::find($coupon_id)->delete();
   return back();
   }
}
