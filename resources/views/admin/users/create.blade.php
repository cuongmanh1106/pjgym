@extends('admin.include.layout')
@section('title','Create a user')
@section('content')
@include('admin.include.report')


<div class="card">
  <div class="card-header">
    Featured
  </div>

  <div class="error_user">
    
  </div>

  
  <div class="card-body">
    <form id="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.users.store') }}">
  <div class="container">
    @if (count($errors) > 0)
    <ul class="alert alert-danger">
      @foreach($errors->all() as $err)
        <li style="color: red">{{ $err }}</li>
      @endforeach
    </ul>
    @endif
    <div class="row form-group">
        <div class="col-md-1"><label for="text-input" class=" form-control-label">First Name:</label></div>
        <div class="col-md-4"><input type="text" required="required" id="text-input" value="{{ old('first_name') }}" name="first_name" class="form-control"></div>
         <div class="col-md-1">(<span style="color:red">*</span>)</div>
         <div class="col-md-1"><label for="text-input" class=" form-control-label">Last Name:</label></div>
        <div class="col-md-4"><input type="text" required="required" id="text-input" value="{{ old('last_name') }}" name="last_name" class="form-control"></div>
        <div class="col-md-1">(<span style="color:red">*</span>)</div>
    </div>
     
   <div class="row form-group">
    <div class="col col-md-1"><label for="select" class=" form-control-label">Permission:</label></div>
    <div class="col-12 col-md-10">
      <select name="permission_id" required="required" id="select" class="form-control">
         @foreach($per as $v)

        <option {{ old('permission_id') != $v->id ?: 'selected' }} value="{{ $v->id }}">{{ $v->name }}</option> 
        @endforeach
      </select>
  </div>
   <div class="col-md-1">(<span style="color:red">*</span>)</div>
   
   
  </div>

 
   <div class="row form-group">
        <div class="col-md-1"><label for="text-input" class=" form-control-label">Email</label></div>
        <div class="col-md-10"><input type="email" required="required" id="text-input" value="{{ old('email') }}" name="email" class="form-control"></div>
         <div class="col-md-1">(<span style="color:red">*</span>)</div>
   </div>

    <div class="row form-group">
        <div class="col-md-1"><label for="text-input" class=" form-control-label">Password:</label></div>
        <div class="col-md-10"><input type="password" required="required" id="text-input" value="{{ old('password') }}" name="password" class="form-control"></div>
         <div class="col-md-1">(<span style="color:red">*</span>)</div>
    </div>

    <div class="row form-group">
        <div class="col-md-1"><label for="text-input" class=" form-control-label">Confirm Password:</label></div>
        <div class="col-md-10"><input type="password" required="required" id="text-input" value="{{ old('confirm_password') }}" name="confirm_password" class="form-control"></div>
         <div class="col-md-1">(<span style="color:red">*</span>)</div>
    </div>

    <div class="row form-group">
        <div class="col-md-1"><label for="text-input" class=" form-control-label">Phone Number:</label></div>
        <div class="col-md-10"><input type="text" required="required" id="text-input" value="{{ old('phone_number') }}" name="phone_number" class="form-control"></div>
         <div class="col-md-1">(<span style="color:red">*</span>)</div>
    </div>

    <div class="row form-group">
        <div class="col-md-1"><label for="text-input" class=" form-control-label">Address:</label></div>
        <div class="col-md-10"><input type="text" id="text-input" name="address" value="{{ old('address') }}" class="form-control"></div>
    </div>

    <div class="row form-group">
        <div class="col-md-1"><label for="text-input" class=" form-control-label">Avatar:</label></div>
        <div class="col-md-10"><input type="file" id="text-input" name="image" class="form-control"></div>
    </div>

      <div class="form-group " style="float: right;">
              <button  type="button" class="btn btn-success btn-sm" id="insert_user" name="insert_user"><i class="fa fa-dot-circle-o"></i> Insert</button>
              <button type="button" class="btn btn-danger btn-sm" name="reset"><i class="fa fa-ban"></i> Cancel</button>
            </div>

  
  </div>

             
        </form>
  </div>
</div>

<script type="text/javascript">
  $('#insert_user').on('click',function(){
    var html = '';
    var flag = true;
    html += ' <ul  class="alert alert-danger">';
    if($('input[name=first_name]').val() == ''){
      flag = false;
      html += '<li>First name is required</li>';
    }  
    if($('input[name=last_name]').val() == ''){
      flag = false;
      html += '<li>Last name is required</li>';
    }  
    if($('input[name=email]').val() == ''){
      flag = false;
      html += '<li>Email name is required</li>';
    }  
    if($('input[name=password]').val() == ''){
      flag = false;
      html += '<li>Password is required</li>';
    }  
    if($('input[name=confirm_password]').val() == ''){
      flag = false;
      html += '<li>Confirm password is required</li>';
    }  
    if($('input[name=phone_number]').val() == ''){
      flag = false;
      html += '<li>Phone is required</li>';
    }  
    if($('input[name=confirm_password]').val() != $('input[name=password]').val()){
      flag = false;
      html += '<li>Wrong confirm password</li>';
    }  
    html += "</ul>";

    if(flag) {
     $('button[name="insert_user"]').attr("type", "submit");
    } else {
       $('.error_user').html(html);
    }
  })
</script>


@endsection