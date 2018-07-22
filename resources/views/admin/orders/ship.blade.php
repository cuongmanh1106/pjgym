@extends('admin.include.layout')
@section('title','List of Permission')
@section('content')
@include('admin.include.report')

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Ship</h1>
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
                        <strong class="card-title">Ship</strong>
                        
                    </div>
                    @if(Auth::user()->permission_id !=6)
                    <div class="search" style="margin-top: 20px">
                        <div class="col-md-4 col-md-offset-3">
                            Order:
                            <input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="order" placeholder=" Order number...">
                        </div>
                        <div class="col-md-4 col-md-offset-3">
                            <?php
                            $shipper = DB::table('users')->where('permission_id',6)->get();
                            ?>
                            Shipper:
                            <select name="user_id" required="required" id="select" class="selected2 form-control" style="padding: 5px">
                                <option value="all">All</option>
                                @foreach($shipper as $sh)
                                <option value="{{ $sh->id }}">{{ $sh->first_name }} {{ $sh->last_name }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="col-md-4">
                            Status:
                            <select name="status" required="required" class="selected2 form-control">
                                <option value="all">--All--</option>
                                <option value="0">Delivering</option>
                                <option value="1">Delivered</option>
                                <option value="2">Cancel</option>
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="card-body">

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
                                        <button class="badge badge-danger change_status"><i class="fa fa-edit"></i> <span class="text_status">Change status</span></button>
                                        <a class=" btn btn-success badge badge-success" href="{{ route('admin.orders.details',$p->order_id) }}"><i class="fa fa-eye"></i> View order</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->


</div><!-- /#right-panel -->




<script>

    $(document).on('click','.change_status',function(){
        status = $(this).parent().parent().find('input[name=status_tmp]').val();
        this1 = $(this);
        select0 = '';
        select1 = '';
        if(status == 0) select0 = 'selected';
        else if(status == 1) select1 = 'selected';
        if(status)
        html = '';
        html += '<select  class="form-control" name="update_status">';
        html += '<option '+select0+' value="0">Delivering</option>';
        html += '<option '+select1+' value="1">Delivered</option>';
        html += '<option value="2">Cancel</option>';
        $(this).parent().parent().find('.update_status').html(html) ;
        $(this).removeClass('change_status');
        $(this).addClass('update_stt');
        $(this).find('.text_status').html('Update');
    })

    $(document).on('click','.update_stt',function(){
        this1 = $(this).parent().parent();
        this2 = $(this);
        status = this1.find('select[name=update_status]').val();
        id = this1.find('input[name=id]').val();
        order_id = this1.find('input[name=order_id]').val();

        $.ajax({
            type:'POST',
            url: '{{ route('admin.orders.update_status') }}',
            data:{'status':status,'id':id,'order_id':order_id},
            success:function(data){
                if(data == 'success') {
                    this2.find('.text_status').html('Change status');
                    this1.find('input[name=status_tmp]').val(status);
                    if(status == 0) stt = 'Delivering';
                    else if(status == 1) stt = 'Delivered';
                    else if(status == 2) stt = 'Cancel';
                    this1.find('.update_status').html(stt);
                    this2.removeClass('update_stt');
                    this2.addClass('change_status');
                    
                }
            }
        })

        
    })

    $('input[name=order]').on('keyup',function(){
        order_id = $('input[name=order]').val();
        user_id = $('select[name=user_id]').val();
        status = $('select[name=status]').val(); 

        $.ajax({
            type:'POST',
            url: '{{ route('admin.orders.search_ship') }}',
            data:{'order_id':order_id,'user_id':user_id,'status':status},
            success:function(data){
                document.getElementsByClassName('search_ship')[0].innerHTML = data;
            }
        })
    });
    $(document).ready(function() {
        $(document).on('change','select[name=status], select[name=user_id]',function(){
            order_id = $('input[name=order]').val();
            user_id = $('select[name=user_id]').val();
            status = $('select[name=status]').val(); 

            $.ajax({
                type:'POST',
                url: '{{ route('admin.orders.search_ship') }}',
                data:{'order_id':order_id,'user_id':user_id,'status':status},
                success:function(data){
                    document.getElementsByClassName('search_ship')[0].innerHTML = data;
                }
            })
        })
    })

// $('.change-trigger').popover({
//     placement : 'Right',
//     title : 'Change',
//     trigger : 'click',
//     html : true,
//     content : function(){
//         var content = '';
//         content = $('#html-div').html();
//         return content;
//     } 
// });

</script>


@endsection
