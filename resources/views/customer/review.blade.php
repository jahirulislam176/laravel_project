@extends('layouts.app');
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-3">
        <div class="card">
          <div class="card-header">
         <h3 class="bg bg-primary">Add Review</h3>
          </div>
          <div class="card-body">
            <form class="" action="{{ url('add/review/insert') }}" method="post">
              @csrf

              <input type="hidden" name="billing_detail_id" value="{{ $billing_detail_id }}">
              <input type="hidden" name="product_id" value="{{ App\Models\Billing_detail::find($billing_detail_id)->product_id }}">
              <textarea name="comments" class="form-control" rows="5" ></textarea>

              <div class="mb-3">
                <label>Your Review</label>
                <input type="range" class="form-control"  name="rating" value="" min="1" max="5" step="1">
              </div>



              <button type="submit" class="btn btn-info">Add Review</button>
            </form>
          </div>

        </div>

      </div>

    </div>

  </div>
@endsection
