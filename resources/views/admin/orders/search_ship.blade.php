<table id="bootstrap-data-table" class="table table-striped table-bordered search_ship">
                            <thead>

                                <tr>
                                    <th>STT</th>
                                    <th>Order </th>
                                    <th>Shipper</th>
                                    <th>Total Order</th>
                                    <th>Addess</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ship as $key=>$p)
                                <?php
                                $user = DB::table('users')->where('id',$p->user_id)->first();
                                $user_name = $user->first_name .' '. $user->last_name;
                                $order = DB::table('orders')->where('id',$p->order_id)->first();
                                $order_detail = DB::table('order_details')->where('order_id',$p->order_id)->get();
                                $total = $order->delivery_cost;
                                foreach($order_detail as $or) {
                                    $total += $or->price * $or->quantity;
                                }
                                ?>
                                <tr id="">
                                    <input type="hidden" name="status_tmp" value="{{$p->status}}">
                                    <input type="hidden" name="id" value="{{ $p->id }}">
                                    <input type="hidden" name="order_id" value="{{ $p->order_id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $p->order_id }}</td>
                                    <td>{{ $user_name }}</td>
                                    <td>${{ number_format($total,2) }}</td>
                                    <td>{{ $order->delivery_place }}</td>
                                    <td width="15%" class="update_status">
                                       
                                        <?php
                                        if($p->status == 0)
                                            echo "Delivering";
                                        else if($p->status == 1) 
                                            echo "Delivered";
                                        else echo "Cancel"
                                        ?>
                                        
                                    </td>
                                    <td>
                                        <a class="badge badge-danger change_status" href="javascript:void(0)"><i class="fa fa-edit"></i> <span class="text_status">Change status</span></a>
                                        <a class="badge badge-success" href="{{ route('admin.orders.details',$or->order_id) }}"><i class="fa fa-eye"></i> View order</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>