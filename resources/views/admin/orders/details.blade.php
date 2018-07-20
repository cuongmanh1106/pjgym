@extends('admin.include.layout')
@section('title','List of order details')
@section('content')

@include('admin.include.report')




<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Details</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Table</a></li>
                    <li class="active">Data table</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Detail order</strong>
                    </div>
                    <?php
                    $customer = DB::table('users')->where('id',$order->customer_id)->first();
                    ?>
                    <div class="card-body">
                        <div>
                           <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Customer infomation</strong>
                                </div>

                                <div class="card-body">
                                    <form method="post"  action="{{ route('admin.orders.confirm',$order->id) }}">
                                        <div class="row">
                                            <div class="col-md-4"><b>Date: </b>  {{$order->created_at}} </div>
                                            <div class="col-md-4"><b>Customer: </b>  {{$customer->first_name}} {{ $customer->last_name }} </div>
                                            <div class="col-md-4"><b>Phone: </b> {{ $customer->phone_number }}</div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            @if($order->status == 1)
                                            <div class="col-md-4">
                                                <b>Delivery to: </b><input type="text" class="form-control" name="delivery_place" value="{{ $order->delivery_place }}">
                                            </div>
                                            <div class="col-md-4">
                                                <b>Delivery cost: </b><input type="text" class="form-control" name="delivery_cost" value="{{ $order->delivery_cost }}">
                                            </div>
                                            @else 
                                            <div class="col-md-4">
                                                <b>Delivery to: </b>{{ $order->delivery_place }}
                                            </div>
                                            <div class="col-md-4">
                                                <b>Delivery cost: </b>{{ $order->delivery_cost }}
                                            </div>
                                            @endif
                                            <div class="col-md-4">
                                                <b>Status: </b>
                                                <select class="form-control" name="status">
                                                    @foreach($status as $stt)
                                                    <?php
                                                    $selected = '';
                                                    $disabled = '';
                                                    if($stt->id == $order->status) {
                                                        $selected = 'selected';
                                                    }
                                                    if($stt->id < $order->status) {
                                                        $disabled = 'disabled';
                                                    }
                                                    ?>
                                                    <option {{$disabled}} {{$selected}} value="{{ $stt->id }}">{{ $stt->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row" style="text-align: right">
                                            <a href="{{ route('admin.orders.list') }}" class="btn btn-danger"><i class="fa fa-reply"></i> Back</a>
                                            @if($order->status != 5)
                                            <button type="button" name="confirm" class="btn btn-info"><i class="fa fa-thumbs-up"></i> Confirm</button>
                                            @else 
                                            <button disabled type="button" name="confirm" class="btn btn-info"><i class="fa fa-thumbs-up"></i> Confirm</button>
                                            @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                

                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">Order infomation</strong>
                                    </div>

                                    <div class="card-body">
                                         <table id="bootstrap-data-table" class="table table-striped table-bordered search_order">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Product name</th>
                                                <th>Size</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = 0?>
                                            @foreach($details as $dt)
                                            <?php 
                                            $product = DB::table('products')->where('id',$dt->pro_id)->first();
                                            $subtotal = 0;
                                            $total += $dt->price * $dt->quantity;
                                            ?>
                                            <tr>

                                                <td width="20%"><img src="{{ asset('/public/admin/images') }}/{{ $product->image }}" width="100px"></td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{$dt->size}}</td>
                                                <td>$ {{ number_format($dt->price,2)}}</td>
                                                <td>{{ $dt->quantity }}</td>
                                                <td>$ {{ number_format($dt->price*$dt->quantity,2)}}</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6" align="right" style="font-size: 25px"><b>Total: $</b>{{ number_format($total,2) }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    </div>
                                </div>
                                   
                                </div>
                            </div>
                        </div>


                    </div>
                </div><!-- .animated -->
            </div><!-- .content -->


        </div><!-- /#right-panel -->

@include('admin.orders.delivery')


<script type="text/javascript">
    $('button[name=confirm]').on('click',function(){
        status = $('select[name=status]').val();
        if(parseInt(status) != 3) {
            $('button[name=confirm]').attr('type','submit');
        } else {
            $('#delivery').modal(); 

        }
    }) 
</script>


        @endsection
