<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Message;
use Carbon\carbon;
Use Image;

class ProductController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

    function productview(){
      $products=Product::all();
      $categories=Category::all();

      return view('Backend/product/view',compact('products','categories'));
    }


function productinsert(Request $request){


$request->validate([
  'product_name'=>'required',
  'product_Description'=>'required',
  'product_price'=>'required|numeric',
  'product_quantity'=>'required|numeric',
  'alert_quantity'=>'required|numeric',
],

[
'product_name.required'=>'Please Enter Product name',
'product_Description.required'=>'Enter Product Description',
'product_price.required'=>'Enter product Price',
'product_quantity.required'=>'Enter Producty Quantity',
'alert_quantity.required'=>'Enter Alert Quantity',

]);



  $insertgetid=Product::insertGetId([
      'category_id'=>$request->category_id,
    'product_name'=>$request->product_name,
    'product_Description'=>$request->product_Description,
    'product_price'=>$request->product_price,
    'product_quantity'=>$request->product_quantity,
    'alert_quantity'=>$request->alert_quantity,
    'created_at'=>Carbon::now(),
  ]);

if($request->hasFile('product_image')){

  $main_photo=$request->product_image;
  $image_name=$insertgetid.'.'.$main_photo->getClientOriginalExtension();

  Image::make($main_photo)->resize(500,500)->save(base_path('public/uploads/product_images/'.$image_name));

Product::find($insertgetid)->update([
  'product_image'=>$image_name,
]);

}
return back()->with('status','ProductAddedSuccessfully');




}

function producteditpage($product_id)
{
$old_value=Product::find($product_id);
  return view('Backend/product/edit',compact('old_value'));
}
function producteditinsert(Request $request){
  Product::find($request->product_id)->update([

    'product_name'=>$request->product_name,
    'product_Description'=>$request->product_Description,
    'product_price'=>$request->product_price,
    'product_quantity'=>$request->product_quantity,
    'alert_quantity'=>$request->alert_quantity,
  ]);

  if($request->hasFile('product_image')){
    if(Product::find($request->product_id)->product_image != 'defaultproductimage.jpg'){
      //$nameTodelete=$request->product_id->product_id;
      //$nameTodelete=$request->product_image;
      $nameTodelete=Product::find($request->product_id)->product_image;
      unlink(base_path('public/uploads/product_images/'.$nameTodelete));
    }
    $main_photo=$request->product_image;
    $imagename=$request->product_id.'.'.$main_photo->getClientOriginalExtension();
    Image::make($main_photo)->resize(500,500)->save(base_path('public/uploads/product_images/'.$imagename));
    product::find($request->product_id)->update([
      'product_image'=> $imagename,

    ]);
  }
  return back()->with('status','Product Edit Successfully');
}



function productdelete($product_id){

  $nameToDelete = Product::find($product_id)->product_image;
  unlink("uploads/product_images/".$nameToDelete);
  Product::find($product_id)->delete();
  return back();
}

function messageview(){
    $messages=Message::simplePaginate(5);
    return view('Backend/message/view',compact('messages'));
}
function  messagedelete($user_id){
  Message::find($user_id)->delete();
  return back();
}
function customerdetails()
{
  return view('Backend/customer/view');
}



}
