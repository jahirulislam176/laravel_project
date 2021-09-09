@extends('layouts.admin')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-8 m-auto">
      <div class="card">
        <div class="card-header">
          <h2 style="text-align:center">All Messages</h2>
        </div>
        <div class="card-body">
          <table class="table">
            <tr class="table">
             <td>User Name</td>
             <td>User Email</td>
             <td>Phone Number</td>
              <td>User Messages</td>
              <td>Action</td>
            </tr>


@foreach ($messages as  $message)
  <tr>
<td>{{ $message->first_name }}</td>
<td>{{ $message->email }}</td>
<td>{{ $message->phone_number }}</td>
<td>{{ $message->message }}</td>
<td>
  <a href="{{ url('user/delete') }}/{{ $message->id }}">

    <div class="btn-group" role="group" aria-label="Basic example">
      <button type="button" class="btn btn-danger">Delete</button>

    </div>

  </a>
</td>
  </tr>
@endforeach






          </table>
        </div>

      </div>

    </div>

  </div>

</div>




@endsection
