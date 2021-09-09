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

                  <td>Shipping ID</td>
                  <td>Sale ID</td>
                  <td>Grand Total</td>
                  <td>Purchase At</td>
                  <td>Payment Type</td>
                  {{-- <td>Payment Status</td> --}}
                  <td>Action</td>
                </tr>
   </thead>
   <tbody>

     @foreach ($all_orders as $order)
       <tr>

         <td>{{ $order->shipping_id }}</td>
         <td>{{ App\Models\Sale::Where('shipping_id',$order->shipping_id)->first()->id }}</td>
         <td>{{ $order->grand_total }}Taka</td>
         <td>{{ $order->created_at->diffForHumans() }}</td>
         <td>{{ ($order->relationtoshipping->payment_type==1) ? "Cash On Delivery" :" " }}</td>
         {{-- <td>{{ ($order->relationtoshipping->payment_status==1)? "Not Yet" :"payment Successful" }}</td> --}}
        <td>
           <a href="{{ url('customer/order/details') }}/{{ App\Models\Sale::Where('shipping_id',$order->shipping_id)->first()->id }}" class="btn btn-sm btn-info">View Details</a>
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
