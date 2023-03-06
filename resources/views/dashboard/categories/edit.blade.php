@extends('dashboard.layout')

@section('title')
Edit Category
@endsection()


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Categories</h1>
    <a href="{{url('admin/categories')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-caret-left"> </i>
        Back To Categories
    </a>
</div>


<!-- DataTales Example -->
<form action="{{url('admin/categories/'. $selectedCategory->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit An Exist Category
            </h6>
        </div>

        <div class="card-body">

            @if (session('uploaded'))
            <div class="alert alert-success" role="alert">
                {{session('uploaded')}}
            </div>
            @endif
            

            
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="name" value="{{$selectedCategory->name}}"
                    class="form-control" >
                @error('name')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>
                       
            <div class="form-group">
                <label>Icon</label>
                <input type="text" name="icon" value="{{$selectedCategory->icon}}"
                    class="form-control" >
                @error('icon')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>photo</label>
                <div class="custom-file mb-3">
                    <input type="file"  name="photo" class="custom-file-input" value="{{asset($selectedCategory->photo)}}" >
                    <label class="custom-file-label" >{{asset($selectedCategory->photo)}}</label>
                    @error('photo')
                        <small class="text-danger"> {{$message}} </small>
                    @enderror
                </div>   
                <img src="{{asset($selectedCategory->photo)}}" width="200px">             
            </div>


        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>

@endsection()


