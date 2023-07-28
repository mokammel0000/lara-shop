@extends('dashboard.layout')

@section('title')
    Coupons
@endsection()


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Coupons</h1>
    <a href="{{url('admin/coupons/create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"> </i>
        New Coupon
    </a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Coupons List
        </h6>
    </div>
    <div class="card-body">

        @if (session('deleted'))
        <div class="alert alert-danger text-center" role="alert">
            {{session('deleted')}}
        </div>
        @endif

        <div class="table-responsive">
            
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                {{-- discount_percentage, original_price, discounted_price,   duration, start_at, end_at, active --}}
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Discount</th>
                        <th>Redeems</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>


                {{-- @if ($coupons->all() != null) --}}
                @if ($coupons->isNotEmpty())
                    <tbody>
                        @foreach ($coupons as $coupon)                        
                            <tr>
                                <td> {{ $coupon->code }} </td>
                                <td> {{ $coupon->type_of_coupon }} </td>
                                <td> {{ $coupon->discount_with_sign }} </td>
                                <td> {{ $coupon->redeems }} </td>
                                <td> 
                                    <a href="{{ url("admin/toggle-coupon-active/$coupon->id") }}" 
                                        class="btn btn-sm btn-{{ $coupon->active? 'success': 'secondary' }}">
                                        {{ $coupon->active? 'Active': 'Inactive' }}
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ url('admin/coupons/'. $coupon->id) }}" method="POST">
                                        <a href="{{ url("admin/coupons/$coupon->id/edit") }}" class="btn btn-sm btn-warning"> Edit </a>
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
                        <td colspan="7">
                            <div class="alert alert-warning text-center" role="alert">
                                There is No Coupons Yet, U can Add a new One from here.....
                                <a href="/admin/coupons/create">
                                    New Coupon
                                </a>
                            </div>
                        </td>
                    </tr>
                @endif
            </table>

            {{$coupons->links()}}


        </div>       
        
        
    </div>
</div>

@endsection()


