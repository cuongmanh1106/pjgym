@extends('frontend.include.layout')
@section('title','Your profile')
@section('content')
@include('frontend.account.change_password')
@include('frontend.account.edit_profile')

<div class="panel panel-info" style="margin-top: 125px">
	<!-- Default panel contents -->
	<div class="panel-heading" style="text-align: center;"><h1>Profile</h1></div>
	<div class="panel-body">
		<div class="col-md-6" style="text-align: right;">
			<img src="{{asset('/public/admin/images')}}/{{ (Auth::user()!=null && Auth::user()->image!='')?Auth::user()->image:'us.png' }}" width="250px">
		</div>
		<div class="col-md-6">
			<h4><b>Name</b>: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4><br>
			<h4><b>Email</b>: {{ Auth::user()->email }}</p><br>
				<p><b>Password</b>:  <u><a data-toggle="modal" href="#change_password" style="color:blue">Change password</a></u></p><br>
				<p><b>Phone</b>: {{ Auth::user()->phone_number }}</p><br>
				<p><b>Address</b>: {{ Auth::user()->address }}</p><br>
			</div>
			<div class="clearfix"></div>
			<div class="form-group" style="text-align: center;">
				<a class="btn btn-danger" data-toggle="modal" href="{{ route('frontend.account.logout') }}" style="text-align: center;"><i class="fa fa-times-circle"></i> Logout</a> 
				<a class="btn btn-info" data-toggle="modal" href="#edit_profile" style="text-align: center;"><i class="fa fa-edit"></i> Edit</a>   
				<a class="btn btn-success" data-toggle="modal" href="#edit_profile" style="text-align: center;"><i class="fa fa-reply"></i> Back</a>  
				<a class="btn btn-warning" href="{{ route('frontend.account.history_order') }}" style="text-align: center;"><i class="fa fa-eye"></i> See history order</a>  
			</div>
		</div>

		<!-- Table -->
		<table class="table">
			...
		</table>
	</div>
	<script type="text/javascript">$('#update_profile').on('click',function(){
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

	})</script>
	@endsection