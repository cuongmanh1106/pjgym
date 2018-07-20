@extends('frontend.include.layout')
@section('title','Login')
@section('content')
@foreach(['danger', 'warning', 'success', 'info'] as $msg)
          	@if(Session::has('alert-'.$msg))
          	<h4 class="alert alert-{{ $msg }}">{{ Session::get('alert-'.$msg) }}<button class="close" data-dismiss="alert" aria-label="close">&times;</button></h4>
          	@endif
          @endforeach

<div class="container" style="margin-top: 125px">
		<div class="account">
		<h2>Account</h2>
		<div class="account-pass">
		<div class="col-md-7 account-top">
			<form method="post" action="{{ route('frontend.account.postlogin') }}">
				
			<div> 	
				<span>Email</span>
				<input style="width: 100%; padding: 14px" required="" type="email" name="email"> 
			</div>
			<div> 
				<span >Password</span>
				<input required type="password" name="password">
			</div>				
				<input required type="submit" value="Login"> 
			</form>
		</div>
		<div class="col-md-5 left-account ">
			<a href="single.html"><img class="img-responsive " src="{{asset('/public/frontend/images/ac.png')}}" alt=""></a>
			<div class="five">
			<h1>25% </h1><span>discount</span>
			</div>
			<a href="{{ route('frontend.account.getRegister') }}" class="create">Create an account</a>
<div class="clearfix"> </div>
		</div>
	<div class="clearfix"> </div>
	</div>
	</div>

</div>
@endsection