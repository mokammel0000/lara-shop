@extends('dashboard.layout')

@section('title')
Create Flash Deal
@endsection()


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Flash Deals</h1>
    <a href="{{url('admin/flash-deals/')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-caret-left"> </i>
        Back To Flash Deals
    </a>
</div>

<!-- DataTales Example -->
<form action="{{url('admin/flash-deals/')}}" method="POST">
    @csrf
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Create New Flash Deal
            </h6>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{session('success')}}
                </div>
            @endif
            

            <div class="form-group">
                <label>Related Product</label>
                <select class="custom-select @error('product_id') is-invalid @enderror" name="product_id" >
                    <option selected value="">Select A Product</option>
                    @foreach ($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>
                
                @error('product_id')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Flash Deal Name</label>
                <input type="text" name="name"class="form-control @error('name') is-invalid @enderror">
                
                @error('name')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Deal Percentage </label>
                <input type="text" name="deal_percent"class="form-control @error('deal_percent') is-invalid @enderror">
                
                @error('deal_percent')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Deal Duaration</label>
                <input type="text" name="duaration"class="form-control @error('duaration') is-invalid @enderror">
                
                @error('duaration')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>

@endsection()


