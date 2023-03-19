@extends('dashboard.layout')

@section('title')
New Product
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
<form action="{{url('admin/products')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Create New Product
            </h6>
        </div>

        <div class="card-body">


            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{session('success')}}
            </div>
            @endif
            

            <div class="form-group">
                <label>Category</label>
                <select class="custom-select" name="category_id">
                    <option selected value="">Select A Category</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                
                @error('category_id')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name"class="form-control @error('name') is-invalid @enderror">
                
                @error('name')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>
                       
            <div class="form-group">
                <label>Price</label>
                <input type="text" name="price"value="0" class="form-control @error('price') is-invalid @enderror">

                @error('price')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Stock</label>
                <input type="text" name="stock"value="0" class="form-control @error('stock') is-invalid @enderror">

                @error('stock')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="5"></textarea>
                @error('description')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>photos</label>
                <div class="custom-file mb-3">
                    <input type="file"  name="photos[]" multiple class="custom-file-input @error('photo') is-invalid @enderror" >
                    <label class="custom-file-label" >Choose file...</label>
                    @error('photo')
                        <small class="text-danger"> {{$message}} </small>
                    @enderror
                </div>                
            </div>


        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>

@endsection()


