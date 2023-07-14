@extends('dashboard.layout')

@section('title')
Edit Slider
@endsection()


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Slide</h1>
    <a href="{{url('admin/slides')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-caret-left"> </i>
        Back To Slides
    </a>
</div>


<!-- DataTales Example -->
<form action="{{url('admin/slides/'. $slide->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit An Exist Slide
            </h6>
        </div>

        <div class="card-body">

            @if (session('uploaded'))
            <div class="alert alert-success" role="alert">
                {{session('uploaded')}}
            </div>
            @endif
            

            
            <div class="form-group">
                <label>Slide Content</label>
                <input type="text" name="content" value="{!!$slide->content!!}"
                    class="form-control" >
                @error('content')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>
                       
            
            <div class="form-group">
                <label>Product ID</label>
                <input type="text" name="product_id" value="{{$slide->product_id}}"
                    class="form-control" >
                @error('product_id')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>


            <div class="form-group">
                <label>photo</label>
                <div class="custom-file mb-3">
                    <input type="file"  name="photo" class="custom-file-input" value="{{asset($slide->photo)}}" >
                    <label class="custom-file-label" >{{asset($slide->photo)}}</label>
                    @error('photo')
                        <small class="text-danger"> {{$message}} </small>
                    @enderror
                </div>   
                <img src="{{asset($slide->photo)}}" width="200px">             
            </div>


        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>

@endsection()


