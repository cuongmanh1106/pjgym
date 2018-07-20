    <?php 
                 $product = DB::table('products')->where('id',$cart->id)->first();
                 $sizes = json_decode($product->size);
                 ?>
                 {{$total}}-{{$count}}-{{$cart->rowId}}---
                 <tr id="{{$cart->rowId}}"> 
                  <td><img src="{{ asset('/public/admin/images') }}/{{ $product->image }}" width="70px"></td>
                  <td>{{ $product->name }}</td>
                  <td>$ {{ number_format($product->price, 2)}}</td>
                  <td width="10%"><input type="number" class="form-control" value="{{ $cart->qty }}" name="qty_checkout"></td>
                  <td>

                    <select class="form-control" name="size_update">
                      @foreach($sizes as $key=>$s)
                      <option {{ ($cart->name == $key)?'selected':'' }}  value="{{ $key }}">{{ $key }}</option>
                      @endforeach
                    </select>

                  </td>
                  <td>$ <span class="sub-total">{{ number_format($product->price*$cart->qty,2)}}</span></td>
                  <td>
                    <a data-index = "{{ $cart->rowId }}" class="btn btn-info update_cart" href="javascript:void(0)"><i class="fa fa-edit"></i> Update</a>
                    <input type="hidden" value="{{ $cart->id }}" name="pro_id">
                    <a class="btn btn-danger delete_cart"  data-index = "{{ $cart->rowId }}" href="javascript:void(0)"><i class="fa fa-trash-o"></i> Delete</a>
                  </td>
                </tr>
                <input 