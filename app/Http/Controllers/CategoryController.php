<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\carbon;

class CategoryController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('rolechecker');
  }
  function category()
  {
    $categories=Category::all();
    return view('Backend/category/view',compact('categories'));
  }
  function categoryinsert(Request $request){
    $request->validate([
      'category_name'=>'required',
    ]);
    Category::insert([
      'category_name'=>$request->category_name,
      'created_at'=>Carbon::now()
    ]);
    return back()->with('status','Category Added Successfully');
  }


function categoryedit($category_id){
$category_info=Category::findorFail($category_id);
  return view('Backend/category/edit',compact('category_info'));

}



function categoryeditinsert(Request $request)
{

   Category::find($request->category_id)->update([
     'category_name'=>$request->category_name,
   ]);
   return back()->with('status','Category Edit Successfully');

}



  function deletecategory($category_id){
    Category::find($category_id)->delete();
    return back();
  }

}
