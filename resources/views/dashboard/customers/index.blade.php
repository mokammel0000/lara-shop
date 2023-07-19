@extends('dashboard.layout')

@section('title')
Customers
@endsection()


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Customers</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Customers List
        </h6>
    </div>
    <div class="card-body">

        @if (session('deleted'))
        <div class="alert alert-danger" role="alert">
            {{session('deleted')}}
        </div>
        @endif

        <div class="table-responsive">
            
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>


                {{-- @if ($customers->all() != null) --}}
                @if ($customers->isNotEmpty())
                    <tbody>
                        @foreach ($customers as $customer)                        
                        <tr>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->phone}}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal-{{ $customer->id }}">
                                    View User Orders
                                </button>
                                
                                <!-- Modal -->
                                {{-- TAKE CARE OF THAT... HOW CAN WE LINK THE BUTTON WITH IT'S MODAL DIV, WE USE CUSTOMER ID --}}
                                <div class="modal fade" id="Modal-{{ $customer->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ $customer->name }}
                                                    <small>
                                                        signed up in
                                                        {{ $customer->created_at->toDayDateTimeString() }}
                                                    </small>
                                                </h5>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <h4><b>User Informations</b></h4>
                                                <table class="table">
                                                    <thead class="text-uppercase">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Address</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{$customer->name}}</td>
                                                            <td>{{$customer->email}}</td>
                                                            <td>{{$customer->phone}}</td>
                                                            <td>{{$customer->address}}</td>
                                                        </tr>
                                                
                                                    </tbody>
                                                </table>

                                                <br>
                                                <br>
                                                <br>


                                                <h4><b>User Previous Orders</b></h4>
                                                <table class="table">
                                                    <thead class="text-uppercase">
                                                        <tr>
                                                            @if ($customer->orders->isNotEmpty())
                                                                <th>Status</th>
                                                                <th>Payment_method</th>
                                                                <th>Payment_status</th>
                                                                <th>Address</th>
                                                                <th>Notes</th>
                                                                <th>Total</th>
                                                            @endif
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($customer->orders as $order)
                                                        <tr>
                                                            <td> {{$order->status_text}} </td>
                                                            <td> {{$order->payment_method_text}} </td>
                                                            <td class="text-center"> {{$order->payment_status}} </td>
                                                            <td> {{$order->address ?: auth()->user()->address}} </td>
                                                            <td> {{$order->notes}} </td>
                                                            <td> {{$order->total}} </td>
                                                        </tr>
                                                        @empty
                                                            <div class="alert alert-warning text-center"> No Orders have been ordered or deliverd for this user</div>
                                                        @endforelse                                         
                                                    </tbody>
                                                </table>
                                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                @else
                    <tr>
                        <td colspan="4">
                            <div class="alert alert-warning" role="alert">
                                There is no Customers Yet.....
                            </div>
                        </td>
                    </tr>
                @endif
            </table>

            {{$customers->links()}}


        </div>       
        
        
    </div>
</div>

@endsection()


