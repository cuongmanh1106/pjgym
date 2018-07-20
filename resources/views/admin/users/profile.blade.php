@extends('admin.include.layout')
@section('title','Your Profile')

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
                    <div class="col-md-6" style="text-align: right">
                        <img src="{{asset('/public/admin/images')}}/{{ (Auth::user()!=null && Auth::user()->image!='')?Auth::user()->image:'us.png' }}" width="150px" height="150px">
                    </div>
                    <div class="col-md-6">
                        <?php
                        $result = DB::table('permission')->where('id',Auth::user()->permission_id)->first();
                        $per_name = '';
                        if($result!=null) {
                            $per_name = $result->name;
                        }
                        ?>
                        <p>Name: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                        <p>Role: {{ $per_name }}</p>
                        <p>Email: {{ Auth::user()->email }}</p>
                        <p>Password:  <u><a data-toggle="modal" href="#change_password" style="color:blue">Change password</a></u></p>
                        <p>Phone: {{ Auth::user()->phone_number }}</p>
                        <p>Address: {{ Auth::user()->address }}</p>
                    </div>
                </div>
                <div class="form-group" style="text-align: center;">
                    <a class="btn btn-info" data-toggle="modal" href="#edit_profile" style="text-align: center;"><i class="fa fa-edit"></i> Edit</a>   
                    <a class="btn btn-success" data-toggle="modal" href="#edit_profile" style="text-align: center;"><i class="fa fa-edit"></i> Back</a>  
                </div>
                
                

            </form>
            @include('admin.users.edit_profile')
            @include('admin.users.change_password')
        </div>
    </div>
    @endsection