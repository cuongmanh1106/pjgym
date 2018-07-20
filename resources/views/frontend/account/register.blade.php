@extends('frontend.include.layout')
@section('title','Register')
@section('content')
@include('admin.include.report')
<div class="container" style="margin-top: 125px">
		<div class="register">
		<h2>REGISTER</h2>		
		<div class="error_register_customer">
			
		</div>
		@if (count($errors) > 0)
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $err)
                    <li style="color: red">{{ $err }}</li>
                    @endforeach
                </ul>
                @endif
		<div class=" register-top">
			<form method="POST" enctype="multipart/form-data" action="{{ route('frontend.account.postRegister') }}">
				<div> 	
				<span>First Name (<b style="color: red">*</b>)</span>
				<input type="text" value="{{ old('first_name') }}" required name="first_name"> 
			</div>
			<div> 	
				<span>Last Name (<b style="color: red">*</b>)</span>
				<input type="text" value="{{ old('last_name') }}" required name="last_name">
			</div>
			<div> 	
				<span>Email (<b style="color: red">*</b>)</span>
				<input style="width: 60%; padding:14px" type="email" value="{{ old('email') }}" required name="email"> 
			</div>
			<div> 
				<span >Password (<b style="color: red">*</b>)</span>
				<input type="password" required name="password">
			</div>	
			<div> 
				<span >Confirm Password (<b style="color: red">*</b>)</span>
				<input type="password" required name="confirm_password">
			</div>	
			<div> 	
				<span>Phone number (<b style="color: red">*</b>)</span>
				<input type="text" value="{{ old('phone_number') }}" required name="phone_number"> 
			</div>
			<div> 	
				<span>Address</span>
				<input type="text" value="{{ old('address') }}" name="address"> 
			</div>
			<div> 	
				<span>Avatar</span>
				<input type="file" name="image"> 
			</div>

				<input class="btn btn-success" name="register_customer" type="button" value="Register"> 
			</form>
		</div>		
	</div>
	</div>

	<script type="text/javascript">
		$('input[name=register_customer]').on('click',function(){
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
     $('input[name="register_customer"]').attr("type", "submit");
    } else {
       $('.error_register_customer').html(html);
    }
  })
	</script>

@endsection