@extends('admin.include.layout')
@section('title','List of Orders')
@section('content')
@include('admin.include.report')


<div class="breadcrumbs">
  <div class="col-sm-4">
    <div class="page-header float-left">
      <div class="page-title">
        <h1>Orders</h1>
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
            <strong class="card-title">Orders</strong>
            <Button class="btn btn-success" data-toggle="modal" data-target="#insert_per"><i class="fa fa-plus-circle"></i> add</Button>
          </div>
          <div class="clearfix"></div>
          <div class="search" style="margin-top: 20px">
            <div class="col-md-3">
              Customer:<select  class="selected2 form-control" name="cus_search" id="select">
                <option value="all">--All--</option>
                @foreach($customer as $cus)
                <option value="{{ $cus->id }}">{{$cus->first_name}} {{$cus->last_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              Status:
              <select class="selected2 form-control" name="status_search" >
                <option value="all">--all--</option>
                @foreach($status as $stt)
                <option value="{{$stt->id}}">{{ $stt->name }}</option>
                @endforeach

              </select>
            </div>

            <div class="col-md-3">
              Date from:
              <input class="form-control" type="date" name="date_from">
            </div>
            <div class="col-md-3">
              Date to:
              <input class="form-control" type="date" name="date_to">
            </div>

          </div>
          <hr style="boder:0.5px solid #fff">
          <div class="card-body">

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
                  <td>
                    @if(check_permission('edit_order')!=1)
                    <button disabled="" class="badge badge-info" title="{{get_message()}}"><i class="fa fa-edit"></i> View Details</button>
                  @else
                  <a class="badge badge-info" href="{{ route('admin.orders.details',$c->id) }}"><i class="fa fa-edit"></i> View Details</a>
                  @endif
                  </td>


                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>

      <select class="selected2" name="a"><option>a</option><option>a</option></select>
    </div>
  </div><!-- .animated -->
</div><!-- .content -->


</div><!-- /#right-panel -->
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('change','select[name=cus_search], select[name=status_search], input[name=date_from], input[name=date_to]',function(){
      cus_search = $('select[name=cus_search]').val();
      status_search = $('select[name=status_search]').val();
      date_from = $('input[name=date_from]').val();
      date_to = $('input[name=date_to]').val();
      $.ajax({
        type:'POST',
        url: '{{route('admin.orders.search')}}',
        data:{'cus_search':cus_search,'status_search':status_search,'date_from':date_from,'date_to':date_to},
        success:function(data) {
          document.getElementsByClassName('search_order')[0].innerHTML = data;
        }
      })
    })
    
  })


</script>







@endsection
