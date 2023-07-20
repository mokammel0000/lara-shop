@extends('dashboard.layout')

@section('title')
    Flash Deals
@endsection()


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Flash Deals</h1>
    <a href="{{url('admin/flash-deals/create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"> </i>
        New Flash Deal
    </a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Flash Deals List
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

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Duaration</th>
                        <th>Original Price</th>
                        <th>Percent of Deal</th>
                        <th>Current Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>


                {{-- @if ($flash_deals->all() != null) --}}
                @if ($flash_deals->isNotEmpty())
                    <tbody>
                        @foreach ($flash_deals as $flash_deal)                        
                        <tr>
                            <td> {{$flash_deal->name}} </td> 
                            
                            <td> {{$flash_deal->product->name}} </td>
                            
                            <td> {{$flash_deal->duaration}} hours</td>
                            
                            @php
                                $product_original_price = round($flash_deal->product->price, 0);
                                $deal_percent = $flash_deal->deal_percent;
                                $product_price_after_deal = round($product_original_price - ($product_original_price * $deal_percent / 100 ), 0);
                            @endphp
                            <td> {{$product_original_price}} EG </td>

                            <td> {{$deal_percent}} %</td>
                            
                            <td> {{$product_price_after_deal}} EG </td>

                            <td>
                                <form action="{{ url('admin/flash-deals/'. $flash_deal->id) }}" method="POST">

                                           {{--  {{url('admin/flash-deals/'. $flash_deal->id.'/'.'edit/')}} --}}
                                    <a href="{{ url("admin/toggle-deal-active/$flash_deal->id") }}"
                                        class="btn btn-sm btn-{{ $flash_deal->active? 'success': 'secondary' }}">
                                        {{ $flash_deal->active? 'Deactive': 'Active' }}
                                    </a>

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
                                There is no Flash Deals Yet, U can Add a new One from here.....
                                <a href="/admin/flash-deals/create">
                                    New Flash Deal
                                </a>
                            </div>
                        </td>
                    </tr>
                @endif
            </table>

            {{$flash_deals->links()}}


        </div>       
        
        
    </div>
</div>

@endsection()


