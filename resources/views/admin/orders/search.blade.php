<table id="bootstrap-data-table" class="table table-striped table-bordered search_order">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Customer</th>
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
                $customer = DB::table('users')->where('id',$c->customer_id)->first();
                foreach($order_detail as $o) {
                  $subtotal += $o->price*$o->quantity;
                }
                $status = DB::table('status')->where('id',$c->status)->first();

                ?>
                <tr>
                  <td>{{ $c->created_at }}</td>
                  <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($c->created_at))->diffForHumans()}}</td>
                  <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                  <td>{{ $c->delivery_cost }}</td>
                  <td>$ {{ number_format($subtotal, 2)}}</td>
                  <td>$ {{ number_format($subtotal + $c->delivery_cost, 2)}}</td>
                  <td>{{ $status->name }}</td>
                  <td><a class="btn btn-info" href="{{ route('admin.orders.details',$c->id) }}"><i class="fa fa-edit"></i> View Details</a></td>

                </tr>
                @endforeach

              </tbody>
            </table>