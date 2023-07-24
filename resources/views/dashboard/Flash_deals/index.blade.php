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
                {{-- discount_percentage, original_price, discounted_price,   duration, start_at, end_at, active --}}
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Product</th>
                        <th>Duration</th>
                        <th>Percent of Deal</th>
                        <th>Started At</th>
                        <th>Info</th>
                        <th>Actions</th>
                    </tr>
                </thead>


                {{-- @if ($flash_deals->all() != null) --}}
                @if ($flash_deals->isNotEmpty())
                    <tbody>
                        @foreach ($flash_deals as $flash_deal)                        
                        <tr>
                            <td> {{$flash_deal->title}} </td> 

                            <td> {{$flash_deal->product->name}} </td>
                            
                            <td> {{$flash_deal->duration}} hours</td>

                            <td> {{$flash_deal->discount_percentage}} % </td>
                            
                            <td> {{$flash_deal->start_at->toDateTimeString()}} </td>
                            {{-- Before Do It, you must add this field in the $casts array
                                to convert the date that's fetched from DB from a string to a Carbon Object --}}

                            {{-- Modal to view Additionoal Information about Deal --}}
                            <td>
                                
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#information_Modal-{{ $flash_deal->id }}">
                                    View
                                </button>
                                
                                <!-- Modal -->
                                {{-- TAKE CARE OF THAT... HOW CAN WE LINK THE BUTTON WITH IT'S MODAL DIV, WE USE Flash Deal ID --}}
                                <div class="modal fade" id="information_Modal-{{ $flash_deal->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    Flash Deal's Addtional Informations
                                                </h5>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <table class="table">
                                                    <thead class="text-uppercase">
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Original Price</th>
                                                            <th>Current Price</th>
                                                            <th>Started At</th>
                                                            <th>Ended At</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td> {{$flash_deal->title}} </td> 
                                                            <td> {{$flash_deal->original_price}} EG </td>
                                                            <td> {{$flash_deal->discounted_price}} EG </td>
                                                            <td> {{$flash_deal->start_at}}</td>
                                                            <td> {{$flash_deal->end_at}}</td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            {{-- Actions --}}
                            <td>
                                <form action="{{ url('admin/flash-deals/'. $flash_deal->id) }}" method="POST">

                                           {{--  {{url('admin/flash-deals/'. $flash_deal->id.'/'.'edit/')}} --}}
                                    <a href="{{ url("admin/toggle-deal-active/$flash_deal->id") }}"
                                        class="btn btn-sm btn-{{ $flash_deal->active? 'success': 'secondary' }}">
                                        {{ $flash_deal->active? 'Deactive': 'Active' }}
                                    </a>

                                    <a href="{{ url("admin/flash-deals/$flash_deal->id/edit") }}"
                                        class="btn btn-sm btn-warning }}">
                                        Edit
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


