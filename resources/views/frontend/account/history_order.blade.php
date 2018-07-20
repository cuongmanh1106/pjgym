@extends('frontend.include.layout')
@section('title','History Order')
@section('content')

<div class="container">
    <div class="panel panel-info" style="margin-top: 150px">
        <div class="panel-heading"><h3 style="text-align: center;">Your History cart</h3></div>
        <div class="panel-body">
            

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Delivery cost</th>
                    <th>Sub total</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
                @foreach($orders as $c)
                <?php 
                $order_detail = DB::table('order_details')->where('order_id',$c->id)->get();
                $subtotal = 0;
                foreach($order_detail as $o) {
                	$subtotal += $o->price*$o->quantity;
                }
                $status = DB::table('status')->where('id',$c->id)->first();
                ?>
                <tr>
                	<td>{{ $c->created_at }}</td>
                    <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($c->created_at))->diffForHumans()}}</td>
                    <td>{{ $c->delivery_cost }}</td>
                    <td>$ {{ number_format($subtotal, 2)}}</td>
                    <td>$ {{ number_format($subtotal + $c->delivery_cost, 2)}}</td>
                    <td>{{ $status->name }}</td>
                    <td><a class="btn btn-info" href="{{ route('frontend.account.history_detail',$c->id) }}"><i class="fa fa-edit"></i> View Details</a></td>

                </tr>
                @endforeach
                <tfoot>
                	<td><a class="btn btn-danger" href="{{ route('frontend.account.profile') }}"><i class="fa fa-reply"></i> Profile</a></td>
                </tfoot>
            </tbody>
           
        </table>
    </div>
</div>
</div>

@endsection