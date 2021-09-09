@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-4 offset-4">
        @if (session('status'))
          <div class="offset-3 bg bg-success">
            <h3>{{ session('status') }}</h3>
          </div>
        @endif

        <div class="mb-3 p-2 bg bg-primary text-center">
          <h3>Add Information Form</h3>
        </div>
        @if($errors->all())
          <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </div>
        @endif
        @if (App\Models\Profile::where('user_id',Auth::id())->exists())
          @php
          $single_customer_data=App\Models\Profile::where('user_id',Auth::id())->first();
          @endphp
          <form class="" action="{{ url('customer/profile/update') }}" method="post">
            @csrf

            <div class="mb-3">
              <label>First Name</label>
              <input type="text" class="form-control" placeholder="Enter First Name" name="first_name" value="{{ $single_customer_data->first_name }}">
            </div>

            <div class="mb-3">
              <label>Last Name</label>
              <input type="text" class="form-control" placeholder="Enter Last Name" name="last_name" value="{{ $single_customer_data->last_name }}">
            </div>

            <div class="mb-3">
              <label>Address</label>
              <input type="text" class="form-control" placeholder="Enter Your Address" name="address" value="{{ $single_customer_data->address }}">
            </div>

            <div class="mb-3">
              <label>Phone Number</label>
              <input type="text" class="form-control" placeholder="Enter Your Phone Number" name="phone_number" value="{{ $single_customer_data->phone_number }}">
            </div>

            <div class="mb-3">
              <label>Zip Code</label>
              <input type="text" class="form-control"  name="zip_code" value="{{ $single_customer_data->zip_code }}">
            </div>





            <button type="submit" class="btn btn-info">update Information</button>
          </form>
        @else
          <form class="" action="{{ url('customer/profile/insert') }}" method="post">
            @csrf

            <div class="mb-3">
              <label>First Name</label>
              <input type="text" class="form-control" placeholder="Enter First Name" name="first_name">
            </div>

            <div class="mb-3">
              <label>Last Name</label>
              <input type="text" class="form-control" placeholder="Enter Last Name" name="last_name">
            </div>

            <div class="mb-3">
              <label>Address</label>
              <input type="text" class="form-control" placeholder="Enter Your Address" name="address">
            </div>

            <div class="mb-3">
              <label>Phone Number</label>
              <input type="text" class="form-control" placeholder="Enter Your Phone Number" name="phone_number">
            </div>

            <div class="mb-3">
              <label>Zip Code</label>
              <input type="text" class="form-control"  name="zip_code">
            </div>





            <button type="submit" class="btn btn-primary">Add Information</button>
          </form>

        @endif



      </div>

    </div>

  </div>
@endsection
