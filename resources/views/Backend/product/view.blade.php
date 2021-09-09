@extends('layouts.admin')
@section('content')
  <div class="container">
    <div class="row ">
<div class="col-8">
<div class="bg bg-info p-3">
  <h3 style="text-align:center">All Product View</h3>

</div>
  <table class="table">
    <tr>
      <td>Serial No</td>
      <td>Category Name</td>
      <td>Product Name</td>
      <td>Product Price</td>
      <td>Product Description</td>
      <td>Create Time</td>
      <td>Product Image</td>
    </tr>
@foreach ($products as $product)
  <tr>
    <td>{{ $loop->index+1 }}</td>

    <td>{{ $product->relationToCategory->category_name }}</td>

    <td>{{ $product->product_name }}</td>
    <td>{{ $product->product_price }}</td>
    <td>{{ $product->product_Description }}</td>
    <td>{{ $product->created_at->diffForHumans() }}</td>
    <td>
 <img src="{{ asset('uploads/product_images/'.$product->product_image) }}" alt="not Found" height="100px" width="100px">
    </td>
    <td>
      <div class="btn-group" role="group" aria-label="Basic example">
  <a href="{{ url('product/edit') }}/{{ $product->id }}" type="button" class="btn btn-primary">Edit</a>
  <a href="{{ url('product/delete') }}/{{ $product->id }}" type="button" class="btn btn-primary">Delete</a>

</div>

    </td>
  </tr>
@endforeach



  </table>

  </div>


  <div class="col-4 ">
    <div class=" bg bg-primary p-2">
      <h2 class="" style="text-align:center">Product Add Form</h2>
    </div>
    @if($errors->all())
      <div class="bg bg-info">
        @foreach ($errors->all() as $error)


      <ul>
        <li>{{ $error }}</li>
      </ul>
      @endforeach
      </div>
    @endif

<br>

@if (session('status'))
  <div class="bg bg-success p-2 mr-2">
    <h3 style="text-align:center">{{ session('status') }}</h3>

  </div>

@endif

<form class="" action="{{ url('product/insert') }}" method="post"  enctype="multipart/form-data" >
@csrf

<div class="mb-3">
  <label  class="form-label"   for="">Category Name</label>
  <select class="form-control" name="category_id">

    <option value="0">--Select--</option>
    @foreach ($categories as $category)
      <option value="{{ $category->id }}">{{ $category->category_name }}</option>
    @endforeach


  </select>

</div>


<div class="mb-3">
<label  class="form-label">Product Name</label>
<input type="text" name="product_name" class="form-control" placeholder="Enter Your Product Name"  value="{{ old('product_name') }}">

</div>

<div class="mb-3">
<label for="">Product Description</label>
<textarea name="product_Description"  rows="4" class="form-control">{{ old('product_Description') }}</textarea>

</div>

<div class="mb-3">
<label  class="form-label">Product Price</label>
<input type="text" name="product_price" class="form-control" placeholder="Enter Your Product price" value={{ old('product_price') }}>

</div>

<div class="mb-3">
<label  class="form-label">Product Quantity</label>
<input type="text" name="product_quantity" class="form-control" placeholder="Enter Your Product Quantity" value="{{ old('product_quantity') }}">

</div>


<div class="mb-3">
<label  class="form-label">Aler Quantity</label>
<input type="text"  name="alert_quantity" class="form-control" placeholder="Enter Your Product price" value="{{ old('alert_quantity') }}">

</div>

<div class="mb-3">
<label for="">Product Image</label>
<br>
<input type="file" name="product_image" class="form-control">

</div>

<div class="mb-3">

<button type="submit" name="button" class="form-control  bg bg-primary">Add Product</button>

</div>



</form>




  </div>


</div>






    </div>

  </div>
@endsection
