@extends('layouts.admin')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-6 offset-3">
        <div class="bg bg-primary p-2">
          <h2 style="text-align:center">Product Edit Form</h2>
        </div>

        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
    <li class="breadcrumb-item" aria-current="page">{{ $old_value->relationToCategory->category_name }}</li>
    <li class="breadcrumb-item active"><a href="#">{{ $old_value->product_name }}</a></li>
  </ol>
</nav>



        @if (session('status'))
          <div class="mb-3">
            <h2>{{ session('status') }}</h2>
          </div>
        @endif

        <form class="" action="{{ url('product/edit') }}" method="post" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">

          <label  class="form-label">Product Name</label>

          <input type="hidden" name="product_id" value="{{ $old_value->id }}">


          <input type="text" name="product_name" class="form-control" placeholder="Enter Your Product Name" value="{{ $old_value->product_name }}">


          </div>

          <div class="mb-3">
          <label for="">Product Description</label>
          <textarea name="product_Description"  rows="4" class="form-control">{{ $old_value->product_Description }}</textarea>

          </div>

          <div class="mb-3">
          <label  class="form-label">Product Price</label>
          <input type="text" name="product_price" class="form-control" placeholder="Enter Your Product price" value="{{ $old_value->product_price }}">

          </div>

          <div class="mb-3">
          <label  class="form-label">Product Quantity</label>
          <input type="text" name="product_quantity" class="form-control" placeholder="Enter Your Product Quantity" value="{{ $old_value->product_quantity }}">

          </div>


          <div class="mb-3">
          <label  class="form-label">Aler Quantity</label>
          <input type="text"  name="alert_quantity" class="form-control" placeholder="Enter Your Product price" value="{{ $old_value->alert_quantity }}">

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

@endsection
