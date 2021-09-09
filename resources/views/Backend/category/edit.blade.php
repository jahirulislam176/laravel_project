@extends('layouts.admin')
@section('content')
  <div class="container">
    <div class="row">
   <div class="col-6 offset-3">
     <div class="bg bg-info p-2">
       <h3 style="text-align:center">Category Edit</h3>

     </div>
     <form class="" action="{{ url('category/edit/insert') }}" method="post">
       @csrf
       <div class="mb-3">
         <input type="text" name="category_id" value="{{ $category_info->id }}" class="form-control">
         <input type="text" name="category_name" value="{{ $category_info->category_name }}" class="form-control">


       </div>

       <div class="mb-3">
         <input type="submit" name="" value="Update" class="form-control bg bg-info">

       </div>

     </form>

   </div>
    </div>

  </div>
@endsection
