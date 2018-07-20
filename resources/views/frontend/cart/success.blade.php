@extends('frontend.include.layout')
@section('title','Success')
@section('content')

<div class="container">
    <div class="panel panel-info" style="margin-top: 150px">
        <div class="panel-heading"><h3 style="text-align: center;">Order successfully</h3></div>
        <div class="panel-body">
            <form method="POST" action="{{ route('frontend.cart.order') }}">
                <div class="row" style="padding: 30px 0 0 0 ">

                   <div class="col-md-4">
                    <h4><b>Date: </b><span>{{ date("d/m/Y") }}</span></h4>
                </div>
                <div class="col-md-4">
                    <h4><b>Customer: </b><span>{{Auth::user()->first_name}} {{ Auth::user()->last_name }}</span></h4>
                </div>
                <div class="col-md-4">
                    <h4><b>Phone number: </b><span>{{Auth::user()->phone_number}}</span></h4>
                </div>
            </div>
            <div class="row" style="padding: 30px 0 0 0">
                <div class="col-md-1"><h4><b>Address:</b></h4></div>
                <div class="col-md-3">
                    {{ $order->delivery_place }}
                </div>
                 <div class="col-md-4">
                    <h4><b>Delivery cost:</b> $<span id="delivery_cost">{{ $order->delivery_cost  }}</span></h4>
                </div>
                 <div class="col-md-4">
                    <h4><b>Sub total:</b> $<span class="total">{{$total}}</span></h4>
                </div>
               
            </div>

            <div class="row" style="padding: 30px 0 0 0">
                <div class="col-md-4 col-md-offset-8">
                    <h3 style="color:#4E72D0"><b>Total:</b> $<span class="total">{{$total+ $order->delivery_cost}}</span></h3>
                </div>
            </div>
           
        </form>
        <div class="clearfix"></div>
        <hr style="border:0.5px solid #000">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>Subtotal</th>

                </tr>
            </thead>

            <tbody>
                @foreach($carts as $c)
                <?php 
                $product = DB::table('products')->where('id',$c->id)->first();
                $sizes = json_decode($product->size);
                ?>
                <tr>
                    <td><img src="{{ asset('/public/admin/images') }}/{{ $product->image }}" width="70px"></td>
                    <td>{{ $product->name }}</td>
                    <td>$ {{ number_format($product->price, 2)}}</td>
                    <td width="10%">{{ $c->qty }}</td>
                    <td>{{$c->name}}</td>
                    <td>$ <span class="sub-total">{{ number_format($product->price*$c->qty,2)}}</span></td>

                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <td colspan="7" align="right"><a href="{{ route('home') }}" class="btn btn-success"><i class="fa fa-reply"></i> Back</a></td>
            </tfoot>
        </table>
    </div>

</div>
</div>
<?php
Cart::destroy();
?>

@endsection