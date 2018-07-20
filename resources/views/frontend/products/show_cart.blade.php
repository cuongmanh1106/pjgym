<div id="checkout_cart" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <?php
        $carts = Cart::content();
        $total = Cart::subtotal();
        ?>

        <div class="">
          <div class="">
            <div class=""><h3 style="text-align: center;">Your shopping cart</h3></div>
            <div class="">
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

                <tbody id="cart_show">
                 @foreach($carts as $c)
                 <?php 
                 $product = DB::table('products')->where('id',$c->id)->first();
                 $sizes = json_decode($product->size);
                 ?>
                 <tr id="{{ $c->rowId }}">
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
                    <input type="hidden" value="{{ $c->id }}" name="pro_id">
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

    </div>

    <div class="modal-footer">
      <button type="button"  name="process" data-index="{{ Cart::content()->count() }}" style="text-align: center;" class="btn btn-warning"><i class="fa fa-reply"></i> Process to buy</button>
      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
    </div>

  </form>

</div>

</div>

</div>
</div>



<script type="text/javascript">
  $(document).ready(function(){
    count = $('button[name=process]').attr('data-index');
    if(parseInt(count) == 0) { //nếu không có sp trong giỏ thì disabled nút process to buy
      $('button[name=process]').addClass('disabled');
    }
  })

  $(document).on('click','button[name=process]',function(){
    user = '{{ Auth::user() }}';
    count = $('button[name=process]').attr('data-index');
    if(parseInt(count) == 0) { //nếu không có sp trong giỏ thì disabled nút process to buy
      $('button[name=process]').addClass('disabled');
    }
    if(user == '') {
      if(confirm('You must login to go on!!!')){
        window.location = '{{ route('frontend.account.getlogin') }}';
      }
    } else {
      window.location = '{{ route('frontend.cart.process_to_buy') }}';
    }
  })

  $(document).on('click','.update_cart',function(){
    rowId = $(this).attr('data-index');
    qty = $(this).parent().parent().find('input[name=qty_checkout]').val();
    size = $(this).parent().parent().find('select[name=size_update]').val();
    pro_id = $(this).parent().find('input[name=pro_id]').val();
    $this1 = $(this);
    console.log(pro_id);
    if(parseInt(qty) > 0 ) {
      $.ajax({
        type:'POST',
        url:'{{ route('frontend.cart.update_cart') }}',
        data: {'rowId':rowId,'qty':qty,'size':size,'pro_id':pro_id},
        dataType: 'json',
        success:function(data) {
          if(data.content == 'overlimit') {
            alert("This product's quantity don't enough!!");
          } else {
            $this1.parent().parent().find('.sub-total').html(data.content.price*data.content.qty);
            $('.total').html(data.total);
          }
        }
      })
    } else {
      alert('Quality must be at least one');
    }
  })

  $(document).on('click','.delete_cart',function(){
    rowId = $(this).attr('data-index');
    $this1 = $(this);
    $.ajax({
      type:'GET',
      url: '{{ route('frontend.cart.delete_cart') }}',
      data:{'rowId':rowId},
      dataType:'json',
      success:function(data){
        if(data != '') {
          $this1.parent().parent().remove();
          $('.total').html(data.total);
          $('#cart_quantity').html(data.count);//html số của giỏ hàng
          $('#checkout').attr('data-index',data.count);//trên header
          $('input[name=process]').attr('data-index',data.count);// attr cuar process to buy
          if(parseInt(data.count) == 0) {
            $('button[name=process]').addClass('disabled');
          }

        }
      }
    })
  })
</script>

