<div id="edit_profile" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
         @if (count($errors) > 0)
    <ul class="alert alert-danger">
      @foreach($errors->all() as $err)
        <li style="color: red">{{ $err }}</li>
      @endforeach
    </ul>
    @endif
    <div class="profile_validation"></div>
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.users.update_profile') }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
             <div class="row form-group">
              <div class="col-md-2"><label for="text-input" class=" form-control-label">First name:</label></div>
              <div class="col-md-9"><input type="text" required="required" id="text-input" value="{{ Auth::user()->first_name }}" name="first_name" class="form-control"></div>
              <div class="">(<span style="color:red">*</span>)</div>
          </div>
           <div class="row form-group">
              <div class="col-md-2"><label for="text-input" class=" form-control-label">Last name:</label></div>
              <div class="col-md-9"><input type="text" required="required" id="text-input" value="{{ Auth::user()->last_name }}" name="last_name" class="form-control"></div>
              <div class="">(<span style="color:red">*</span>)</div>
          </div>
            
          <div class="row form-group">
              <div class="col-md-2"><label for="text-input" class=" form-control-label">Phone:</label></div>
              <div class="col-md-9"><input type="text" required="required" id="text-input" value="{{ Auth::user()->phone_number }}" name="phone_number" class="form-control"></div>
              <div class="">(<span style="color:red">*</span>)</div>
          </div>
          <div class="row form-group">
              <div class="col-md-2"><label for="text-input" class=" form-control-label">Address:</label></div>
              <div class="col-md-9"><input type="text"  id="text-input" value="{{ Auth::user()->address }}" name="address" class="form-control"></div>
          </div>
          <div class="row form-group">
              <div class="col-md-2"><label for="text-input" class=" form-control-label">Avatar:</label></div>
              <div class="col-md-9"><input type="file" id="text-input"  name="image" class="form-control"></div>
              @if(Auth::user()->image != '')
              <div class="col-md-2"></div>
              <div class="col-md-4" style="margin-top: 10px;"><img src="{{ asset('/public/admin/images') }}/{{ Auth::user()->image }}" width="150px" height="150px"></div>
            @endif
          </div>

      </div>

      <div class="modal-footer">
        <button type="button" name="update_prof" id="update_profile" style="text-align: center;" class="btn btn-info">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>
</div>

</div>

</div>
</div>
<script type="text/javascript">
  $('#update_profile').on('click',function(){
    html = '<ul class="alert alert-danger>"';
    flag = true;
    if($('input[name=first_name]').val() == '') {
      html += '<li>First name is required</li>';
      flag = false;
    }
    if($('input[name=last_name]').val() == '') {
      html += '<li>Last name  is required</li>';
      flag = false;
    }
    if($('input[name=email]').val() == '') {
      html += '<li>Email is required</li>';
      flag = false;
    }
    if($('input[name=phone_number]').val() == '') {
      html += '<li>First name is required</li>';
      flag = false;
    }
    html += '</ul>';
    if(flag) {
      $('button[name="update_prof"]').attr("type", "submit");
    } else {
        $('.profile_validation').html(html);
    }

  })
</script>

