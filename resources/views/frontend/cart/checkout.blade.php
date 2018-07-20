@extends('frontend.include.layout')
@section('title','Checkout')
@section('content')

<div class="container">
    <div class="panel panel-info" style="margin-top: 150px">
      <div class="panel-heading"><h3 style="text-align: center;">Your shopping cart</h3></div>
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
              <th>Action</th>
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
          <td width="10%"><input type="number" class="form-control" value="{{ $c->qty }}" name="qty_checkout"></td>
          <td>
            
              <select class="form-control" name="size_update">
                @foreach($sizes as $key=>$s)
                  <option {{ ($c->name == $key)?'selected':'' }}  value="{{ $key }}">{{ $key }}</option>
                  @endforeach
              </select>
              
          </td>
          <td>$ <span class="sub-total">{{ number_format($product->price*$c->qty,2)}}</span></td>
          <td>
              <a data-index = "{{ $c->rowId }}" class="btn btn-info update_cart" href="javascript:void(0)"><i class="fa fa-edit"></i> Update</a>
              <a class="btn btn-danger delete_cart"  data-index = "{{ $c->rowId }}" href="javascript:void(0)"><i class="fa fa-trash-o"></i> Delete</a>
          </td>
      </tr>
      @endforeach
  </tbody>
  <tfoot>
          <td colspan="7" align="right"><h2><b>Total:$</b> <span class="total">{{$total}}</span></h2></td>
  </tfoot>
</table>
</div>
</div>
</div>





@endsection