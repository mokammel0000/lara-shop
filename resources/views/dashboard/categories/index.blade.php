@extends('dashboard.layout')

@section('title')
Categories
@endsection()


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Categories</h1>
    <a href="{{url('admin/categories/create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"> </i>
        New Category
    </a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Categories List
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
                        <th>Photo</th>
                        <th>Icon</th>
                        <th>Actions</th>
                    </tr>
                </thead>


                {{-- @if ($cats->all() != null) --}}
                @if ($cats->isNotEmpty())
                    <tbody>
                        @foreach ($cats as $category)                        
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>
                                <img src="{{asset($category->photo) }}" alt="" style="width: 200px; height : 150px">
                                {{-- <img src="{{url($category->photo) }}" alt=""> --}}
                            </td>
                            <td>
                                <i class="fas fa-{{ $category->icon}} ">
                                    <img src="{{url($category->icon)}}" alt="">
                                </i>
                            </td>
                            <td>
                                <a href="{{ url("admin/categories/$category->id") }}" class="btn btn-sm btn-info"> View </a>
                                {{--  {{url('admin/categories/'. $category->id.'/'.'edit/')}} --}}
                                <a href="{{ url("admin/categories/$category->id/edit") }}" class="btn btn-sm btn-warning"> Edit </a>
                                <form action="{{ url('admin/categories/'. $category->id) }}" method="POST" style="display: inline">
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
                                There is no categories Yet, U can Add a new Cateory from here.....
                                <a href="/admin/categories/create">
                                    New Category
                                </a>
                            </div>
                        </td>
                    </tr>
                @endif
            </table>

            {{$cats->links()}}


        </div>       
        
        
    </div>
</div>

@endsection()


