@extends('layouts.admin')
@section('content')
  <div class="container">
    <div class="row">

<div class="col-8">
  <div class="mb-3 p-2 bg bg-primary text-center">
    <h3>View Coupons</h3>

  </div>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Serial</th>
      <th scope="col">Coupon Name</th>
      <th scope="col">Discount Amount(%)</th>
      <th scope="col">Created At</th>
      <th scope="col">Valid Till</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($coupons as  $coupon)
      <tr>
        <th>{{ $loop->index+1 }}</th>
        <td>{{ $coupon->coupon_name }}</td>
        <td>{{ $coupon->discount_amount }}</td>
        <td>{{ $coupon->created_at->format('Y-m-d') }}</td>
        <td>{{ $coupon->valid_till }}</td>

        <td>
          @if(Carbon\carbon::now()->format('Y-m-d') <=$coupon->valid_till)
          <span class="bg-success">Valid</span>
        @else
            <span class="bg-danger">Invalid</span>
        @endif
      </td>
        <td>
              <a href="{{ url('delete/coupon') }}/{{ $coupon->id }}">
                <button type="button" name="button" class="btn btn-danger">Delete</button>
              </a>

        </td>
      </tr>
    @endforeach


  </tbody>
</table>

</div>








   <div class="col-4">
     @if (session('status'))
       <div class="offset-3 bg bg-success">
         <h3>{{ session('status') }}</h3>
       </div>
     @endif

     <div class="mb-3 p-2 bg bg-primary text-center">
       <h3>Add Coupon</h3>

     </div>




     @if($errors->all())
       <div class="alert alert-danger">
         @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
         @endforeach
       </div>
     @endif
     <form class="" action="{{ url('coupon/insert') }}" method="post">
       @csrf

       <div class="mb-3">
         <label>Coupon Name</label>
         <input type="text" class="form-control" placeholder="Enter Coupon Name" name="coupon_name">
       </div>


       <div class="mb-3">
         <label>Discount Amount</label>
         <input type="text" class="form-control" placeholder="Enter Coupon Discount" name="discount_amount">
       </div>

       <div class="mb-3">
         <label>Valid date</label>
         <input type="date" class="form-control" name="valid_till">
       </div>

       <button type="submit" class="btn btn-primary">Add Coupon</button>
     </form>


   </div>

    </div>

  </div>
@endsection
