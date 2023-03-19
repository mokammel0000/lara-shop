@extends('dashboard.layout')

@section('title')
Edit Product
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
<form action="{{url('admin/products/'. $product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit An Exist Product
            </h6>
        </div>

        <div class="card-body">

            @if (session('uploaded'))
            <div class="alert alert-success" role="alert">
                {{session('uploaded')}}
            </div>
            @endif
            
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name" value="{{$product->name}}"
                    class="form-control" >
                @error('name')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Product SKU</label>
                <input type="text" name="sku" value="{{$product->sku}}"
                    class="form-control" >
                @error('sku')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Product Category</label>
                <select class="custom-select" name="category_id">
                    <option selected value="{{$product->category->id}}">{{$product->category->name}}</option>
                    @foreach ($categories as $category)
                        @if ($category != ($product->category))
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                  </select>
                
                @error('category_id')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" value="{{$product->price}}"
                    class="form-control" >
                @error('price')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Stock</label>
                <input type="text" name="stock" value="{{$product->stock}}"
                    class="form-control" >
                @error('stock')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" value="{{$product->description}}"
                class="form-control  @error('description') is-invalid @enderror">
                
                @error('description')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>


            <div class="form-group">
                <label>photo</label>
                <div class="custom-file mb-3">
                    <input type="file"  name="photos[]" multiple class="custom-file-input @error('photo') is-invalid @enderror" >
                    <label class="custom-file-label "> </label>
                    @error('photo')
                        <small class="text-danger"> {{$message}} </small>
                    @enderror
                </div>
                @foreach ($product->photos as $photo)
                    <img src="{{asset($photo->path)}}" class="img-thumbnail w-22 " alt="{{$photo->name}}" title="{{$photo->name}}">
                @endforeach
            </div>

        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>

@endsection()


