@extends('layouts.app');
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
         <h3 class="bg bg-primary">Order List</h3>
          </div>
          <div class="card-body">
            <table class="table table-dark table-hover">
              <thead>
                <tr>

                  <td>Product Name</td>
                  <td>Product Unit Price</td>
                  <td>Product Quantity</td>
                  <td>Action</td>

                </tr>
   </thead>
   <tbody>

     @foreach ($products as $product)
       <tr>
          <td>{{ App\Models\Product::find($product->product_id)->product_name }}</td>
         <td>{{ $product->product_unit_price }}</td>
         <td>{{ $product->product_quantity }}</td>
         <td>
         @if (App\Models\Review::where('billing_detail_id',$product->id)->exists() )



       @else

           <a href="{{ url('add/review') }}/{{ $product->id }}" class="btn btn-sm btn-success">Add Review</a>


@endif
 </td>


       </tr>
     @endforeach


   </tbody>
            </table>

          </div>

        </div>

      </div>

    </div>

  </div>
@endsection
