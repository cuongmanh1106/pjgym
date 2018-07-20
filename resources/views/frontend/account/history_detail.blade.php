@extends('frontend.include.layout')
@section('title','Checkout')
@section('content')

<div class="container">
    <div class="panel panel-info" style="margin-top: 150px">
        <div class="panel-heading"><h3 style="text-align: center;">Your order detail infomation</h3></div>
        <div class="panel-body">
            

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
                <?php
                    $total = 0;
                ?>
                @foreach($details as $c)
                <?php 
                $total += $c->price*$c->quantity;
                $product = DB::table('products')->where('id',$c->pro_id)->first();
                ?>
                <tr>
                    <td><img src="{{ asset('/public/admin/images') }}/{{ $product->image }}" width="70px"></td>
                    <td>{{ $product->name }}</td>
                    <td>$ {{ number_format($c->price, 2)}}</td>
                    <td width="10%">{{ $c->quantity }}</td>
                    <td>{{$c->size}}</td>
                    <td>$ <span class="sub-total">{{ number_format($c->price*$c->quantity,2)}}</span></td>

                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <td colspan="7" align="right"><h2><b>Total: </b> $<span class="total">{{$total}}</span></h2></td>
            </tfoot>

        </table>
        <a class="btn btn-danger" href="{{ route('frontend.account.history_order') }}"><i class="fa fa-reply"></i> Back</a>
    </div>
</div>
</div>



@endsection