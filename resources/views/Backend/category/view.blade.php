@extends('layouts.admin')
@section('content')
<div class="container">
  <div class="row offset-2">

<div class="col-8">
  <table class="table">
    <tr>
      <th>Serial No</th>
      <th>Category Name</th>
      <td>Create Time</td>
      <th>Action</th>
    </tr>

@foreach ($categories as $category)
  <tr>
    <td>{{ $loop->index+1 }}</td>
    <td>{{ $category->category_name }}</td>
    <td>{{ $category->created_at->diffForHumans() }}</td>
    <td>

      <a href="{{ url('Backend/category/edit') }}/{{ $category->id }}">
        <button type="button" name="button" class="bg bg-info">Edit</button>
      </a>

      <a href="{{ url('delete/category') }}/{{ $category->id }}">
         <button type="button" name="button" class="bg bg-danger">Delete</button>
      </a>

    </td>
  </tr>
@endforeach


  </table>

</div>



    <div class="col-4">
      <div class="card">
        <div class="card-header m-auto">
          <h5 class="card-title" style="text-align:center">Add Category</h5>

        </div>

        <div class="card-body">

@if (session('status'))
  <div class="bg bg-success">
    <h2>{{ session('status') }}</h2>

  </div>

@endif

          <form class="" action="{{ url('category/insert') }}" method="post" enctype="multipart/form-data">

              @csrf

            <div class="mb-3">
              <label  class="form-label">Category Name</label>
              <input type="text" name="category_name" class="form-control" placeholder="Enter Your category Name">

            </div>

            <div class="mb-3">
              <input type="submit" name="" value="Add category" class="form-control">

            </div>




          </form>

        </div>

      </div>

    </div>




  </div>

</div>

@endsection
