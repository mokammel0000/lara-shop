@extends('dashboard.layout')

@section('title')
    Products
@endsection()


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Products</h1>
    <a href="{{url('admin/products/create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"> </i>
        New Product
    </a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Products List
        </h6>
    </div>
    <div class="card-body">

        @if (session('deleted'))
        <div class="alert alert-danger" role="alert">
            {{session('deleted')}}
        </div>
        @endif

        <div class="table-responsive">
            
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>


                {{-- @if ($products->all() != null) --}}
                @if ($products->isNotEmpty())
                    <tbody>
                        @foreach ($products as $product)                        
                        <tr>
                            <td>{{$product->name}}</td> 
                            
                            <td>
                                {{$product->category->name}}
                                <i class="fas fa-{{$product->category->icon}}"></i>
                            </td>

                            <td>
                                <form action="{{ url('admin/products/'. $product->id) }}" method="POST">

                                    <a href="{{ url("admin/products/$product->id") }}" class="btn btn-sm btn-info"> View </a>
                                    
                                           {{--  {{url('admin/products/'. $product->id.'/'.'edit/')}} --}}
                                    <a href="{{ url("admin/products/$product->id/edit") }}" class="btn btn-sm btn-warning"> Edit </a>


                                    @csrf
                                    @method('Delete')
                                    <button class="btn btn-sm btn-danger" type="submit"> Delete</button>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                @else
                    <tr>
                        <td colspan="4">
                            <div class="alert alert-warning" role="alert">
                                There is no products Yet, U can Add a new Product from here.....
                                <a href="/admin/products/create">
                                    New Product
                                </a>
                            </div>
                        </td>
                    </tr>
                @endif
            </table>

            {{$products->links()}}


        </div>       
        
        
    </div>
</div>

@endsection()


