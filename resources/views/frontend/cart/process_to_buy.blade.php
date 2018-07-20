@extends('frontend.include.layout')
@section('title','Checkout')
@section('content')

<div class="container">
    <div class="panel panel-info" style="margin-top: 150px">
        <div class="panel-heading"><h3 style="text-align: center;">Your cart infomation</h3></div>
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
                <div class="col-md-1">
                    <h4><b>Delivery to: </b></h4>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="destination">
                        <option value="hcm">Tp. Hồ Chí Minh</option>
                        <option value="other">Other </option>
                    </select>
                </div>
                <div class="col-md-1"><h4><b>Specific:</b></h4></div>
                <div class="col-md-7">
                    <input type="text" required="" class="form-control" name="specific" value="{{ Auth::user()->address }}" placeholder=" Specific address">
                </div>
            </div>
            <div class="row" style="padding: 30px 0">
                <div class="col-md-6">
                    <h4><b>Total:</b> $<span class="total">{{$total}}</span></h4>
                </div>
                <div class="col-md-6">
                    <h4><b>Delivery cost:</b> $<span id="delivery_cost">4.00</span></h4>
                </div>
            </div>
            <a class="btn btn-danger" href="{{ route('frontend.products.list') }}"  style="float: right;"><i class="fa fa-reply"></i> Continue to buy</a>
            <button type="button" name="order" class="btn btn-success" style="float: right;margin-right: 15px"><i class="fa fa-shopping-cart"></i> Order</button>
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
                <td colspan="7" align="right"><h2><b>Total: </b> $<span class="total">{{$total}}</span></h2></td>
            </tfoot>
        </table>
    </div>
</div>
</div>


<script type="text/javascript">
    $('select[name=destination]').on('click',function(){
        v = $('select[name=destination').val();
        if(v == 'hcm') {
            $('#delivery_cost').html('4.00')
        } else {
            $('#delivery_cost').html('2.00')
        }
    })

    $('button[name=order]').on('click',function(){
        if($('input[name=specific]').val() == "") {
            alert('your specific address can not be null');
        } else {
            $('button[name=order]').attr('type','submit');
        }
    })
</script>


@endsection