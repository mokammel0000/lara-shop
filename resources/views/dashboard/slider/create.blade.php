@extends('dashboard.layout')

@section('title')
New Slide
@endsection()


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Slides</h1>
    <a href="{{url('admin/slides')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-caret-left"> </i>
        Back To Slides
    </a>
</div>

<!-- DataTales Example -->
<form action="{{url('admin/slides')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Create New Slide
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
            <div class="alert alert-success text-center" role="alert">
                {{session('success')}}
            </div>
            @endif


            <div class="form-group">
                <label>Products</label>
                <select name="product_id" class="custom-select">
                    <option selected value=""> Select Product </option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}"> {{ $product->name }} </option>                        
                    @endforeach
                </select>
                
                @error('category_id')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Slide Content</label>
                <textarea name="content"class="form-control editor" cols="30" rows="10"></textarea>

                @error('content')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>
                       
            {{-- <div class="form-group">
                <label>Icon</label>
                <input type="text" name="icon"class="form-control @error('icon') is-invalid @enderror">

                @error('icon')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div> --}}

            <div class="form-group">
                <label>photo</label>
                <div class="custom-file mb-3">
                    <input type="file"  name="photo" class="custom-file-input @error('photo') is-invalid @enderror" >
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


