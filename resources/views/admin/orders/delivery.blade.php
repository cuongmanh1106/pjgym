<div id="delivery" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <form method="post" action="{{ route('admin.orders.confirm',$order->id) }}">
          <?php
          $shipper = DB::table('users')->where('permission_id',6)->get();
          ?>
          <select class="form-control" name="shipper">
            @foreach($shipper as $s)
            <option value="{{ $s->id }}">{{ $s->first_name }}</option> 
            @endforeach
          </select>
          <input type="hidden" name="delivery_place">
          <input type="hidden" name="delivery_cost">
          <input type="hidden" name="status" value="3">


      </div>

      <div class="modal-footer">
        <button type="submit" name="change_password" style="text-align: center;" class="btn btn-info">Submit</button>
          </div>
    </form>



        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>

</div>

</div>

</div>
</div>


