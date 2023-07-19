@extends('dashboard.layout')

@section('title')
Orders
@endsection()


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Orders</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Orders List
        </h6>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            
            {{-- <form action="{{ url('admin/orders') }}" method="get"> --}}
            <form action="" method="get">

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="order_status"> Order Status </label>
                            <select  class="form-control" name="order_status" id="order_status">
                              <option value="" > ALL </option>
                              <option value="1" {{ (old('order_status')== 1)? 'selected': ''}}> New Order </option>
                              <option value="2" {{ (old('order_status')== 2)? 'selected': ''}} > In progress </option>
                              <option value="3" {{ (old('order_status')== 3)? 'selected': ''}} > Shipped </option>
                              <option value="4" {{ (old('order_status')== 4)? 'selected': ''}} > Paid </option>
                              <option value="5" {{ (old('order_status')== 5)? 'selected': ''}} > Cancelled </option>
                              <option value="6" {{ (old('order_status')== 6)? 'selected': ''}} > Rejected </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="payment_method"> Payment Method </label>
                            <select value="{{old('payment_method')}}" class="form-control" name="payment_method" id="payment_method">
                              <option value="" > ALL </option>
                              <option value="1" {{ (old('payment_method')== 1)? 'selected': ''}} > Cash On Delivery </option>
                              <option value="2" {{ (old('payment_method')== 2)? 'selected': ''}} > Paypal </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="date"> Date </label>
                            <input class="form-control" type="date" name="order_date" id="date" value="{{old('order_date')}}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-dark"> Filter </button>
                    </div>
                </div>
                
            </form>

            <table class="table table-bordered mt-4" id="dataTable" width="100%" cellspacing="0">

                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Payment Method</th>
                        <th>Order Date</th>
                        <th>View</th>
                        <th>Products In Order</th>
                        <th>Edit</th>
                    </tr>
                </thead>


                {{-- @if ($orders->all() != null) --}}
                @if ($orders->isNotEmpty())
                    <tbody>
                        @foreach ($orders as $order)                        
                        <tr>
                            <td>{{$order->user->name}}</td>
                            
                            <td>{{$order->statusText}}</td>
                            
                            <td>{{$order->paymentMethodText}}</td>
                            
                            <td>{{$order->created_at->format('j_F_Y')}}</td>

                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#information_Modal-{{ $order->id }}">
                                    Additional Info
                                </button>
                                
                                <!-- Modal -->
                                {{-- TAKE CARE OF THAT... HOW CAN WE LINK THE BUTTON WITH IT'S MODAL DIV, WE USE Order ID --}}
                                <div class="modal fade" id="information_Modal-{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    Order's Addtional Informations
                                                </h5>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <table class="table">
                                                    <thead class="text-uppercase">
                                                        <tr>
                                                            <th>Order Date & Time</th>
                                                            <th>Address</th>
                                                            <th>Notes</th>
                                                            <th>Sub-total</th>
                                                            <th>Vat</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{$order->created_at->toDayDateTimeString()}}</td>
                                                            <td>{{$order->address}}</td>
                                                            <td>{{$order->notes}}</td>
                                                            <td>{{round($order->subtotal, 0)}}</td>
                                                            <td>{{round($order->vat, 0)}}</td>
                                                            <td>{{round($order->total, 0)}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                            </td>

                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal-{{ $order->id }}">
                                    View Products
                                </button>
                                
                                <!-- Modal -->
                                {{-- TAKE CARE OF THAT... HOW CAN WE LINK THE BUTTON WITH IT'S MODAL DIV, WE USE Order ID --}}
                                <div class="modal fade" id="Modal-{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    Products in An Order - 
                                                    @if ($order->products_count == 1)
                                                        {{$order->products_count}} Product
                                                    @else
                                                        {{$order->products_count}} Products
                                                    @endif
                                                    
                                                </h5>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <table class="table">
                                                    <thead class="text-uppercase">
                                                        <tr>
                                                            <th>Product Name</th>
                                                            <th>Product Price</th>
                                                            <th>Ordered Quantity</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->products as $product)
                                                            <tr>
                                                                
                                                                <td>{{$product->name}}</td>
                                                                <td>{{round($product->pivot->price, 0)}}</td>
                                                                <td>{{$product->pivot->quantity}}</td>
                                                                <td>{{round($product->pivot->total, 0)}}</td>
                                                            </tr>
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            

                            <td>
                                <a class="btn btn-sm btn-warning" href="{{ url('admin/orders/'. $order->id.'/edit') }}">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                @else
                    <tr>
                        <td colspan="6">
                            <div class="alert alert-warning text-center" role="alert">
                                There is no Orders Yet
                            </div>
                        </td>
                    </tr>
                @endif
            </table>

            {{$orders->links()}}

        </div>       
        
        
    </div>
</div>

@endsection()


