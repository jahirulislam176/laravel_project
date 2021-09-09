<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Sale;
use App\Models\Billing_detail;
use App\Models\Review;
use Carbon\carbon;
use Auth;

class CustomerController extends Controller
{
    function customerdashboard()
    {
      // code...
      $total_sales=Sale::where('user_id',Auth::id())->count();
      return view('customer/dashboard',compact('total_sales'));
    }
    function customerprofile($value='')
    {
      // code...
      return view('customer/profile');
    }
    function customerprofileinsert(Request $request){

      Profile::insert([
        //'user_id'=>Auth::user()->id
        'user_id'=>Auth::id(),
        'first_name'=>$request->first_name,
        'last_name'=>$request->last_name,
        'address'=>$request->address,
        'phone_number'=>$request->phone_number,
        'zip_code'=>$request->zip_code,
        'created_at'=>Carbon::now()
      ]);
      return back();
    }

    function customerprofileupdate(Request $request){

      Profile::where('user_id',Auth::id())->update([
        //'user_id'=>Auth::user()->id
        //'user_id'=>Auth::id(),
        'first_name'=>$request->first_name,
        'last_name'=>$request->last_name,
        'address'=>$request->address,
        'phone_number'=>$request->phone_number,
        'zip_code'=>$request->zip_code,
        'created_at'=>Carbon::now()
      ]);
      return back();
    }
    function order()
    {
      $all_orders=Sale::where('user_id',Auth::id())->get();
      return view('customer/order',compact('all_orders'));
    }
    function orderdetails($sale_id)
    {
      $products= Billing_detail::where('sale_id',$sale_id)->get();
      return view('customer/orderdetails',compact('products'));
    }
    function addreview($billing_detail_id)
    {
      if (Review::where('billing_detail_id',$billing_detail_id)->exists() ){
        // code...
        return redirect('customer/order');
      }
      else{
        return view('customer/review',compact('billing_detail_id'));
      }

      // $products= Billing_detail::where('sale_id',$sale_id)->get();
      // return view('customer/orderdetails',compact('products'));
    }
    function addreviewinsert(Request $request)
    {
      // code...
      //print_r($request->all());
      Review::insert([
        'product_id'=>$request->product_id,
        'billing_detail_id'=>$request->billing_detail_id,
        'user_id'=>Auth::id(),
        'comments'=>$request->comments,
        'rating'=>$request->rating,
        'created_at'=>Carbon::now(),
      ]);
      return back();
    }
}
