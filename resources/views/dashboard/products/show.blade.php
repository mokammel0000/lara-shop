@extends('dashboard.layout')

@section('title')
Show Product
@endsection()


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Products</h1>
    <a href="{{url('admin/products')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-caret-left"> </i>
        Back To Products
    </a>
</div>

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Show Product
        </h6>
    </div>

    <div class="card-body">
      <table class="table table-bordered">
        <tbody>

          <tr>
            <th >Name</th>
            <td >{{$product->name}}</td>
          </tr>

          <tr>
            <th >Category</th>
            <td >{{$product->category->name}}</td>
          </tr>

          <tr>
            <th >Stock Keeping Unit</th>
            <td >{{$product->sku}}</td>
          </tr>

          <tr>
            <th >Description</th>
            <td>{{$product->description}}</td>
          </tr>

          <tr>
            <th >price</th>
            <td>{{$product->price}}</td>
          </tr>

          <tr>
            <th >stock</th>
            <td>{{$product->stock}}</td>
          </tr>
          
        </tbody>
      </table>
    </div>
</div>

<div class="card shadow mb-4">

  <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">
          Photos
      </h6>
  </div>

  <div class="card-body">
    @foreach ($product->photos as $photo)
      <img src="{{asset($photo->path)}}" class="img-thumbnail w-22 " alt="{{$photo->name}}" title="{{$photo->name}}">
    @endforeach
  </div>
</div>

@endsection()


