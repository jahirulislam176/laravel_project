@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header text-center">
             <h3 class="bg bg-primary">Total Order</h3>
        </div>

        <div class="card-body text-center">
      {{ $total_sales }} {{ ($total_sales <=1) ? 'Order':'Orders' }} 
        </div>

      </div>

    </div>

  </div>

</div>
@endsection
