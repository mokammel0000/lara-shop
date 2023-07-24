@extends('dashboard.layout')

@section('title')
Edit Flash Deal
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
<form action="{{url('admin/flash-deals/'.$flash_deal->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit Existing Flash Deal
            </h6>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{session('success')}}
                </div>
            @endif
            
            {{-- Title --}}
            <div class="form-group">
                <label>Flash Deal Title</label>
                <input type="text" name="title" value="{{ $flash_deal->title }}" 
                    class="form-control @error('title') is-invalid @enderror">
                
                @error('title')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            {{-- Product ID --}}
            <div class="form-group">
                <label>Product</label>
                <select class="custom-select @error('product_id') is-invalid @enderror" name="product_id" >
                    <option selected value="{{ $flash_deal->product_id }}"> {{ $flash_deal->product->name }} </option>
                    @foreach ($products as $product)
                        @if ($product->id == $flash_deal->product_id)
                            @continue;
                        @endif
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                
                @error('product_id')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            {{-- Discount Percentage  --}}
            <div class="form-group">
                <label>Discount Percentage </label>
                <div class="input-group mb-2 mr-sm-2">
                    <input type="text" name="discount_percentage" value="{{ $flash_deal->discount_percentage }}"
                        class="form-control @error('discount_percentage') is-invalid @enderror">
                    <div class="input-group-prepend">
                        <div class="input-group-text">%</div>
                    </div>
                </div>
                @error('discount_percentage')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            {{-- Duration --}}
            <div class="form-group">
                <label>Duration</label>
                <div class="input-group mb-2 mr-sm-2">
                    <input type="text" name="duration" value="{{ $flash_deal->duration }}"
                        class="form-control @error('duration') is-invalid @enderror">
                    <div class="input-group-prepend">
                        <div class="input-group-text">hrs</div>
                    </div>
                </div>                
                @error('duration')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            {{-- Start Time --}}
            <div class="form-group">
                <label>Start Time</label>
                <input class="form-control" type="datetime-local" 
                    name="start_at" id="date" value="{{ $flash_deal->start_at }}">
                
                @error('start_at')
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


