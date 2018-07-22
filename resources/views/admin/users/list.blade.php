@extends('admin.include.layout')
@section('title','List of Categories')
@section('content')
@include('admin.include.report')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Users</h1>
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
                            <strong class="card-title">Users</strong>
                            @if(check_permission('insert_user') != 1)
                            <button disabled="" class="btn btn-success"  ><i class="fa fa-plus-circle"></i> Add</button>
                            @else
                            <a class="btn btn-success" href="{{ route('admin.users.create') }}" ><i class="fa fa-plus-circle"></i> Add</a>
                            @endif
                        </div>
                       <div class="search" style="margin-top: 20px">
                           <div class="col-md-3 col-md-offset-3">
                               <input type="text" class="form-control" name="name_search" placeholder=" Name...">
                           </div>
                           <div class="col-md-3 col-md-offset-3">
                               <select name="parent_search" required="required" id="select" class="form-control">
                                <option value="all">All</option>
                                <option value="0">None</option>
                               
                              </select>
                           </div>
                       </div>
                        <div class="card-body">
                       
                  <table id="bootstrap-data-table" class="table table-striped table-bordered search_cate">
                    <thead>

                      <tr>
                      	<th><input type="checkbox" name=""></th>
                        <th>STT</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Description</th>
                        <th>Soft</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    	@foreach($users as $key=>$u)
                    	<?php
                    	$permission = DB::table('permission')->where('id',$u->permission_id)->first();
                    	$permisstion_name = '';
                    	if($permission) {
                    		$permisstion_name = $permission->name;
                    	}
                        $image = 'user.jpg';
                        if($u->image != '') {
                            $image = $u->image;
                        }
                    	?>
                      <tr id="">
                      	<td><input type="checkbox" name=""></td>
                        <td>{{ $key }}</td>
                        <td><img src="{{asset('/public/admin/images')}}/{{$image}}" width="150px" ></td>
                        <td>{{ $u->first_name }} {{ $u->last_name }}</td>
                        <td>{{ $permisstion_name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->phone_number }}</td>
                        <td>
                        	<div class="dropdown">
							    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
							      Action
							    </button>
							    <div class="dropdown-menu" style="position: absolute;transform: translate3d(0px, 38px, 0px);top: 35px;left: 0px;will-change: transform;">
                                    @if(check_permission('delete_user')!=1)
							      <button class="dropdown-item badge badge-danger" disabled><i class="fa fa-trash-o"></i> Xóa</button>
                                  @else
                                  <a class="dropdown-item badge badge-danger" data-index = "{{ $u->id }}"  id="delete_user" onclick  href="javascript::void(0)"><i class="fa fa-trash-o"></i> Xóa</a>
                                  @endif
							    </div>
					  		</div>
						</div>
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
<script type="text/javascript">

   $('#delete_user').on('click',function(){
    id = $(this).attr('data-index');
    this1 = $(this);
    console.log(id);

    if(confirm("data will not restore again, Are you sure?")){
        $.ajax({
            type:'GET',
            url:'{{route('admin.users.delete')}}',
            data:{'id':id},
            success:function(data) {
                if(data == 'success') {
                    this1.parent().parent().parent().parent().remove();
                }
            }
        })
    }
   })

    $('select[name=parent_search]').on('change',function(){
        var name = $('input[name=name_search]').val();
        var parent = $('select[name=parent_search]').val();
        $.ajax({
            url: "{{ route('admin.categories.search') }}",
            type: 'GET',
            cache: false,
            data: {'name':name, 'parent':parent},
            success: function(data,status) {
                // alert(data);
                document.getElementsByClassName('search_cate')[0].innerHTML = data;
            }
        })
    })
    $('input[name=name_search').on('keyup',function(){
        var name = $('input[name=name_search]').val();
        var parent = $('select[name=parent_search]').val();
        $.ajax({
            url: "{{ route('admin.categories.search') }}",
            type: 'GET',
            cache: false,
            data: {'name':name, 'parent':parent},
            success: function(data,status) {
                // alert(data);
                document.getElementsByClassName('search_cate')[0].innerHTML = data;
            }
        })
    });

    // $('#delete').on('click',function(){
    //     var id = $(this).attr('data-index');
    //     alert(id);
    // })
</script>

   
              

@endsection
