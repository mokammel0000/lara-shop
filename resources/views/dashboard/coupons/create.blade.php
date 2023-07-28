@extends('dashboard.layout')

@section('title')
Create Coupon
@endsection()


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Coupons</h1>
    <a href="{{url('admin/coupons/')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-caret-left"> </i>
        Back To Coupons
    </a>
</div>

<!-- DataTales Example -->
<form action="{{url('admin/coupons/')}}" method="POST">
    @csrf
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Create New Coupon
            </h6>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{session('success')}}
                </div>
            @endif
            
            {{-- Code --}}
            <div class="form-group">
                <label>Coupon Code</label>
                <input type="text" name="code" value="{{ old('code') }}"
                class="form-control @error('code') is-invalid @enderror">
                
                @error('code')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            {{-- Type --}}
            <div class="form-group">
                <label>Type</label>
                <div class="input-group mb-2 mr-sm-2">
                    <select name="type"  
                        class="form-control @error('type') is-invalid @enderror">
                        <option {{ old('type') == 1? 'selected': '' }} value="1"> Fixed value </option>
                        <option {{ old('type') == 2? 'selected': '' }} value="2"> Percent </option>
                    </select>
                </div>
                @error('type')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            {{-- Discount --}}
            <div class="form-group">
                <label>Discount</label>
                <div class="input-group mb-2 mr-sm-2">
                    <input type="text" name="discount" value="{{ old('discount') }}"
                        class="form-control @error('discount') is-invalid @enderror">
                </div>
                @error('discount')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            {{-- Redeems --}}
            <div class="form-group">
                <label> Redeems </label>
                <div class="input-group mb-2 mr-sm-2">
                    <input type="text" name="redeems" value="{{ old('redeems') }}"
                        class="form-control @error('redeems') is-invalid @enderror">
                </div>
                @error('redeems')
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


